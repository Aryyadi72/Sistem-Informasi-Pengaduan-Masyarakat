<?php

namespace App\Filament\Resources\PengaduanSelesaiResource\Pages;

use App\Filament\Resources\PengaduanSelesaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaduanSelesai extends EditRecord
{
    protected static string $resource = PengaduanSelesaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
