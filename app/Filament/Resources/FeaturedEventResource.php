<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedEventResource\Pages;
use App\Models\FeaturedEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeaturedEventResource extends Resource
{
    protected static ?string $model = FeaturedEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Featured Events';
    protected static ?string $modelLabel = 'Featured Event';
    protected static ?string $pluralModelLabel = 'Featured Events';
    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('event_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Event Name')
                    ->helperText('Contoh: Wedding Party, Corporate Dinner'),

                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now()->addDays(7))
                    ->label('Tanggal Acara'),

                Forms\Components\TextInput::make('time')
                    ->required()
                    ->maxLength(50)
                    ->label('Waktu')
                    ->default('19:00 - 22:00')
                    ->helperText('Contoh: 18:00 - 21:00'),

                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255)
                    ->label('Lokasi')
                    ->default('Cafe Katumiri Hall'),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(5)
                    ->label('Deskripsi Acara')
                    ->helperText('Jelaskan sedikit tentang acara ini'),

                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->disk('public')
                    ->directory('events')
                    ->visibility('public')
                    ->label('Gambar Acara'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Poster'),

                Tables\Columns\TextColumn::make('event_name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Acara'),

                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label('Tanggal'),

                Tables\Columns\TextColumn::make('time')
                    ->label('Waktu'),

                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->label('Lokasi'),
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
            'index' => Pages\ListFeaturedEvents::route('/'),
            'create' => Pages\CreateFeaturedEvent::route('/create'),
            'edit' => Pages\EditFeaturedEvent::route('/{record}/edit'),
        ];
    }
}
