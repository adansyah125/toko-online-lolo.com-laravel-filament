<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {
        // Jumlah produk
        $jumlahProduk = Product::count();

        // Jumlah pengguna
        $jumlahUser = User::count();

        $penghasilan = Order::sum('total_harga');
        $formatPenghasilan = 'Rp ' . number_format($penghasilan, 0, ',', '.');

        return [
            Stat::make(' Produk', $jumlahProduk)
                ->description('Total produk yang tersedia')
                ->descriptionIcon('heroicon-m-inbox')
                ->color($jumlahProduk > 0 ? 'success' : 'danger'),

            Stat::make(' Pengguna', $jumlahUser)
                ->description('Total pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color($jumlahUser > 0 ? 'success' : 'danger'),
            Stat::make('Pendapatan', $formatPenghasilan)
                ->description('Total Pendapatan')
                ->descriptionIcon($penghasilan > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($penghasilan > 0 ? 'warning' : 'danger'),
        ];
    }
}
