<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Filament\Resources\PengaduanResource\RelationManagers;
use App\Models\Kategori;
use App\Models\Masyarakat;
use App\Models\PengaduanMasuk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaduanResource extends Resource
{
    protected static ?string $model = PengaduanMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Jumlah Pengaduan';

    protected static ?string $navigationGroup = 'Pengaduan';

    protected static ?string $navigationLabel = 'Pengaduan';

    protected static ?string $pluralLabel = 'Pengaduan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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

                Filter::make('tanggal_pengaduan_masuk')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Dari tanggal'),
                        Forms\Components\DatePicker::make('created_until')->label('Sampai tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal_pengaduan_masuk', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal_pengaduan_masuk', '<=', $date),
                            );
                    }),

                SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->searchable()
                    ->options(
                        Kategori::all()->mapWithKeys(function ($kategori) {
                            return [
                                $kategori->id => $kategori->kategori,
                            ];
                        })->toArray()
                    ),

                SelectFilter::make('masyarakat_id')
                    ->label('Masyarakat')
                    ->searchable()
                    ->options(
                        Masyarakat::all()->mapWithKeys(function ($masyarakat) {
                            return [
                                $masyarakat->id => $masyarakat->nik . ' - ' . $masyarakat->nama,
                            ];
                        })->toArray()
                    ),

                SelectFilter::make('status')
                    ->label('Status')
                    ->searchable()
                    ->options(
                        PengaduanMasuk::pluck('status', 'status')->unique()
                    ),

            ])
            ->actions([
                //
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
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}
