<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pengajuan;
use App\Models\Pengesahan;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\KategoriKoperasi;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PengajuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengajuanResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    public static function getNavigationLabel():string{
        return "Pengajuan";
    }

    public static function getPluralModelLabel():string{
        return "Pengajuan";
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('userId')
                            ->label('User')
                            ->options(User::where('role', 'user')->pluck('name', 'id'))
                            ->reactive()
                            ->searchable()
                            ->required(),
                        DatePicker::make('tgl_pengajuan')
                            ->required(),
                        TextInput::make('no_npak')
                            ->required(),
                        TextInput::make('nama_koperasi')
                            ->required(),
                        Select::make('kategoriId')
                            ->label('Jenis Koperasi')
                            ->options(
                                KategoriKoperasi::all()->pluck('jenis_koperasi', 'id')
                            ),
                        TextInput::make('simpanan_pokok')
                            ->label('Besaran Simpanan Pokok')
                            ->required(),
                        TextInput::make('simpanan_wajib')
                            ->label('Besaran Simpanan Wajib')
                            ->required(),
                        TextInput::make('jumlah_pengurus')
                            ->required(),
                        TextInput::make('nama_ketua')
                            ->required(),
                        TextInput::make('nama_wakil')
                            ->required(),
                        TextInput::make('nama_sekretaris')
                            ->required(),
                        TextInput::make('nama_bendahara')
                            ->required(),
                        TextInput::make('pengawas')
                            ->required(),
                        TextInput::make('alamat_koperasi')
                            ->required(),
                        TextInput::make('rencana_kegiatan')
                            ->required(),
                        FileUpload::make('data_npak')
                            ->required()->downloadable()
                            ->disk('public')
                            ->directory('npak'),
                        
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.nik')->searchable()->label('Nik'),
                TextColumn::make('user.name')->searchable()->label('Nama'),
                TextColumn::make('tgl_pengajuan')->searchable(),
                TextColumn::make('no_npak')->searchable(),
                TextColumn::make('nama_koperasi')->searchable(),
                TextColumn::make('kategorikoperasi.jenis_koperasi')->searchable(),
                TextColumn::make('simpanan_pokok')->searchable()->money('IDR',true),
                TextColumn::make('simpanan_wajib')->searchable(),
                TextColumn::make('jumlah_pengurus')->searchable(),
                TextColumn::make('nama_ketua')->searchable(),
                TextColumn::make('nama_wakil')->searchable(),
                TextColumn::make('nama_sekretaris')->searchable(),
                TextColumn::make('nama_bendahara')->searchable(),
                TextColumn::make('pengawas')->searchable(),
                TextColumn::make('rencana_kegiatan')->searchable(),
                TextColumn::make('alamat_koperasi')->searchable(),
                TextColumn::make('data_npak')
                    ->url(fn($record)=> asset('storage/', $record->data_npak))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('warning')
                    ->formatStateUsing(fn() => 'Download File')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->icon(function($state){
                        if($state == "Menunggu Konfirmasi"){
                            return "heroicon-o-clock";
                        }else{
                            return "heroicon-o-check-badge";

                        }
                    })
                    ->color(function($state){
                        if($state == "Menunggu Konfirmasi"){
                            return "warning";
                        }else{
                            return "success";
                        }
                    })
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\Action::make('konfirmasi')
                    ->label('konfirmasi')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->modalHeading('Konfirmasi Pengajuan')
                    ->modalSubHeading('Apakah anda yakin?')
                    ->modalButton('Ya, Konfirmasi Pengajuan')
                    ->visible(fn($record) => $record->status === "Menunggu Konfirmasi")
                    ->action(function($record){
                        Pengajuan::where('id', $record->id)->update(["status" => "Telah Dikonfirmasi"]);
                        Pengesahan::create([
                            "pengajuanId" => $record->id,
                            "nik" => Str::padLeft((string) random_int(0, 9999999999999), 13, '0'),
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                


            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Cetak Laporan')
                    ->color('warning')
                    ->defaultFormat('pdf')
                    ->color('warning')
                    ->modalHeading('Konfirmasi Export')
                    ->fileName('laporan-pengajuan'),
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
            'index' => Pages\ListPengajuans::route('/'),
            // 'create' => Pages\CreatePengajuan::route('/create'),
            // 'edit' => Pages\EditPengajuan::route('/{record}/edit'),
        ];
    }
}
