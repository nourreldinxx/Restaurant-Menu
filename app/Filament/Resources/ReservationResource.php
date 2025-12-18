<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages\ManageReservations;
use App\Mail\ReservationAccepted;
use App\Mail\ReservationRejected;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Reservations';

    protected static ?string $modelLabel = 'Reservation';

    protected static ?string $pluralModelLabel = 'Reservations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('reservation_code')
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Unique reservation code'),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('time')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('persons')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending'),
                Forms\Components\Textarea::make('notes')
                    ->label('Admin Notes')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->helperText('Internal notes (not sent to customer)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reservation_code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('persons')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\Filter::make('today')
                    ->label('Today')
                    ->query(fn ($query) => $query->whereDate('date', today())),
                Tables\Filters\Filter::make('this_week')
                    ->label('This Week')
                    ->query(fn ($query) => $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])),
            ])
            ->actions([
                Action::make('accept')
                    ->label('Accept')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Reservation $record) {
                        $record->status = 'confirmed';
                        $record->save();
                        
                        // Send acceptance email with QR code
                        try {
                            Mail::to($record->email)->send(new ReservationAccepted($record));
                            
                            Notification::make()
                                ->success()
                                ->title('Reservation Accepted')
                                ->body('Email sent successfully to ' . $record->email)
                                ->send();
                        } catch (\Exception $e) {
                            \Log::error('Failed to send acceptance email: ' . $e->getMessage());
                            
                            Notification::make()
                                ->warning()
                                ->title('Email Failed')
                                ->body('Reservation accepted but email could not be sent: ' . $e->getMessage())
                                ->send();
                        }
                    })
                    ->visible(fn (Reservation $record) => $record->status === 'pending'),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Rejection Reason (Optional)')
                            ->placeholder('Optional reason for rejection...')
                            ->maxLength(500),
                    ])
                    ->action(function (Reservation $record, array $data) {
                        $record->status = 'cancelled';
                        if (!empty($data['rejection_reason'])) {
                            $record->notes = 'Rejection reason: ' . $data['rejection_reason'];
                        }
                        $record->save();
                        
                        // Send rejection email
                        try {
                            Mail::to($record->email)->send(new ReservationRejected($record));
                            
                            Notification::make()
                                ->success()
                                ->title('Reservation Rejected')
                                ->body('Email sent successfully to ' . $record->email)
                                ->send();
                        } catch (\Exception $e) {
                            \Log::error('Failed to send rejection email: ' . $e->getMessage());
                            
                            Notification::make()
                                ->warning()
                                ->title('Email Failed')
                                ->body('Reservation rejected but email could not be sent: ' . $e->getMessage())
                                ->send();
                        }
                    })
                    ->visible(fn (Reservation $record) => $record->status === 'pending'),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => ManageReservations::route('/'),
        ];
    }
}
