{{-- filepath: resources/views/admin/user/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container py-4" style="max-width: 500px;">
        <h2 class="mb-4">Edit User</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Password <span class="text-muted">(Kosongkan jika tidak ingin
                        ganti)</span></label>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
        </form>
    </div>
@endsection
