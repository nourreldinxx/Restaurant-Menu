<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages\ManageMenuItems;
use App\Models\Category;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Menu Items';

    protected static ?string $modelLabel = 'Menu Item';

    protected static ?string $pluralModelLabel = 'Menu Items';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique(Category::class, 'name'),
                    ])
                    ->createOptionUsing(function (array $data): int {
                        return Category::create($data)->id;
                    }),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->disk('public')
                    ->directory('menu-items')
                    ->visibility('public')
                    ->imageEditor()
                    ->helperText('Upload an image file (max 5MB)')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'])
                    ->rules([
                        'image',
                        'max:5120', // 5MB in KB
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        return $record->getFirstMediaUrl('image') ?: null;
                    })
                    ->circular()
                    ->defaultImageUrl(url('/assets/images/mainlogo.png')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, MenuItem $record): array {
                        \Log::info('EditAction - mutateFormDataUsing', ['record_id' => $record->id, 'data_keys' => array_keys($data), 'image' => $data['image'] ?? null]);
                        
                        // Load existing image URL
                        $media = $record->getFirstMedia('image');
                        if ($media && !isset($data['image'])) {
                            $data['image'] = $media->getUrl();
                            \Log::info('EditAction - Loaded existing image URL', ['url' => $data['image']]);
                        }
                        
                        // Handle new upload
                        if (isset($data['image']) && $data['image']) {
                            $imagePath = is_array($data['image']) ? $data['image'][0] : $data['image'];
                            \Log::info('EditAction - Image path extracted', ['path' => $imagePath]);
                            
                            unset($data['image']);
                            $data['_image_path'] = $imagePath;
                        }
                        return $data;
                    })
                    ->using(function (array $data, MenuItem $record): MenuItem {
                        \Log::info('EditAction - using', ['record_id' => $record->id, 'data_keys' => array_keys($data), 'image_path' => $data['_image_path'] ?? null]);
                        
                        $record->update($data);
                        \Log::info('EditAction - Record updated', ['record_id' => $record->id]);
                        
                        if (isset($data['_image_path']) && $data['_image_path']) {
                            try {
                                $imagePath = $data['_image_path'];
                                \Log::info('EditAction - Processing image', ['path' => $imagePath]);
                                
                                $record->clearMediaCollection('image');
                                \Log::info('EditAction - Cleared existing media collection');
                                
                                // Check if file exists in public disk
                                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
                                    \Log::info('EditAction - File exists in public disk', ['path' => $imagePath]);
                                    $record->addMediaFromDisk($imagePath, 'public')->toMediaCollection('image');
                                    \Log::info('EditAction - Media added from disk successfully');
                                } else {
                                    \Log::warning('EditAction - File not found in public disk', ['path' => $imagePath]);
                                    
                                    // Try with full path
                                    $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($imagePath);
                                    \Log::info('EditAction - Trying full path', ['full_path' => $fullPath, 'exists' => file_exists($fullPath)]);
                                    
                                    if (file_exists($fullPath)) {
                                        $record->addMedia($fullPath)->toMediaCollection('image');
                                        \Log::info('EditAction - Media added from full path successfully');
                                    } else {
                                        \Log::error('EditAction - File not found anywhere', ['path' => $imagePath, 'full_path' => $fullPath]);
                                    }
                                }
                            } catch (\Exception $e) {
                                \Log::error('EditAction - Failed to add media', [
                                    'message' => $e->getMessage(),
                                    'trace' => $e->getTraceAsString(),
                                    'path' => $data['_image_path'] ?? null
                                ]);
                            }
                        } else {
                            \Log::info('EditAction - No image path provided');
                        }
                        
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMenuItems::route('/'),
        ];
    }
}
