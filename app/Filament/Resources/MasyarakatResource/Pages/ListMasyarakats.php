<?php

namespace App\Filament\Resources\MasyarakatResource\Pages;

use App\Filament\Resources\MasyarakatResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListMasyarakats extends ListRecords
{
    use HasResizableColumn;

    protected static string $resource = MasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Masyarakat')
                ->icon('heroicon-o-squares-plus')
                ->color('info'),
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color('success')
                ->icon('heroicon-o-arrow-up-on-square-stack'),
        ];
    }
}
