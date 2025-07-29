{{-- filepath: resources/views/admin/returns/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Return')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Return</h1>
        <a href="{{ route('admin.returns.report.pdf') }}" class="btn btn-primary">
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
                    <th>Kode Return</th>
                    <th>No. Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Produk Return</th>
                    <th>Tanggal Return</th>
                    <th>Status</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($returns as $return)
                    <tr>
                        <td>{{ $return->return_code }}</td>
                        <td>{{ $return->order_number }}</td>
                        <td>{{ $return->customer_name }}</td>
                        <td>{{ $return->return_product_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($return->return_date)->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('admin.returns.update', $return->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <select name="status_return" class="form-select form-select-sm"
                                        onchange="this.form.submit()">
                                        @foreach (['Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Menunggu Barang Diterima', 'Barang Diterima', 'Selesai', 'Dibatalkan'] as $status)
                                            <option value="{{ $status }}"
                                                {{ $return->status_return == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.returns.show', $return->id) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data return.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link Paginasi jika ada --}}
    {{-- {{ $returns->links() }} --}}
@endsection
