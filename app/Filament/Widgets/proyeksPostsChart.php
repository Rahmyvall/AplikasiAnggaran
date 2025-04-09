<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class proyeksPostsChart extends ChartWidget

{
    protected static ?string $heading = 'Status Proyek';

    protected function getData(): array
    {
        $data = DB::table('proyeks')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statuses = ['perencanaan', 'berjalan', 'tertunda', 'selesai', 'dibatalkan'];
        $chartData = [];

        foreach ($statuses as $status) {
            $chartData[] = $data[$status] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Proyek',
                    'data' => $chartData,
                    'backgroundColor' => [
                        '#3490dc', // biru - perencanaan
                        '#38c172', // hijau - berjalan
                        '#ffed4a', // kuning - tertunda
                        '#6cb2eb', // biru muda - selesai
                        '#e3342f', // merah - dibatalkan
                    ],
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa juga 'pie' atau 'doughnut'
    }
}
