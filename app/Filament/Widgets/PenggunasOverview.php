<?php

namespace App\Filament\Widgets;

use App\Models\Pengguna;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PenggunasOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPengguna = Pengguna::count();
        $penggunaBaru = Pengguna::where('tanggal_daftar', '>=', Carbon::now()->subDays(30))->count();
        $totalStaf = Pengguna::where('peran', 'staf')->count();
        $totalManajer = Pengguna::where('peran', 'manajer')->count();
        $totalAdmin = Pengguna::where('peran', 'administrator')->count();

        return [
            Stat::make('Total Pengguna', $totalPengguna)
                ->description('Semua pengguna yang terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Pengguna Baru (30 hari)', $penggunaBaru)
                ->description('Pengguna yang baru terdaftar')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success'),

            Stat::make('Staf / Manajer / Admin', "{$totalStaf} / {$totalManajer} / {$totalAdmin}")
                ->description('Distribusi peran pengguna')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
