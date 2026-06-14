<x-filament-panels::page>
    {{-- Refresh halaman secara diam-diam tiap 10 detik --}}
    <div wire:poll.10s>
        {{-- Period Selector --}}

    {{-- Period Selector --}}
    <div class="inline-flex rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-1 gap-1 mb-6">
        @foreach ($periodOptions as $key => $label)
            <button
                wire:click="$set('period', '{{ $key }}')"
                class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all
                    {{ $period === $key
                        ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm border border-gray-200 dark:border-gray-600'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}"
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center shrink-0">
                <x-heroicon-o-banknotes class="w-5 h-5 text-amber-500" />
            </div>
            <div class="min-w-0">
                <p class="text-xs text-gray-400 uppercase tracking-widest mb-0.5">Total Pendapatan</p>
                <p class="text-lg font-bold text-gray-900 dark:text-white truncate">
                    Rp {{ number_format($revenueData['total'], 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center shrink-0">
                <x-heroicon-o-shopping-bag class="w-5 h-5 text-indigo-500" />
            </div>
            <div class="min-w-0">
                <p class="text-xs text-gray-400 uppercase tracking-widest mb-0.5">Total Transaksi</p>
                <p class="text-lg font-bold text-gray-900 dark:text-white">
                    {{ number_format($revenueData['count'], 0, ',', '.') }} order
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center shrink-0">
                <x-heroicon-o-arrow-trending-up class="w-5 h-5 text-green-500" />
            </div>
            <div class="min-w-0">
                <p class="text-xs text-gray-400 uppercase tracking-widest mb-0.5">Rata-rata per Order</p>
                <p class="text-lg font-bold text-gray-900 dark:text-white truncate">
                    Rp {{ number_format($revenueData['average'], 0, ',', '.') }}
                </p>
            </div>
        </div>

    </div>

    {{-- Grafik Pendapatan --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 mb-6">
        <div class="flex items-center gap-2 mb-5">
            <x-heroicon-o-arrow-trending-up class="w-4 h-4 text-indigo-500" />
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Grafik Pendapatan</h3>
        </div>
        {{-- wire:ignore agar canvas tidak di-replace Livewire --}}
        <div wire:ignore>
            <div id="revenueChartWrapper" style="position: relative; height: 240px;">
                <canvas id="revenueChart" role="img" aria-label="Grafik pendapatan cafe per periode"></canvas>
            </div>
            <div id="revenueChartEmpty" class="hidden">
                <div class="flex flex-col items-center justify-center py-12 text-gray-300 dark:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <p class="text-sm">Belum ada data transaksi untuk periode ini.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Terlaris + Jam Ramai --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Menu Terlaris --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center gap-2 mb-5">
                <x-heroicon-o-fire class="w-4 h-4 text-amber-500" />
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Menu Terlaris</h3>
            </div>
            @if($topMenus->isEmpty())
                <div class="flex flex-col items-center justify-center py-10 text-gray-300 dark:text-gray-600">
                    <x-heroicon-o-face-frown class="w-8 h-8 mb-2" />
                    <p class="text-sm">Belum ada data.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($topMenus as $index => $item)
                        @php
                            $maxQty    = $topMenus->max('total_qty');
                            $pct       = $maxQty > 0 ? ($item->total_qty / $maxQty) * 100 : 0;
                            $barColors = ['bg-amber-400','bg-amber-300','bg-yellow-200','bg-gray-300','bg-gray-200'];
                            $medals    = ['🥇','🥈','🥉','4','5'];
                        @endphp
                        <div>
                            <div class="flex justify-between items-center text-sm mb-1.5">
                                <span class="font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1.5">
                                    <span>{{ $medals[$index] }}</span>
                                    {{ $item->menuItem?->name ?? 'Menu dihapus' }}
                                </span>
                                <span class="text-xs font-semibold text-gray-400">{{ $item->total_qty }} porsi</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                                <div class="{{ $barColors[$index] ?? 'bg-gray-200' }} h-1.5 rounded-full transition-all duration-700"
                                    style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Jam Ramai --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center gap-2 mb-5">
                <x-heroicon-o-clock class="w-4 h-4 text-indigo-500" />
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Jam Ramai</h3>
            </div>
            {{-- wire:ignore agar canvas tidak di-replace Livewire --}}
            <div wire:ignore>
                <div id="hoursChartWrapper" style="position: relative; height: 220px;">
                    <canvas id="hoursChart" role="img" aria-label="Grafik jam ramai kunjungan pelanggan"></canvas>
                </div>
                <div id="hoursChartEmpty" class="hidden">
                    <div class="flex flex-col items-center justify-center py-10 text-gray-300 dark:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="text-sm">Belum ada data.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Data jembatan: TANPA wire:ignore agar Livewire bebas update data-attribute --}}
    <div
        id="chartData"
        class="hidden"
        data-revenue-labels="{{ json_encode($revenueChartLabels) }}"
        data-revenue-data="{{ json_encode($revenueChartData) }}"
        data-hours-labels="{{ json_encode($busiestHoursLabels) }}"
        data-hours-data="{{ json_encode($busiestHoursData) }}"
    ></div>

    {{-- Script: wire:ignore agar tidak dieksekusi ulang tiap Livewire update --}}
    <div wire:ignore>
        <script>
            (function loadChartJs() {
                if (window.Chart) { initCharts(); return; }
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js';
                script.onload = initCharts;
                document.head.appendChild(script);
            })();

            function initCharts() {
                if (!window.Chart) return;

                const isDark    = document.documentElement.classList.contains('dark');
                const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
                const textColor = isDark ? '#9ca3af' : '#6b7280';

                const chartDataEl = document.getElementById('chartData');
                if (!chartDataEl) return;

                const revenueLabels = JSON.parse(chartDataEl.dataset.revenueLabels || '[]');
                const revenueData   = JSON.parse(chartDataEl.dataset.revenueData   || '[]');
                const hoursLabels   = JSON.parse(chartDataEl.dataset.hoursLabels   || '[]');
                const hoursData     = JSON.parse(chartDataEl.dataset.hoursData     || '[]');

                // ── Revenue Chart ──────────────────────────
                const revenueWrapper = document.getElementById('revenueChartWrapper');
                const revenueEmpty   = document.getElementById('revenueChartEmpty');
                const revenueCanvas  = document.getElementById('revenueChart');

                if (revenueLabels.length === 0) {
                    if (revenueWrapper) revenueWrapper.classList.add('hidden');
                    if (revenueEmpty)   revenueEmpty.classList.remove('hidden');
                } else {
                    if (revenueWrapper) revenueWrapper.classList.remove('hidden');
                    if (revenueEmpty)   revenueEmpty.classList.add('hidden');

                    if (revenueCanvas) {
                        const existing = Chart.getChart(revenueCanvas);
                        if (existing) existing.destroy();
                        new Chart(revenueCanvas, {
                            type: 'line',
                            data: {
                                labels: revenueLabels,
                                datasets: [{
                                    data: revenueData,
                                    borderColor: '#6366f1',
                                    backgroundColor: 'rgba(99,102,241,0.08)',
                                    borderWidth: 2,
                                    pointBackgroundColor: '#6366f1',
                                    pointRadius: 5,
                                    pointHoverRadius: 7,
                                    tension: 0.4,
                                    fill: true,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: {
                                        callbacks: {
                                            label: ctx => 'Rp ' + Number(ctx.raw).toLocaleString('id-ID')
                                        }
                                    }
                                },
                                scales: {
                                    x: { ticks: { color: textColor, font: { size: 11 } }, grid: { color: gridColor } },
                                    y: {
                                        ticks: { color: textColor, font: { size: 11 }, callback: v => 'Rp ' + Number(v).toLocaleString('id-ID') },
                                        grid: { color: gridColor }
                                    }
                                }
                            }
                        });
                    }
                }

                // ── Hours Chart ────────────────────────────
                const hoursWrapper = document.getElementById('hoursChartWrapper');
                const hoursEmpty   = document.getElementById('hoursChartEmpty');
                const hoursCanvas  = document.getElementById('hoursChart');

                if (hoursLabels.length === 0) {
                    if (hoursWrapper) hoursWrapper.classList.add('hidden');
                    if (hoursEmpty)   hoursEmpty.classList.remove('hidden');
                } else {
                    if (hoursWrapper) hoursWrapper.classList.remove('hidden');
                    if (hoursEmpty)   hoursEmpty.classList.add('hidden');

                    if (hoursCanvas) {
                        const existing = Chart.getChart(hoursCanvas);
                        if (existing) existing.destroy();
                        new Chart(hoursCanvas, {
                            type: 'line',
                            data: {
                                labels: hoursLabels,
                                datasets: [{
                                    data: hoursData,
                                    borderColor: '#f59e0b',
                                    backgroundColor: 'rgba(245,158,11,0.08)',
                                    borderWidth: 2,
                                    pointBackgroundColor: '#f59e0b',
                                    pointRadius: 5,
                                    pointHoverRadius: 7,
                                    tension: 0.4,
                                    fill: true,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    x: { ticks: { color: textColor, font: { size: 11 } }, grid: { color: gridColor } },
                                    y: { ticks: { color: textColor, font: { size: 11 }, stepSize: 1 }, grid: { color: gridColor } }
                                }
                            }
                        });
                    }
                }
            }

            window.addEventListener('periodUpdated', () => {
                // Beri jeda sedikit agar Livewire selesai update DOM (Hidden Div)
                setTimeout(initCharts, 150);
            });

            // Opsional: Jika ingin grafiknya me-render ulang otomatis tiap kali halaman di-refresh oleh wire:poll
            document.addEventListener('livewire:initialized', () => {
                Livewire.hook('morph.updated', ({ component, el }) => {
                    // Render ulang chart jika ada pembaruan DOM dari backend
                    setTimeout(initCharts, 150);
                });
            });
        </script>
    </div>

</x-filament-panels::page>