<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pengesahan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengesahanResource\Pages;
use App\Filament\Resources\PengesahanResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class PengesahanResource extends Resource
{
    protected static ?string $model = Pengesahan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function getNavigationLabel(): string{
        return "Pengesahan";
    }

    public static function getPluralModelLabel(): string{
        return "Pengesahan";
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

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
                // TextColumn::make('pengajuan.user.nik')->label('Nik'),
                // TextColumn::make('pengajuan.user.name')->label('Nama'),
                TextColumn::make('nik'),
                TextColumn::make('pengajuan.nama_koperasi')->label('Nama Koperasi'),
                TextColumn::make('pengajuan.nama_ketua')->label('Ketua Koperasi'),
                TextColumn::make('pengajuan.alamat_koperasi')->label('Alamat Koperasi'),
                TextColumn::make('pengajuan.no_npak')->label('No NPAK'),
                TextColumn::make('pengajuan.kategorikoperasi.jenis_koperasi')->label('Jenis Koperasi'),
                TextColumn::make('pengajuan.status')
                ->label('Status')
                ->badge()
                ->icon("heroicon-o-check-badge")
                ->color('success'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Cetak Laporan')
                    ->color('warning')
                    ->defaultFormat('pdf')
                    ->color('warning')
                    ->modalHeading('Konfirmasi Export')
                    ->fileName('laporan-pengesahan'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPengesahans::route('/'),
            // 'create' => Pages\CreatePengesahan::route('/create'),
            // 'edit' => Pages\EditPengesahan::route('/{record}/edit'),
        ];
    }
}
