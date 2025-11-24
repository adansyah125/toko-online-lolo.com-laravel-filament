<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = ' Transaksi';

    public static function getPluralLabel(): string
    {
        return 'Transaksi';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('order_status')
                    ->label('ubah status pesanan')
                    ->options([
                        'proses' => 'proses',
                        'kirim' => 'kirim',
                        'selesai' => 'selesai',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Pembeli'),
                TextColumn::make('order_id')
                    ->searchable()
                    ->sortable()
                    ->label('Kode. Pesanan'),
                TextColumn::make('payment_status')
                    ->searchable()
                    ->sortable()
                    ->label('Status Pembayaran'),
                TextColumn::make('order_status')
                    ->searchable()
                    ->sortable()
                    ->label('Status Pesanan'),
                TextColumn::make('price')
                    ->label('Total Harga')
                    ->money('IDR', locale: 'ID'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([])
            ->bulkActions([]);
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
