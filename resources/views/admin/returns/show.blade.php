{{-- filepath: resources/views/admin/returns/detail.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Return')

@section('content')
    <h1>Detail Return</h1>
    <table class="table table-bordered">
        <tr>
            <th>Kode Return</th>
            <td>{{ $return->return_code }}</td>
        </tr>
        <tr>
            <th>No. Pesanan</th>
            <td>{{ $return->order_number }}</td>
        </tr>
        <tr>
            <th>Alasan Return</th>
            <td>{{ $return->return_reason }}</td>
        </tr>
        <tr>
            <th>Pelanggan</th>
            <td>{{ $return->customer_name }}</td>
        </tr>
        <tr>
            <th>Produk Return</th>
            <td>{{ $return->return_product_name }}</td>
        </tr>
        <tr>
            <th>Bukti Foto</th>
            <td>
                @if ($return->picture_proof)
                    <img src="{{ asset('storage/' . $return->picture_proof) }}" alt="Bukti" width="150">
                @else
                    Tidak ada
                @endif
            </td>
        </tr>
        <tr>
            <th>Bank</th>
            <td>{{ $return->bank_name }} - {{ $return->bank_number }} ({{ $return->name_bank_number }})</td>
        </tr>
        <tr>
            <th>Resi</th>
            <td>{{ $return->resi }}</td>
        </tr>
        <tr>
            <th>Catatan</th>
            <td>{{ $return->notes }}</td>
        </tr>
        <tr>
            <th>Tanggal Return</th>
            <td>{{ \Carbon\Carbon::parse($return->return_date)->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $return->status_return }}</td>
        </tr>
    </table>
    <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
