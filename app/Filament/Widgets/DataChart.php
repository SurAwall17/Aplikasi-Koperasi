<?php

namespace App\Filament\Widgets;

use App\Models\Pengajuan;
use Filament\Widgets\ChartWidget;

class DataChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Pengajuan per Bulan';

    protected function getData(): array
    {
        $data = Pengajuan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $labels = [];
        $totals = [];

        foreach ($data as $bulan => $total) {
            $labels[] = date('F', mktime(0, 0, 0, $bulan, 1));
            $totals[] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengajuan',
                    'data' => $totals,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#1E88E5',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    public static function getSort(): int
    {
        return 1;
    }
}
