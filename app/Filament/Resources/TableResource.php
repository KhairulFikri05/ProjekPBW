<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableResource\Pages;
use App\Filament\Resources\TableResource\RelationManagers;
use App\Models\Table as TableModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TableResource extends Resource
{
    protected static ?string $model = TableModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('table_number')
                    ->label('Nomor Meja')
                    ->required()
                    ->unique(ignoreRecord: true) // Mencegah nomor meja dobel
                    ->maxLength(255),
                    
                TextInput::make('capacity')
                    ->label('Kapasitas Kursi')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                    
                Select::make('status')
                    ->options([
                        'kosong' => 'Kosong',
                        'reservasi' => 'Reservasi',
                        'digunakan' => 'Digunakan',
                    ])
                    ->required()
                    ->default('kosong'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('table_number')
                    ->label('Nomor Meja')
                    ->searchable() // Biar bisa dicari
                    ->sortable(),  // Biar bisa diurutkan

                TextColumn::make('capacity')
                    ->label('Kapasitas (Orang)')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status Meja')
                    ->badge() // Biar tampilannya jadi kotak warna-warni keren
                    ->color(fn (string $state): string => match ($state) {
                        'kosong' => 'success',    // Warna Hijau
                        'reservasi' => 'warning', // Warna Kuning
                        'digunakan' => 'danger',  // Warna Merah
                        default => 'gray',
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }
}
