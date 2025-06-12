<?php

namespace App\Filament\Widgets;

use App\Models\PengaduanMasuk;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class PengaduanChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'pengaduanChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Pengaduan Chart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected function getOptions(): array
    {
        $statusCounts = PengaduanMasuk::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => [
                $statusCounts->get('Masuk', 0),
                $statusCounts->get('Diproses', 0),
                $statusCounts->get('Selesai', 0),
                $statusCounts->get('Ditolak', 0),
            ],
            'labels' => ['Masuk', 'Diproses', 'Selesai', 'Ditolak'],
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
