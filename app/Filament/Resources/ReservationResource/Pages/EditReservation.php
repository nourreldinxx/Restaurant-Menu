<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Mail\ReservationAccepted;
use App\Mail\ReservationRejected;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected $originalStatus;

    protected function beforeSave(): void
    {
        // Store original status before save
        $this->originalStatus = $this->getRecord()->status;
    }

    protected function afterSave(): void
    {
        $record = $this->getRecord()->fresh();
        $newStatus = $record->status;

        // Send email if status changed to confirmed
        if ($this->originalStatus !== 'confirmed' && $newStatus === 'confirmed') {
            try {
                Mail::to($record->email)->send(new ReservationAccepted($record));
            } catch (\Exception $e) {
                \Log::error('Failed to send acceptance email: ' . $e->getMessage());
            }
        }

        // Send email if status changed to cancelled
        if ($this->originalStatus !== 'cancelled' && $newStatus === 'cancelled') {
            try {
                Mail::to($record->email)->send(new ReservationRejected($record));
            } catch (\Exception $e) {
                \Log::error('Failed to send rejection email: ' . $e->getMessage());
            }
        }
    }
}
