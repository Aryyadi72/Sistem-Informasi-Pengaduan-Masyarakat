<?php

namespace App\Filament\Resources\PengaduanMasukResource\Pages;

use App\Filament\Resources\PengaduanMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaduanMasuk extends EditRecord
{
    protected static string $resource = PengaduanMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
