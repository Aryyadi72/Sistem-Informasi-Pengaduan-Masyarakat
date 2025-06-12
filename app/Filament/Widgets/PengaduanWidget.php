<?php

namespace App\Filament\Widgets;

use App\Models\PengaduanDiproses;
use App\Models\PengaduanDitolak;
use App\Models\PengaduanMasuk;
use App\Models\PengaduanSelesai;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PengaduanWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengaduan Masuk', PengaduanMasuk::count())
                ->label('Total Pengaduan Masuk')
                ->description('Total Pengaduan Masuk')
                ->descriptionIcon('heroicon-m-archive-box-arrow-down')
                ->color('info')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Pengaduan Diproses', PengaduanDiproses::count())
                ->label('Total Pengaduan Diproses')
                ->description('Total Pengaduan Diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Pengaduan Selesai', PengaduanSelesai::count())
                ->label('Total Pengaduan Selesai')
                ->description('Total Pengaduan Selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Pengaduan Ditolak', PengaduanDitolak::count())
                ->label('Total Pengaduan Ditolak')
                ->description('Total Pengaduan Ditolak')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
