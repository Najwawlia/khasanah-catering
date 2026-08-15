@extends('layouts.admin')

@section('title', 'Data Pelanggan - Admin')
@section('admin-title', 'Data Pelanggan')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Data Pelanggan Terdaftar</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Daftar customer yang sudah membuat akun di website Khasanah Catering.</p>
    </div>
</div>

<div class="card-table">
    <form action="{{ route('admin.customers.index') }}" method="GET" style="margin-bottom: 1.5rem;">
        <div class="admin-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Cari nama, email, atau no. telepon..." value="{{ request('search') }}">
        </div>
    </form>

    <div class="table-scroll">
<table>
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Total Pesanan</th>
                <th>Total Belanja</th>
                <th>Bergabung Sejak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="table-avatar">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
                            <strong>{{ $customer->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                    <td>
                        <span class="pill-badge pill-olive">{{ $customer->orders_count }} pesanan</span>
                    </td>
                    <td><strong>Rp {{ number_format($customer->orders_sum_paid_amount ?? 0, 0, ',', '.') }}</strong></td>
                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem 0;">Belum ada pelanggan terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>

@endsection
