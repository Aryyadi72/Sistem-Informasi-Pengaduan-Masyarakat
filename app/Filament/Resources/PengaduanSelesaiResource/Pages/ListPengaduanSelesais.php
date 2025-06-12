<?php

namespace App\Filament\Resources\PengaduanSelesaiResource\Pages;

use App\Filament\Resources\PengaduanSelesaiResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPengaduanSelesais extends ListRecords
{
    use HasResizableColumn;

    protected static string $resource = PengaduanSelesaiResource::class;

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
                $query->where('status', 'Selesai');
            })
            ->with('pengaduanMasuk');
    }
}
