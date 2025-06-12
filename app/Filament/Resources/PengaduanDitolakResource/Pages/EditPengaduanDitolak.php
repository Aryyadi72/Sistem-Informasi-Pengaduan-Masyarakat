<?php

namespace App\Filament\Resources\PengaduanDitolakResource\Pages;

use App\Filament\Resources\PengaduanDitolakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaduanDitolak extends EditRecord
{
    protected static string $resource = PengaduanDitolakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
