<?php

namespace App\Filament\Widgets;

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
        $today = Reservation::whereDate('date', today())->count();
        $thisWeek = Reservation::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return [
            Stat::make('Pending Reservations', $pending)
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Confirmed Reservations', $confirmed)
                ->description('Active bookings')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Cancelled Reservations', $cancelled)
                ->description('Cancelled bookings')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            Stat::make('Today\'s Reservations', $today)
                ->description('Reservations for today')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
            Stat::make('This Week', $thisWeek)
                ->description('Reservations this week')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
        ];
    }
}
