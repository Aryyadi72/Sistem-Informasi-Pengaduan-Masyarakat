<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanDitolakResource\Pages;
use App\Filament\Resources\PengaduanDitolakResource\RelationManagers;
use App\Models\PengaduanDitolak;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaduanDitolakResource extends Resource
{
    protected static ?string $model = PengaduanDitolak::class;

    protected static ?string $navigationIcon = 'heroicon-o-x-circle';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Jumlah Pengaduan Ditolak';

    protected static ?string $navigationGroup = 'Pengaduan';

    protected static ?string $navigationLabel = 'Pengaduan Ditolak';

    protected static ?string $pluralLabel = 'Pengaduan Ditolak';

    protected static ?int $navigationSort = 7;

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

                Tables\Columns\TextColumn::make('tanggal_pengaduan_ditolak')
                    ->date()
                    ->label('Tanggal')
                    ->sortable(),

                Tables\Columns\TextColumn::make('PengaduanMasuk.kategori.kategori')
                    ->searchable()
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\TextColumn::make('PengaduanMasuk.masyarakat.nama')
                    ->searchable()
                    ->label('Pelapor')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('PengaduanMasuk.foto'),

                Tables\Columns\TextColumn::make('PengaduanMasuk.isi_laporan')
                    ->searchable()
                    ->label('Keterangan')
                    ->limit(10)
                    ->sortable(),

                Tables\Columns\TextColumn::make('PengaduanMasuk.status')
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
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPengaduanDitolaks::route('/'),
            'create' => Pages\CreatePengaduanDitolak::route('/create'),
            'edit' => Pages\EditPengaduanDitolak::route('/{record}/edit'),
        ];
    }
}
