<?php

namespace App\Filament\Widgets;

use App\Models\Periode_anggaran;
use Filament\Widgets\ChartWidget;

class PeriodeAnggaransPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Periode Anggaran per Status';

    protected int | string | array $columnSpan = 'md';
    protected static ?string $maxHeight = '300px'; 

    protected function getData(): array
    {
        $statuses = ['aktif', 'tidak_aktif', 'selesai'];

        $data = Periode_anggaran::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $chartData = [];
        foreach ($statuses as $status) {
            $chartData[] = $data[$status] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Periode',
                    'data' => $chartData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.3)',
                    'fill' => true,
                    'tension' => 0.4, // garis lebih halus
                ],
            ],
            'labels' => ['Aktif', 'Tidak Aktif', 'Selesai'],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Ubah menjadi line chart
    }

    protected function getOptions(): array
    {
        return [
            'onClick' => 'function(event, elements) {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const urls = [
                        "/pdf/periode-anggaran/aktif",
                        "/pdf/periode-anggaran/tidak-aktif",
                        "/pdf/periode-anggaran/selesai"
                    ];
                    window.open(urls[index], "_blank");
                }
            }',
        ];
    }
}
