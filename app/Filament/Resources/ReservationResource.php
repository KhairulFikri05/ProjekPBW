<?php
namespace App\Filament\Resources;

use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReservationResource\Pages;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Reservations';
    protected static ?string $modelLabel = 'Reservation';
    protected static ?string $pluralModelLabel = 'Reservations';
    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Customer Name'),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Email Address'),

                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20)
                    ->label('Phone Number'),

                Forms\Components\TextInput::make('people')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->label('Number of People'),

                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Reservation Date')
                    ->default(now()),

                Forms\Components\TimePicker::make('time')
                    ->required()
                    ->label('Reservation Time'),

                Forms\Components\Textarea::make('message')
                    ->columnSpanFull()
                    ->label('Special Requests')
                    ->nullable(),

                Forms\Components\Select::make('table_id')
                    ->relationship(
                        name: 'table', 
                        titleAttribute: 'table_number',
                        // Trik sakti filter query database Filament:
                        modifyQueryUsing: fn (Builder $query, $record) => $query
                            ->where('status', 'kosong') // Hanya tampilkan meja yang kosong
                            ->when($record, fn ($q) => $q->orWhere('id', $record->table_id)) // Tapi kalau lagi EDIT, meja milik reservasi ini tetap dimunculkan
                    )
                    ->label('Pilih Meja')
                    ->searchable()
                    ->preload()
                    ->helperText('Hanya meja dengan status KOSONG yang akan muncul di pilihan.'),

                Forms\Components\Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->default('Pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Name'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Phone'),

                Tables\Columns\TextColumn::make('people')
                    ->label('People')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label('Date'),

                Tables\Columns\TextColumn::make('time')
                    ->label('Time'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match (ucfirst(strtolower($state))) {
                        'Confirmed' => 'success',
                        'Pending' => 'warning',
                        'Cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
