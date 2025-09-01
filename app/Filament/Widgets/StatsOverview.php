<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Pengesahan;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('User', Pengajuan::count())
            ->description('Total Pengajuan')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->chart([1,3,5,10,20,40])
            ->color('warning'),
            Stat::make('User', Pengesahan::count())
            ->description('Total Pengesahan')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->chart([1,3,5,10,20,40])
            ->color('success'),
            Stat::make('User', User::count())
            ->description('Total Pengguna')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->chart([1,3,5,10,20,40])
            ->color('info'),
        ];
    }
}
