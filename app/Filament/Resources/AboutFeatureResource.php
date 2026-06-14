<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutFeatureResource\Pages;
use App\Filament\Resources\AboutFeatureResource\RelationManagers;
use App\Models\AboutFeature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutFeatureResource extends Resource
{
    protected static ?string $model = AboutFeature::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'About Features';
    protected static ?string $modelLabel = 'About Feature';
    protected static ?string $pluralModelLabel = 'About Features';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('icon_class')
                    ->required()
                    ->default('bi-star')
                    ->helperText('Gunakan kelas ikon dari Bootstrap Icons, misal: bi-award, bi-shield-check'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Title')
                    ->helperText('Contoh: "Award Winning"'),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Description'),

                Forms\Components\TextInput::make('order_number')
                    ->numeric()
                    ->default(0)
                    ->label('Order Number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon_class')
                    ->label('Icon Class')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->label('Title'),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->wrap()
                    ->label('Description'),

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
            'index' => Pages\ListAboutFeatures::route('/'),
            'create' => Pages\CreateAboutFeature::route('/create'),
            'edit' => Pages\EditAboutFeature::route('/{record}/edit'),
        ];
    }
}
