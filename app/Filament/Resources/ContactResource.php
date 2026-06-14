<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;


use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Contact Info';
    protected static ?string $modelLabel = 'Contact Information';
    protected static ?string $pluralModelLabel = 'Contact Informations';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email_1')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Primary Email'),

                Forms\Components\TextInput::make('email_2')
                    ->email()
                    ->maxLength(255)
                    ->nullable()
                    ->label('Secondary Email')
                    ->helperText('Opsional'),

                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20)
                    ->label('Phone Number')
                    ->helperText('Contoh: +6281234567890'),

                Forms\Components\Textarea::make('address')
                    ->columnSpanFull()
                    ->rows(4)
                    ->required()
                    ->label('Alamat Kantor / Cafe'),

                Forms\Components\Textarea::make('office_hours')
                    ->rows(4)
                    ->required()
                    ->label('Jam Kerja / Operasional')
                    ->helperText('Contoh: Mon-Fri: 9 AM - 5 PM'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email_1')
                    ->searchable()
                    ->sortable()
                    ->label('Email Utama'),

                Tables\Columns\TextColumn::make('email_2')
                    ->searchable()
                    ->label('Email Cadangan'),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Nomor Telepon'),

                Tables\Columns\TextColumn::make('address')
                    ->limit(50)
                    ->tooltip(fn (Tables\Columns\TextColumn $column): ?string => $column->getState())
                    ->label('Alamat'),

                Tables\Columns\TextColumn::make('office_hours')
                    ->limit(50)
                    ->tooltip(fn (Tables\Columns\TextColumn $column): ?string => $column->getState())
                    ->label('Jam Operasional'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
