<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventTypeResource\Pages;


use App\Models\EventType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventTypeResource extends Resource
{
    protected static ?string $model = EventType::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Event Types';
    protected static ?string $modelLabel = 'Event Type';
    protected static ?string $pluralModelLabel = 'Event Types';
    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Event Type Name')
                    ->helperText('Contoh: Wedding, Corporate, Birthday Party'),

                Forms\Components\TextInput::make('capacity')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->label('Capacity')
                    ->helperText('Jumlah maksimal tamu atau peserta'),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(4)
                    ->label('Description')
                    ->nullable()
                    ->helperText('Deskripsi singkat tentang jenis acara ini'),

                Forms\Components\TextInput::make('icon_class')
                    ->default('bi-calendar-event')
                    ->label('Icon Class')
                    ->helperText('Gunakan kelas dari Bootstrap Icons, misal: bi-gift, bi-briefcase'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Event Type'),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->tooltip(fn (Tables\Columns\TextColumn $column): ?string => $column->getState())
                    ->label('Description'),

                Tables\Columns\TextColumn::make('icon_class')
                    ->label('Icon Class')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEventTypes::route('/'),
            'create' => Pages\CreateEventType::route('/create'),
            'edit' => Pages\EditEventType::route('/{record}/edit'),
        ];
    }
}
