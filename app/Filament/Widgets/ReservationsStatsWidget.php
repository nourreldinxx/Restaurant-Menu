<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ReservationResource;
use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservationsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $pending = Reservation::where('status', 'pending')->count();
        $confirmed = Reservation::where('status', 'confirmed')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        $baseUrl = ReservationResource::getUrl('index');
        
        return [
            Stat::make('Pending Reservations', $pending)
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url($baseUrl . '?tableFilters[status][value]=pending'),
            Stat::make('Confirmed Reservations', $confirmed)
                ->description('Active bookings')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->url($baseUrl . '?tableFilters[status][value]=confirmed'),
            Stat::make('Cancelled Reservations', $cancelled)
                ->description('Cancelled bookings')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->url($baseUrl . '?tableFilters[status][value]=cancelled'),
        ];
    }
}
