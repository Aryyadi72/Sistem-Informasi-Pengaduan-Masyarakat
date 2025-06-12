<?php

namespace App\Filament\Widgets;

use App\Models\Kategori;
use App\Models\Masyarakat;
use App\Models\PengaduanMasuk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KategoriWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Kategori', Kategori::count())
                ->label('Total Kategori')
                ->description('Total Kategori')
                ->descriptionIcon('heroicon-m-tag')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Masyarakat', Masyarakat::count())
                ->label('Total Masyarakat')
                ->description('Total Masyarakat')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Pengaduan', PengaduanMasuk::count())
                ->label('Total Pengaduan')
                ->description('Total Pengaduan')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
        ];
    }
}
