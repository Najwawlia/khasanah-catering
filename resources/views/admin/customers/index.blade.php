@extends('layouts.admin')
@section('title', 'Pelanggan - Admin')
@section('admin-title', 'Pelanggan')
@section('content')
<div class="ph">
    <div>
        <h1 class="ph-title">Data Pelanggan</h1>
        <p class="ph-sub">Akun customer yang terdaftar di website Khasanah Catering.</p>
    </div>
</div>
<div class="box">
    <div class="box-body" style="padding-bottom:0;">
        <form action="{{ route('admin.customers.index') }}" method="GET" style="display:flex; gap:10px; flex-wrap:wrap;">
            <div class="srch" style="flex:1; min-width:200px; max-width:340px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari nama, email, atau telepon..." value="{{ request('search') }}">
            </div>
            @if(request('search'))
                <a href="{{ route('admin.customers.index') }}" class="btn btn-g btn-sm"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>
    </div>
    <div class="t-wrap" style="margin-top:12px;">
        <table>
            <thead>
                <tr>
                    <th>Pelanggan</th><th>Email</th><th>No. Telepon</th>
                    <th>Total Pesanan</th><th>Total Belanja</th><th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:9px;">
                                <div class="t-av">{{ strtoupper(substr($customer->name,0,1)) }}</div>
                                <span class="t-bold">{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td class="t-mono" style="font-size:.74rem;">{{ $customer->email }}</td>
                        <td class="t-mono">{{ $customer->phone ?? '—' }}</td>
                        <td><span class="tag t-acc-t">{{ $customer->orders_count }} pesanan</span></td>
                        <td class="t-bold">Rp {{ number_format($customer->orders_sum_paid_amount ?? 0,0,',','.') }}</td>
                        <td class="t-mono t-muted">{{ $customer->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:var(--ink-3); padding:2.5rem 0; font-size:.8rem;">
                            <i class="fa-solid fa-users" style="font-size:1.3rem; display:block; margin-bottom:8px; opacity:.35;"></i>
                            Belum ada pelanggan terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
