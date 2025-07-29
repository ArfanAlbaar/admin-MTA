@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
    <h1>Tambah Produk Baru</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        @include('admin.products.partials.form')
    </form>
@endsection
