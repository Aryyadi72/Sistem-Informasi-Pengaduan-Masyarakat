<?php

namespace App\Filament\Resources\PengaduanDitolakResource\Pages;

use App\Filament\Resources\PengaduanDitolakResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPengaduanDitolaks extends ListRecords
{
    use HasResizableColumn;

    protected static string $resource = PengaduanDitolakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()
            ->whereHas('pengaduanMasuk', function ($query) {
                $query->where('status', 'Ditolak');
            })
            ->with('pengaduanMasuk');
    }
}
