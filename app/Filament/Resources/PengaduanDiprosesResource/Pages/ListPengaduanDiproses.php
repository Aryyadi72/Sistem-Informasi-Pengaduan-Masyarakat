<?php

namespace App\Filament\Resources\PengaduanDiprosesResource\Pages;

use App\Filament\Resources\PengaduanDiprosesResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPengaduanDiproses extends ListRecords
{
    use HasResizableColumn;

    protected static string $resource = PengaduanDiprosesResource::class;

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
                $query->where('status', 'Diproses');
            })
            ->with('pengaduanMasuk');
    }

}
