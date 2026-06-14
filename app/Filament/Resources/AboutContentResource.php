<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutContentResource\Pages;
use App\Filament\Resources\AboutContentResource\RelationManagers;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutContentResource extends Resource
{

    protected static ?string $model = AboutContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Content';
    protected static ?string $modelLabel = 'About Section';
    protected static ?string $pluralModelLabel = 'About Sections';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Title')
                    ->helperText('Contoh: "Our Culinary Journey"'),

                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label('Description'),

                Forms\Components\TextInput::make('chef_quote')
                    ->required()
                    ->maxLength(500)
                    ->label('Chef Quote')
                    ->helperText('Kutipan dari koki utama'),

                Forms\Components\FileUpload::make('chef_image')
                    ->image()
                    ->disk('public')
                    ->directory('about/chef-images')
                    ->visibility('public')
                    ->label('Foto Koki'),

                Forms\Components\TextInput::make('establishment_year')
                    ->numeric()
                    ->length(4)
                    ->required()
                    ->label('Tahun Pendirian'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('establishment_year')
                    ->label('Year Established')
                    ->sortable(),
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
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }
}
