<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\MenuItem;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Blok Kiri: Info Pesanan Utama
                Select::make('table_id')
                    ->relationship('table', 'table_number')
                    ->required()
                    ->label('Nomor Meja'),
                    
                Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu (Baru)',
                        'dimasak' => 'Sedang Dimasak',
                        'disajikan' => 'Telah Disajikan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->required()
                    ->default('menunggu')
                    ->label('Status Pesanan'),

                Select::make('payment_status')
                ->label('Status Pembayaran')
                ->options([
                    'unpaid' => 'Belum Bayar',
                    'paid' => 'Lunas',
                    'failed' => 'Gagal',
                ])
                ->required(),

                // Blok Bawah: Daftar Menu yang Dipesan (REPEATER)
                Repeater::make('orderItems') // Nama relasi yang kita buat di Model Order
                    ->relationship()
                    ->schema([
                        Select::make('menu_item_id')
                            ->relationship(
                                name: 'menuItem', 
                                titleAttribute: 'name',
                                // Kasir cuma bisa pilih menu yang status is_available = true (Tersedia)
                                modifyQueryUsing: fn ($query) => $query->where('is_available', true)
                            )
                            ->required()
                            ->label('Pilih Menu')
                            ->searchable()
                            ->live() // Bikin sistem merespon langsung saat menu dipilih
                            ->afterStateUpdated(function ($state, Set $set) {
                                // Cek harga dari database, lalu isi otomatis ke kotak 'price'
                                $menu = MenuItem::find($state);
                                if ($menu) {
                                    $set('price', $menu->price);
                                }
                            })
                            ->columnSpan(2),

                        TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->label('Jumlah')
                            ->columnSpan(1),

                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->readOnly() // Dikunci biar kasir gak bisa iseng ubah harga
                            ->label('Harga Satuan (Rp)')
                            ->columnSpan(1),
                    ])
                    ->columns(4) // Menata agar rapi menyamping
                    ->columnSpanFull() // Biar kotak repeatern-nya lebar full
                    ->defaultItems(1) // Munculkan 1 baris kosong secara default
                    ->addActionLabel('Tambah Menu Lain'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('Order ID')
                ->sortable()
                ->searchable(),

            TextColumn::make('table.table_number') // Memanggil relasi nama meja
                ->label('Meja')
                ->sortable()
                ->searchable(),

            TextColumn::make('total_price')
                ->label('Total Harga')
                ->money('IDR', locale: 'id') // Otomatis format ke Rupiah (Rp)
                ->sortable(),

            TextColumn::make('status')
                ->label('Status Pesanan')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'menunggu' => 'danger',   // Merah: Baru masuk, belum diproses
                    'dimasak' => 'warning',   // Kuning: Dapur lagi kerja
                    'disajikan' => 'info',    // Biru: Makanan lagi dianter
                    'selesai' => 'success',   // Hijau: Udah bayar & selesai
                    'dibatalkan' => 'gray',   // Abu-abu: Batal
                    default => 'primary',
                }),
            
            TextColumn::make('payment_status')
                ->label('Status Bayar')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'paid' => 'success',    // Warna Hijau
                    'unpaid' => 'danger',   // Warna Merah
                    'failed' => 'warning',  // Warna Kuning (opsional kalau ada transaksi gagal)
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'paid' => 'Lunas',
                    'unpaid' => 'Belum Bayar',
                    'failed' => 'Gagal',
                    default => $state,
                })
                ->sortable()
                ->searchable(),

            TextColumn::make('created_at')
                ->label('Waktu Pesan')
                ->dateTime('d M Y, H:i') // Format tanggal dan jam rapi
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
