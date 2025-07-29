@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
    <h1>Edit Pesanan: {{ $order->order_number ?? '#' . $order->id }}</h1>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Detail Pesanan (Read-only) --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Produk:</strong> {{ $order->product_name }} <br>
                        <strong>Kuantitas:</strong> {{ $order->quantity }} pcs <br>
                        <strong>Ukuran:</strong> {{ $order->size }} | <strong>Warna:</strong> {{ $order->color }}
                    </div>
                    <div class="col-md-6">
                        <strong>Tanggal Pesan:</strong> {{ $order->order_date->format('d M Y') }} <br>
                        <strong>Pengiriman:</strong> {{ $order->shipping_method }} (Rp
                        {{ number_format($order->shipping_cost) }})
                    </div>
                </div>
                <hr>

                {{-- Form yang bisa di-edit --}}
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                        id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}">
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        name="phone_number" value="{{ old('phone_number', $order->phone_number) }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $order->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order_status" class="form-label">Status Pesanan</label>
                    <select class="form-select @error('order_status') is-invalid @enderror" id="order_status"
                        name="order_status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}"
                                {{ old('order_status', $order->order_status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('order_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan Tambahan</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes', $order->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Pesanan</button>
            </form>
        </div>
    </div>
@endsection
