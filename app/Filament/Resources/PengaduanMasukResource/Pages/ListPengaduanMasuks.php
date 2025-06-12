<?php

namespace App\Filament\Resources\PengaduanMasukResource\Pages;

use App\Filament\Resources\PengaduanMasukResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListPengaduanMasuks extends ListRecords
{
    use HasResizableColumn;

    protected static string $resource = PengaduanMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Pengaduan Masuk')
                ->icon('heroicon-o-squares-plus')
                ->color('info'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('status', 'Masuk');
    }
}
