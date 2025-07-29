@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1>Edit Produk: {{ $product->name }}</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
        id="productForm">
        @csrf
        @method('PUT')
        @include('admin.products.partials.form', ['product' => $product])
    </form>
@endsection
