<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutStatResource\Pages;
use App\Filament\Resources\AboutStatResource\RelationManagers;
use App\Models\AboutStat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutStatResource extends Resource
{
    protected static ?string $model = AboutStat::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'About Stats';
    protected static ?string $modelLabel = 'Statistic';
    protected static ?string $pluralModelLabel = 'Statistics';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('stat_number')
                    ->required()
                    ->maxLength(50)
                    ->label('Stat Number')
                    ->helperText('Contoh: 15+, 100, dll'),

                Forms\Components\TextInput::make('stat_label')
                    ->required()
                    ->maxLength(100)
                    ->label('Stat Label')
                    ->helperText('Contoh: Years of Experience, Happy Customers, dll'),

                Forms\Components\TextInput::make('order_number')
                    ->numeric()
                    ->default(0)
                    ->label('Order Number')
                    ->helperText('Urutan tampilan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stat_number')
                    ->label('Number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('stat_label')
                    ->label('Label')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order')
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
            'index' => Pages\ListAboutStats::route('/'),
            'create' => Pages\CreateAboutStat::route('/create'),
            'edit' => Pages\EditAboutStat::route('/{record}/edit'),
        ];
    }
}
