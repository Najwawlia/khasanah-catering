@extends('layouts.admin')
@section('title', 'Pesanan - Admin')
@section('admin-title', 'Pesanan')

@section('styles')
<style>
    .view-toggle {
        display: inline-flex;
        background: var(--border-2);
        border-radius: 30px;
        padding: 3px;
        gap: 2px;
        flex-shrink: 0;
    }
    .view-toggle button {
        border: none;
        background: transparent;
        padding: 7px 16px;
        border-radius: 30px;
        font-size: .78rem;
        font-weight: 600;
        color: var(--ink-3);
        cursor: pointer;
        font-family: inherit;
        transition: all var(--d) var(--e);
    }
    .view-toggle button.active {
        background: var(--surface);
        color: var(--accent);
        box-shadow: 0 1px 4px rgba(33,25,19,.1);
    }

    /* --- KANBAN BOARD (papan tiket dapur) --- */
    .kanban-board {
        display: grid;
        grid-template-columns: repeat(4, minmax(230px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
        align-items: start;
    }
    @media (max-width: 1100px) { .kanban-board { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 620px)  { .kanban-board { grid-template-columns: 1fr; } }

    .kanban-col-head {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        padding: 0 2px;
    }
    .kanban-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
    .kanban-col-title {
        font-family: 'Fraunces', Georgia, serif;
        font-size: .9rem;
        font-weight: 600;
        color: var(--ink);
    }
    .kanban-col-count {
        margin-left: auto;
        font-family: 'JetBrains Mono', monospace;
        font-size: .66rem;
        color: var(--ink-3);
        background: var(--border-2);
        padding: 2px 8px;
        border-radius: 20px;
    }
    .kanban-col-body { display: flex; flex-direction: column; gap: 10px; min-height: 60px; }

    .ticket {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 15px;
        transition: all var(--d) var(--e);
    }
    .ticket:hover { box-shadow: 0 6px 18px rgba(33,25,19,.09); transform: translateY(-2px); }

    .ticket-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
    .ticket-code { font-family: 'JetBrains Mono', monospace; font-size: .68rem; font-weight: 600; color: var(--accent); }
    .ticket-name { font-weight: 700; font-size: .88rem; color: var(--ink); margin-bottom: 3px; }
    .ticket-meta { font-size: .72rem; color: var(--ink-3); margin-bottom: 10px; }
    .ticket-divider { border-top: 1.5px dashed var(--border); margin: 10px 0; }
    .ticket-foot { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
    .ticket-amt { font-weight: 700; font-size: .82rem; color: var(--ink); }
    .ticket-next {
        display: inline-flex; align-items: center; gap: 5px;
        background: var(--accent-s); color: var(--accent);
        border: none; padding: 6px 11px; border-radius: 20px;
        font-size: .7rem; font-weight: 700; cursor: pointer;
        transition: all var(--d); white-space: nowrap;
    }
    .ticket-next:hover { background: var(--accent); color: #fff; }
    .ticket-done-badge { display: inline-flex; align-items: center; gap: 5px; color: var(--green); font-size: .72rem; font-weight: 700; }

    .kanban-empty {
        border: 1.5px dashed var(--border);
        border-radius: 10px;
        padding: 18px 10px;
        text-align: center;
        color: var(--ink-4);
        font-size: .74rem;
    }
</style>
@endsection

@section('content')
<div class="ph" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
    <div>
        <h1 class="ph-title">Data Pesanan</h1>
        <p class="ph-sub">Kelola booking, verifikasi pembayaran, dan update progress dapur.</p>
    </div>
    <div class="view-toggle">
        <button type="button" id="btnViewBoard" class="active" onclick="switchOrderView('board')">
            <i class="fa-solid fa-table-cells-large"></i> Papan
        </button>
        <button type="button" id="btnViewTable" onclick="switchOrderView('table')">
            <i class="fa-solid fa-list"></i> Tabel
        </button>
    </div>
</div>

<!-- ============ KANBAN BOARD VIEW (papan tiket dapur) ============ -->
<div id="orderBoardView">
    @php
        $stages = [
            'booking_received' => ['label' => 'Booking Diterima', 'color' => 'var(--coral)', 'next' => 'payment_verified', 'nextLabel' => 'Verifikasi'],
            'payment_verified' => ['label' => 'Pembayaran Diverifikasi', 'color' => 'var(--gold)', 'next' => 'kitchen_prep', 'nextLabel' => 'Mulai Masak'],
            'kitchen_prep'      => ['label' => 'Diproses Dapur', 'color' => 'var(--accent)', 'next' => 'ready', 'nextLabel' => 'Tandai Siap'],
            'ready'             => ['label' => 'Siap Diambil / Dikirim', 'color' => 'var(--green)', 'next' => null, 'nextLabel' => null],
        ];
        $grouped = $orders->groupBy('tracking_status');
    @endphp

    <div class="kanban-board">
        @foreach($stages as $key => $stage)
            <div class="kanban-col">
                <div class="kanban-col-head">
                    <span class="kanban-dot" style="background: {{ $stage['color'] }};"></span>
                    <span class="kanban-col-title">{{ $stage['label'] }}</span>
                    <span class="kanban-col-count">{{ $grouped->get($key, collect())->count() }}</span>
                </div>
                <div class="kanban-col-body">
                    @forelse($grouped->get($key, collect()) as $order)
                        <div class="ticket">
                            <div class="ticket-top">
                                <span class="ticket-code">{{ $order->order_code }}</span>
                                <a href="{{ route('admin.orders.show', $order->id) }}" title="Lihat Detail" style="color: var(--ink-3);">
                                    <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: .68rem;"></i>
                                </a>
                            </div>
                            <div class="ticket-name">{{ $order->customer_name }}</div>
                            <div class="ticket-meta">
                                <i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}
                            </div>
                            <div class="ticket-divider"></div>
                            <div class="ticket-foot">
                                <span class="ticket-amt">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                @if($stage['next'])
                                    <form action="{{ route('admin.orders.update_tracking', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="tracking_status" value="{{ $stage['next'] }}">
                                        <button type="submit" class="ticket-next">
                                            {{ $stage['nextLabel'] }} <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="ticket-done-badge"><i class="fa-solid fa-circle-check"></i> Selesai</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="kanban-empty">Tidak ada pesanan</div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- ============ CLASSIC TABLE VIEW ============ -->
<div id="orderTableView" style="display:none;">
    <div class="box">
        <div class="box-body" style="padding-bottom:0;">
            <form action="{{ route('admin.orders.index') }}" method="GET"
                  style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                <div class="srch" style="flex:1; min-width:200px; max-width:300px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" placeholder="Kode order atau nama..." value="{{ request('search') }}">
                </div>
                <select name="status" onchange="this.form.submit()" class="fsel">
                    <option value="">Semua Status</option>
                    <option value="booking_received"  {{ request('status')=='booking_received'  ? 'selected':'' }}>Booking Diterima</option>
                    <option value="payment_verified" {{ request('status')=='payment_verified' ? 'selected':'' }}>Pembayaran Diverifikasi</option>
                    <option value="kitchen_prep"     {{ request('status')=='kitchen_prep'     ? 'selected':'' }}>Persiapan Dapur</option>
                    <option value="ready"            {{ request('status')=='ready'            ? 'selected':'' }}>Siap Dikirim</option>
                </select>
                @if(request('search')||request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-g btn-sm"><i class="fa-solid fa-xmark"></i> Reset</a>
                @endif
            </form>
        </div>
        <div class="t-wrap" style="margin-top:12px;">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th><th>Customer</th><th>No. WA</th>
                        <th>Tgl Acara</th><th>Total</th><th>Bayar</th><th>Progress</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="t-acc">{{ $order->order_code }}</td>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div class="t-av">{{ strtoupper(substr($order->customer_name,0,1)) }}</div>
                                    <span class="t-bold">{{ $order->customer_name }}</span>
                                </div>
                            </td>
                            <td class="t-mono">{{ $order->customer_phone }}</td>
                            <td class="t-mono">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                            <td>
                                <div class="t-bold">Rp {{ number_format($order->total_amount,0,',','.') }}</div>
                                <div class="t-muted">{{ $order->payment_type==='dp_50' ? 'DP 50%':'Full' }}</div>
                            </td>
                            <td>
                                @if($order->payment_status==='pending')
                                    <span class="tag t-warn"><span class="tag-dot" style="background:var(--gold);"></span>Pending</span>
                                @elseif($order->payment_status==='paid')
                                    <span class="tag t-ok"><span class="tag-dot" style="background:var(--green);"></span>Lunas</span>
                                @elseif($order->payment_status==='dp_paid')
                                    <span class="tag t-acc-t"><span class="tag-dot" style="background:var(--accent);"></span>DP Paid</span>
                                @elseif($order->payment_status==='cancelled')
                                    <span class="tag t-err"><span class="tag-dot" style="background:var(--red);"></span>Batal</span>
                                @else
                                    <span class="tag t-neu">{{ strtoupper($order->payment_status) }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.update_tracking', $order->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <select name="tracking_status" onchange="this.form.submit()"
                                            class="tsel tsel-{{ $order->tracking_status }}">
                                        <option value="booking_received"  {{ $order->tracking_status=='booking_received'  ? 'selected':'' }}>1. Booking</option>
                                        <option value="payment_verified" {{ $order->tracking_status=='payment_verified' ? 'selected':'' }}>2. Terverifikasi</option>
                                        <option value="kitchen_prep"     {{ $order->tracking_status=='kitchen_prep'     ? 'selected':'' }}>3. Dapur</option>
                                        <option value="ready"            {{ $order->tracking_status=='ready'            ? 'selected':'' }}>4. Siap</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-g btn-sm btn-sq" title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus pesanan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-r btn-sm btn-sq" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center; color:var(--ink-3); padding:2.5rem 0; font-size:.8rem;">
                                <i class="fa-solid fa-clipboard-list" style="font-size:1.3rem; display:block; margin-bottom:8px; opacity:.35;"></i>
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function switchOrderView(mode) {
        var board = document.getElementById('orderBoardView');
        var table = document.getElementById('orderTableView');
        var bBtn = document.getElementById('btnViewBoard');
        var tBtn = document.getElementById('btnViewTable');
        if (mode === 'board') {
            board.style.display = '';
            table.style.display = 'none';
            bBtn.classList.add('active');
            tBtn.classList.remove('active');
        } else {
            board.style.display = 'none';
            table.style.display = '';
            tBtn.classList.add('active');
            bBtn.classList.remove('active');
        }
        try { localStorage.setItem('khc_order_view', mode); } catch (e) {}
    }
    (function () {
        try {
            var saved = localStorage.getItem('khc_order_view');
            if (saved === 'table') switchOrderView('table');
        } catch (e) {}
    })();
</script>
@endsection
