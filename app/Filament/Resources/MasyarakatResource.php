<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasyarakatResource\Pages;
use App\Filament\Resources\MasyarakatResource\RelationManagers;
use App\Models\Masyarakat;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MasyarakatResource extends Resource
{
    protected static ?string $model = Masyarakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Jumlah Masyarakat';

    protected static ?string $navigationGroup = 'Masyarakat';

    protected static ?string $navigationLabel = 'Masyarakat';

    protected static ?string $pluralLabel = 'Masyarakat';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()
                    ->schema([

                        Grid::make(2)
                            ->schema([
                                TextInput::make('nik')
                                    ->label('NIK')
                                    ->placeholder('Masukkan NIK')
                                    ->maxLength(14)
                                    ->required(),

                                TextInput::make('nama')
                                    ->label('Nama')
                                    ->placeholder('Masukkan Nama')
                                    ->maxLength(255)
                                    ->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('tempat_lahir')
                                    ->label('Tempat Lahir')
                                    ->placeholder('Masukkan Tempat Lahir')
                                    ->maxLength(255)
                                    ->required(),

                                DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('agama')
                                    ->label('Agama')
                                    ->placeholder('Masukkan Agama')
                                    ->maxLength(255),

                                TextInput::make('pekerjaan')
                                    ->label('Pekerjaan')
                                    ->placeholder('Masukkan Pekerjaan')
                                    ->maxLength(255)
                                    ->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->placeholder('Masukkan Jenis Kelamin')
                                    ->options([
                                        'Pria' => 'Pria',
                                        'Wanita' => 'Wanita'
                                    ])
                                    ->required()
                                    ->native(false),

                                TextInput::make('no_telp')
                                    ->label('Nomor Telepon')
                                    ->placeholder('Masukkan Nomor Telepon')
                                    ->maxLength(255),
                            ]),

                        Textarea::make('alamat')
                            ->label('Alamat')
                            ->placeholder('Masukkan Alamat')
                            ->maxLength(255)
                            ->required(),

                        FileUpload::make('foto')
                            ->label('Foto')
                            ->required()

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('foto'),

                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable()
                    ->limit(10)
                    ->sortable(),

                // TextColumn::make('tempat_lahir')
                //     ->label('Tempat Lahir')
                //     ->searchable()
                //     ->hidden(),

                // TextColumn::make('tanggal_lahir')
                //     ->label('Tanggal Lahir')
                //     ->searchable()
                //     ->hidden(),

                // TextColumn::make('tempat_dan_tanggal_lahir')
                //     ->label('Tempat & Tanggal Lahir')
                //     ->getStateUsing(function ($record) {
                //         return $record->tempat_lahir . ', ' . \Carbon\Carbon::parse($record->tanggal_lahir)->translatedFormat('d F Y');
                //     })
                //     ->searchable()
                //     ->sortable(),

                TextColumn::make('agama')
                    ->label('Agama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('no_telp')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make()
                //     ->label('Detail')
                //     ->color('gray'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->label('Opsi')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->color('primary')
                    ->button()
            ])
            ->headerActions([
                ExportAction::make()
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-on-square-stack')
                    ->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('nik')->heading('NIK'),
                            Column::make('nama')->heading('Nama'),
                            Column::make('alamat')->heading('Alamat'),
                            Column::make('tempat_lahir')->heading('Tempat Lahir'),
                            Column::make('tanggal_lahir')->heading('Tanggal Lahir'),
                            Column::make('agama')->heading('Agama'),
                            Column::make('pekerjaan')->heading('Pekerjaan'),
                            Column::make('jenis_kelamin')->heading('Jenis Kelamin'),
                            Column::make('no_telp')->heading('No. Telepon'),
                        ])
                            ->askForFilename()
                            ->askForWriterType()
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMasyarakats::route('/'),
            'create' => Pages\CreateMasyarakat::route('/create'),
            'edit' => Pages\EditMasyarakat::route('/{record}/edit'),
        ];
    }
}
