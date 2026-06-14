<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class AnalyticsPage extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Analitik';
    protected static ?string $title           = 'Analitik Toko';
    protected static ?string $navigationGroup = null;
    protected static ?int    $navigationSort  = 2;

    protected static string $view = 'filament.pages.analytics-page';

    public string $period = 'today';

    // Public properties agar reaktif saat period berubah
    public array $revenueChartLabels = [];
    public array $revenueChartData   = [];
    public array $busiestHoursLabels = [];
    public array $busiestHoursData   = [];

    public function mount(): void
    {
        $this->loadChartData();
    }

    public function updatedPeriod(): void
    {
        $this->loadChartData();
        // Memaksa komponen chart di frontend agar memperbarui grafiknya saat di-klik
        $this->dispatch('periodUpdated');
    }

    public function loadChartData(): void
    {
        $revenueChart = $this->getRevenueChart();

        $labels = [];
        $data   = [];

        if ($this->period === 'today') {
            $chartDict = $revenueChart->pluck('total', 'label')->toArray();
            $keys = array_map('intval', array_keys($chartDict));
            $currentHour = (int) now()->format('H');
            $startHour = min($keys ?: [8]);
            $startHour = max(0, $startHour - 1); // Tambahkan padding 1 jam sebelumnya

            for ($i = $startHour; $i <= $currentHour; $i++) {
                $labels[] = str_pad((string) $i, 2, '0', STR_PAD_LEFT) . ':00';
                $val      = $chartDict[$i] ?? $chartDict[(string)$i] ?? $chartDict[str_pad((string)$i, 2, '0', STR_PAD_LEFT)] ?? 0;
                $data[]   = (float) $val;
            }
        } else {
            $days = $this->period === 'week' ? 6 : 29;
            $chartDict = $revenueChart->pluck('total', 'label')->toArray();

            for ($i = $days; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $dateString = $date->format('Y-m-d');
                $labels[] = $date->translatedFormat('d M');
                $val      = $chartDict[$dateString] ?? 0;
                $data[]   = (float) $val;
            }
        }

        $this->revenueChartLabels = $labels;
        $this->revenueChartData   = $data;

        $busiestHours = $this->getBusiestHours();
        $busiestHoursDict = $busiestHours->pluck('total_orders', 'hour')->toArray();

        $bHoursLabels = [];
        $bHoursData   = [];

        $bKeys = array_map('intval', array_keys($busiestHoursDict));
        $minHour = min($bKeys ?: [8]);
        $maxHour = max($bKeys ?: [22]);
        $minHour = max(0, $minHour - 1);
        $maxHour = min(23, $maxHour + 1);

        for ($i = $minHour; $i <= $maxHour; $i++) {
            $bHoursLabels[] = str_pad((string) $i, 2, '0', STR_PAD_LEFT) . ':00';
            $val            = $busiestHoursDict[$i] ?? $busiestHoursDict[(string)$i] ?? $busiestHoursDict[str_pad((string)$i, 2, '0', STR_PAD_LEFT)] ?? 0;
            $bHoursData[]   = (int) $val;
        }

        $this->busiestHoursLabels = $bHoursLabels;
        $this->busiestHoursData   = $bHoursData;
    }

    public function getPeriodOptions(): array
    {
        return [
            'today' => 'Hari Ini',
            'week'  => '7 Hari Terakhir',
            'month' => '30 Hari Terakhir',
        ];
    }

    public function getStartDate(): \Carbon\Carbon
    {
        return match ($this->period) {
            'week'  => now()->subDays(6)->startOfDay(),
            'month' => now()->subDays(29)->startOfDay(),
            default => now()->startOfDay(),
        };
    }

    public function getRevenueData(): array
    {
        $start = $this->getStartDate();

        // Pastikan status yang dicari sesuai kesepakatan ('paid')
        $query = Order::where('payment_status', 'paid')
                    ->where('created_at', '>=', $start);

        // Langsung jumlahkan dari kolom total_price di tabel orders
        $total = $query->sum('total_price');
        $count = $query->count();
        $avg   = $count > 0 ? $total / $count : 0;

        return [
            'total'   => (float) $total,
            'count'   => $count,
            'average' => (float) $avg,
        ];
    }

    public function getTopMenus(): \Illuminate\Support\Collection
    {
        $start = $this->getStartDate();

        return OrderItem::select(
                'menu_item_id',
                DB::raw('SUM(quantity) as total_qty'),
                DB::raw('SUM(price * quantity) as total_revenue')
            )
            ->whereHas('order', function ($q) use ($start) {
                // UBAH DI SINI: Sesuaikan dengan payment_status = paid
                $q->where('payment_status', 'paid')
                ->where('created_at', '>=', $start);
            })
            ->with('menuItem:id,name') // Pastikan relasi 'menuItem' ada di model OrderItem
            ->groupBy('menu_item_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();
    }

    public function getBusiestHours(): \Illuminate\Support\Collection
    {
        $start = $this->getStartDate();

        return Order::select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as total_orders')
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', $start)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
    }

    public function getRevenueChart(): \Illuminate\Support\Collection
    {
        $start = $this->getStartDate();

        if ($this->period === 'today') {
            return Order::select(
                    DB::raw('HOUR(created_at) as label'),
                    DB::raw('SUM(total_price) as total') // Langsung ambil total_price
                )
                ->where('payment_status', 'paid')
                ->where('created_at', '>=', $start)
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        return Order::select(
                DB::raw('DATE(created_at) as label'),
                DB::raw('SUM(total_price) as total') // Langsung ambil total_price
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', $start)
            ->groupBy('label')
            ->orderBy('label')
            ->get();
    }

    protected function getViewData(): array
    {
        return [
            'periodOptions' => $this->getPeriodOptions(),
            'revenueData'   => $this->getRevenueData(),
            'topMenus'      => $this->getTopMenus(),
            'busiestHours'  => $this->getBusiestHours(),
            'revenueChart'  => $this->getRevenueChart(),
        ];
    }
}