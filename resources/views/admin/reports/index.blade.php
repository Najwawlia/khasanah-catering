@extends('layouts.admin')
@section('title', 'Laporan Penjualan - Admin')
@section('admin-title', 'Laporan')
@section('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endsection

@section('content')
<div class="ph">
    <div>
        <h1 class="ph-title">Laporan Penjualan</h1>
        <p class="ph-sub">Rekap omset bulanan dan performa menu terlaris.</p>
    </div>
</div>

{{-- STAT ROW --}}
<div class="stat-row" style="grid-template-columns:repeat(3,1fr); margin-bottom:22px;">
    <div class="stat">
        <div class="stat-label">Total Omset All-Time</div>
        <div class="stat-val accent" style="font-size:1.2rem;">Rp {{ number_format($totalRevenueAllTime,0,',','.') }}</div>
        <div class="stat-foot">Akumulasi seluruh transaksi</div>
    </div>
    <div class="stat">
        <div class="stat-label">Total Pesanan</div>
        <div class="stat-val">{{ $totalOrdersAllTime }}</div>
        <div class="stat-foot">Semua transaksi katering</div>
    </div>
    <div class="stat">
        <div class="stat-label">Rata-rata per Pesanan</div>
        <div class="stat-val" style="font-size:1.2rem;">Rp {{ number_format($avgOrderValue,0,',','.') }}</div>
        <div class="stat-foot">Average order value</div>
    </div>
</div>

<div class="g2">
    <div class="box">
        <div class="box-head">
            <div>
                <div class="box-title">Omset 6 Bulan Terakhir</div>
                <div class="box-sub">Tren pendapatan bulanan</div>
            </div>
        </div>
        <div class="box-body">
            <div class="ch-wrap"><canvas id="chart"></canvas></div>
        </div>
    </div>

    <div class="box">
        <div class="box-head">
            <div>
                <div class="box-title">Menu Paling Laris</div>
                <div class="box-sub">Berdasarkan total pack terjual</div>
            </div>
        </div>
        <div class="box-body" style="padding-top:8px;">
            @forelse($topMenus as $i => $menu)
                <div class="rrow">
                    <div class="rnum {{ $i===0?'rn1':($i===1?'rn2':($i===2?'rn3':'rnx')) }}">{{ $i+1 }}</div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-weight:700; font-size:.83rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $menu->menu_name }}</div>
                        <div class="t-mono" style="font-size:.68rem; color:var(--ink-3); margin-top:1px;">{{ $menu->total_pax }} pack terjual</div>
                    </div>
                    <div style="font-weight:800; color:var(--accent); font-size:.8rem; white-space:nowrap; font-family:'JetBrains Mono',monospace;">
                        Rp {{ number_format($menu->total_omset,0,',','.') }}
                    </div>
                </div>
            @empty
                <div style="text-align:center; color:var(--ink-3); padding:2rem 0; font-size:.8rem;">
                    <i class="fa-solid fa-chart-bar" style="font-size:1.2rem; opacity:.35; display:block; margin-bottom:8px;"></i>
                    Belum ada data penjualan.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
        datasets: [{
            label: 'Omset',
            data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
            backgroundColor: function(ctx) {
                const {chart: c} = ctx, {chartArea: a} = c;
                if (!a) return 'rgba(196,86,26,.7)';
                const g = c.ctx.createLinearGradient(0, a.top, 0, a.bottom);
                g.addColorStop(0, 'rgba(196,86,26,.85)');
                g.addColorStop(1, 'rgba(196,86,26,.35)');
                return g;
            },
            borderRadius: 6,
            borderSkipped: false,
            maxBarThickness: 48,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#191309',
                titleColor: '#D4C0AC',
                bodyColor: '#C4561A',
                padding: 12,
                borderColor: 'rgba(255,255,255,.08)',
                borderWidth: 1,
                callbacks: { label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID') }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(226,221,213,.7)' },
                ticks: {
                    color: '#8A7A6A',
                    font: { family: "'JetBrains Mono', monospace", size: 10 },
                    callback: v => v>=1000000 ? 'Rp'+(v/1000000).toFixed(1)+'jt' : 'Rp'+(v/1000)+'k'
                }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#8A7A6A', font: { family: "'JetBrains Mono', monospace", size: 10 } }
            }
        }
    }
});
</script>
@endsection
