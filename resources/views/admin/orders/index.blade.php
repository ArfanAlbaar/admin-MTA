@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Pesanan</h1>
        <a href="{{ route('admin.orders.report.pdf') }}" class="btn btn-primary">
            Download PDF
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Status</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number ?? 'N/A' }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->order_date->format('d M Y') }}</td>
                        <td>{{ $order->product_name }} ({{ $order->quantity }} pcs)</td>
                        <td>
                            <span
                                class="badge 
                                @if ($order->order_status == 'pending') bg-secondary 
                                @elseif($order->order_status == 'shipping') bg-info 
                                @elseif($order->order_status == 'completed') bg-success 
                                @else bg-danger @endif">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">
                                Edit Status
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link Paginasi --}}
    {{ $orders->links() }}
@endsection
