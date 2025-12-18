<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ManageMenuItems extends ManageRecords
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    \Log::info('CreateAction - mutateFormDataUsing', ['data_keys' => array_keys($data), 'image' => $data['image'] ?? null]);
                    
                    if (isset($data['image']) && $data['image']) {
                        $imagePath = is_array($data['image']) ? $data['image'][0] : $data['image'];
                        \Log::info('CreateAction - Image path extracted', ['path' => $imagePath]);
                        
                        unset($data['image']);
                        $data['_image_path'] = $imagePath;
                    }
                    return $data;
                })
                ->using(function (array $data, string $model): Model {
                    \Log::info('CreateAction - using', ['model' => $model, 'data_keys' => array_keys($data), 'image_path' => $data['_image_path'] ?? null]);
                    
                    $record = $model::create($data);
                    \Log::info('CreateAction - Record created', ['record_id' => $record->id]);
                    
                    if (isset($data['_image_path']) && $data['_image_path']) {
                        try {
                            $imagePath = $data['_image_path'];
                            \Log::info('CreateAction - Processing image', ['path' => $imagePath]);
                            
                            // Check if file exists in public disk
                            if (Storage::disk('public')->exists($imagePath)) {
                                \Log::info('CreateAction - File exists in public disk', ['path' => $imagePath]);
                                $record->addMediaFromDisk($imagePath, 'public')->toMediaCollection('image');
                                \Log::info('CreateAction - Media added from disk successfully');
                            } else {
                                \Log::warning('CreateAction - File not found in public disk', ['path' => $imagePath]);
                                
                                // Try with full path
                                $fullPath = Storage::disk('public')->path($imagePath);
                                \Log::info('CreateAction - Trying full path', ['full_path' => $fullPath, 'exists' => file_exists($fullPath)]);
                                
                                if (file_exists($fullPath)) {
                                    $record->addMedia($fullPath)->toMediaCollection('image');
                                    \Log::info('CreateAction - Media added from full path successfully');
                                } else {
                                    \Log::error('CreateAction - File not found anywhere', ['path' => $imagePath, 'full_path' => $fullPath]);
                                }
                            }
                        } catch (\Exception $e) {
                            \Log::error('CreateAction - Failed to add media', [
                                'message' => $e->getMessage(),
                                'trace' => $e->getTraceAsString(),
                                'path' => $data['_image_path'] ?? null
                            ]);
                        }
                    } else {
                        \Log::info('CreateAction - No image path provided');
                    }
                    
                    return $record;
                }),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($this->record)) {
            $media = $this->record->getFirstMedia('image');
            if ($media) {
                $data['image'] = $media->getUrl();
            }
        }
        return $data;
    }
}
