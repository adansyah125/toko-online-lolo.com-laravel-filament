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
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('user.name')
                    ->alignCenter()
                    ->searchable()
                    ->sortable()
                    ->label('Pembeli'),
                TextColumn::make('order_id')
                    ->alignCenter()
                    ->searchable()
                    ->sortable()
                    ->label('Kode. Pesanan'),
                TextColumn::make('payment_status')
                    ->alignCenter()
                    ->searchable()
                    ->sortable()
                    ->label('Status Pembayaran'),
                TextColumn::make('order_status')
                    ->alignCenter()
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->colors([
                        'warning' => 'proses',
                        'info' => 'kirim',
                        'success' => 'selesai',
                    ])
                    ->label('Status Pesanan'),
                TextColumn::make('price')
                    ->alignCenter()
                    ->label('Total Harga')
                    ->money('IDR', locale: 'ID'),

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label('Update Status Pesanan')
                    ->icon('heroicon-o-arrow-path'),
            ])

            ->headerActions([
                Tables\Actions\Action::make('cetak_laporan')
                    ->label('Cetak Laporan')
                    ->icon('heroicon-o-printer')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')->label('Dari tanggal'),
                        Forms\Components\DatePicker::make('end_date')->label('Sampai tanggal'),
                    ])
                    ->action(function (array $data) {
                        $query = Payment::query();

                        if ($data['start_date']) {
                            $query->whereDate('created_at', '>=', $data['start_date']);
                        }

                        if ($data['end_date']) {
                            $query->whereDate('created_at', '<=', $data['end_date']);
                        }

                        $payments = $query->get();

                        // BUAT PDF
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.payment-report', [
                            'payments' => $payments,
                            'start'    => $data['start_date'],
                            'end'      => $data['end_date'],
                        ]);

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, 'laporan-transaksi.pdf');
                    }),
            ])
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
            // 'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
