<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanMasukResource\Pages;
use App\Filament\Resources\PengaduanMasukResource\RelationManagers;
use App\Models\Kategori;
use App\Models\Masyarakat;
use App\Models\PengaduanDiproses;
use App\Models\PengaduanMasuk;
use Filament\Forms;
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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaduanMasukResource extends Resource
{
    protected static ?string $model = PengaduanMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Masuk')->count();
    }

    protected static ?string $navigationBadgeTooltip = 'Jumlah Pengaduan Masuk';

    protected static ?string $navigationGroup = 'Pengaduan';

    protected static ?string $navigationLabel = 'Pengaduan Masuk';

    protected static ?string $pluralLabel = 'Pengaduan Masuk';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()
                    ->schema([

                        Grid::make(2)
                            ->schema([
                                Select::make('masyarakat_id')
                                    ->label('Masyarakat')
                                    ->searchable()
                                    ->preload()
                                    ->options(
                                        Masyarakat::all()->mapWithKeys(function ($masyarakat) {
                                            return [
                                                $masyarakat->id => $masyarakat->nik . ' - ' . $masyarakat->nama,
                                            ];
                                        })->toArray()
                                    )->required(),

                                Select::make('kategori_id')
                                    ->label('Kategori')
                                    ->searchable()
                                    ->preload()
                                    ->options(
                                        Kategori::all()->mapWithKeys(function ($kategori) {
                                            return [
                                                $kategori->id => $kategori->kategori,
                                            ];
                                        })->toArray()
                                    )->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                DatePicker::make('tanggal_pengaduan_masuk')
                                    ->label('Tanggal')
                                    ->required(),

                                TextInput::make('status')
                                    ->label('Status')
                                    ->default('Masuk')
                                    ->readOnly()
                            ]),

                        FileUpload::make('foto')
                            ->label('Foto')
                            ->required(),

                        Textarea::make('isi_laporan')
                            ->label('Isi Laporan')
                            ->placeholder('Silahkan masukan keterangan detail')
                            ->maxLength(200)
                            ->required()

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('tanggal_pengaduan_masuk')
                    ->date()
                    ->label('Tanggal')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori.kategori')
                    ->searchable()
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\TextColumn::make('masyarakat.nama')
                    ->searchable()
                    ->label('Pelapor')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('foto'),

                Tables\Columns\TextColumn::make('isi_laporan')
                    ->searchable()
                    ->label('Keterangan')
                    ->limit(10)
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->color(fn(string $state): string => match ($state) {
                        'Masuk' => 'info',
                        'Diproses' => 'warning',
                        'Selesai' => 'success',
                        'Ditolak' => 'danger',
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\Action::make('proses')
                    ->label('Proses Pengaduan')
                    ->icon('heroicon-o-arrow-path')
                    ->button()
                    ->outlined()
                    ->size(ActionSize::Small)
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Proses Pengaduan')
                    ->modalDescription('Apakah Anda yakin ingin memproses pengaduan ini?')
                    ->action(function (PengaduanMasuk $record) {
                        $record->update(['status' => 'diproses']);

                        PengaduanDiproses::create([
                            'pengaduan_masuk_id' => $record->id,
                            'users_id' => auth()->id(),
                            'tanggal_pengaduan_diproses' => now(),
                        ]);
                    }),

                // Tables\Actions\ActionGroup::make([
                //     Tables\Actions\ViewAction::make()
                //         ->color('info'),
                //     Tables\Actions\EditAction::make()
                //         ->color('warning'),
                //     Tables\Actions\DeleteAction::make(),
                // ])
                //     ->tooltip('Opsi Aksi')
                //     ->icon('heroicon-m-ellipsis-vertical')
                //     ->size(ActionSize::Small)
                //     ->color('primary')
                //     ->button()
                //     ->label('')
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListPengaduanMasuks::route('/'),
            'create' => Pages\CreatePengaduanMasuk::route('/create'),
            'edit' => Pages\EditPengaduanMasuk::route('/{record}/edit'),
        ];
    }
}
