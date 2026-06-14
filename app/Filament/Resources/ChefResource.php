<?php
namespace App\Filament\Resources;

use App\Models\Chef;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChefResource\Pages;

class ChefResource extends Resource
{
    protected static ?string $model = Chef::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Chefs';
    protected static ?string $modelLabel = 'Chef';
    protected static ?string $pluralModelLabel = 'Chefs';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name')
                    ->helperText('Contoh: John Doe'),

                Forms\Components\TextInput::make('role')
                    ->required()
                    ->maxLength(100)
                    ->label('Role')
                    ->helperText('Contoh: Executive Chef'),

                Forms\Components\Textarea::make('bio')
                    ->columnSpanFull()
                    ->label('Biography')
                    ->helperText('Deskripsi singkat tentang koki ini'),

                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->disk('public')
                    ->directory('chefs')
                    ->visibility('public')
                    ->label('Foto Chef')
                    ->helperText('Ukuran 400x500 px disarankan'),

                Forms\Components\Textarea::make('awards')
                    ->columnSpanFull()
                    ->label('Penghargaan')
                    ->helperText('Gunakan format JSON atau tuliskan sebagai daftar')
                    ->default(null),

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
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Chef'),

                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->label('Peran'),

                Tables\Columns\TextColumn::make('order_number')
                    ->label('Urutan')
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
            'index' => Pages\ListChefs::route('/'),
            'create' => Pages\CreateChef::route('/create'),
            'edit' => Pages\EditChef::route('/{record}/edit'),
        ];
    }
}
