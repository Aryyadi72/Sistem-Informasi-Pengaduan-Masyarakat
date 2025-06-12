<?php

namespace App\Filament\Resources\PengaduanDiprosesResource\Pages;

use App\Filament\Resources\PengaduanDiprosesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaduanDiproses extends EditRecord
{
    protected static string $resource = PengaduanDiprosesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
