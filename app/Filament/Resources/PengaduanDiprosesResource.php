<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanDiprosesResource\Pages;
use App\Filament\Resources\PengaduanDiprosesResource\RelationManagers;
use App\Models\PengaduanDiproses;
use App\Models\PengaduanDitolak;
use App\Models\PengaduanMasuk;
use App\Models\PengaduanSelesai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaduanDiprosesResource extends Resource
{
    protected static ?string $model = PengaduanDiproses::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Jumlah Pengaduan Diproses';

    protected static ?string $navigationGroup = 'Pengaduan';

    protected static ?string $navigationLabel = 'Pengaduan Diproses';

    protected static ?string $pluralLabel = 'Pengaduan Diproses';

    protected static ?int $navigationSort = 5;

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

                Tables\Columns\TextColumn::make('tanggal_pengaduan_diproses')
                    ->date()
                    ->label('Tanggal')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengaduanMasuk.kategori.kategori')
                    ->searchable()
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengaduanMasuk.masyarakat.nama')
                    ->searchable()
                    ->label('Pelapor')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('pengaduanMasuk.foto'),

                Tables\Columns\TextColumn::make('pengaduanMasuk.isi_laporan')
                    ->searchable()
                    ->label('Keterangan')
                    ->limit(10)
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengaduanMasuk.status')
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

                Tables\Actions\Action::make('selesai')
                    ->label('Selesaikan Pengaduan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (PengaduanDiproses $record) {
                        $record->pengaduanMasuk->update(['status' => 'Selesai']);

                        PengaduanSelesai::create([
                            'pengaduan_masuk_id' => $record->id,
                            'users_id' => auth()->id(),
                            'tanggal_pengaduan_selesai' => now(),
                            'tanggal_pengaduan_diproses' => $record->tanggal_pengaduan_diproses,
                        ]);

                        PengaduanDiproses::where('pengaduan_masuk_id', $record->id)->delete();
                    }),

                Tables\Actions\Action::make('ditolak')
                    ->label('Tolak Pengaduan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (PengaduanDiproses $record) {
                        $record->pengaduanMasuk->update(['status' => 'Ditolak']);

                        PengaduanDitolak::create([
                            'pengaduan_masuk_id' => $record->id,
                            'users_id' => auth()->id(),
                            'tanggal_pengaduan_ditolak' => now(),
                        ]);

                        PengaduanDiproses::where('pengaduan_masuk_id', $record->id)->delete();
                    }),

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
            'index' => Pages\ListPengaduanDiproses::route('/'),
            'create' => Pages\CreatePengaduanDiproses::route('/create'),
            'edit' => Pages\EditPengaduanDiproses::route('/{record}/edit'),
        ];
    }
}
