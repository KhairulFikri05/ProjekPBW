<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;


class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Location Info';
    protected static ?string $modelLabel = 'Location';
    protected static ?string $pluralModelLabel = 'Locations';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull()
                    ->label('Alamat Kantor')
                    ->helperText('Contoh: Jl. Raya No. 123, Bandung, Indonesia'),

                Forms\Components\Textarea::make('map_embed')
                    ->rows(5)
                    ->columnSpanFull()
                    ->label('Google Maps Embed Code')
                    ->helperText('Salin langsung kode embed iframe dari Google Maps')
                    ->placeholder('<iframe src="https://..." ...></iframe>'),

                Forms\Components\Textarea::make('hours')
                    ->rows(4)
                    ->columnSpanFull()
                    ->label('Jam Operasional')
                    ->helperText('Contoh: Mon-Fri: 10 AM - 10 PM\nSat-Sun: 9 AM - 11 PM'),

                Forms\Components\TextInput::make('contact_phone')
                    ->tel()
                    ->maxLength(20)
                    ->label('Nomor Kontak')
                    ->helperText('Contoh: +6281234567890'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->wrap()
                    ->limit(50),

                Tables\Columns\TextColumn::make('contact_phone')
                    ->label('Kontak')
                    ->searchable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Terakhir Diubah')
                    ->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            // Tidak ada relasi langsung
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
