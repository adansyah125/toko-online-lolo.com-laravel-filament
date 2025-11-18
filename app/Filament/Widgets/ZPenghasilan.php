<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class ZPenghasilan extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penghasilan';

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    public function mount(): void
    {
        $this->year = request()->get('year', now()->year); // default tahun sekarang
    }
    public ?int $year = null;

    protected function getData(): array
    {
        $penghasilan = Order::selectRaw("MONTH(created_at) as bulan, SUM(total_harga) as total")
            ->whereYear("created_at", $this->year)
            ->groupBy("bulan")
            ->pluck("total", "bulan")
            ->toArray();

        // Isi data 12 bulan, yang kosong = 0
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $penghasilan[$i] ?? 0;
        }
        return [
            'datasets' => [
                [
                    'label' => "Penghasilan Tahun {$this->year}",
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
