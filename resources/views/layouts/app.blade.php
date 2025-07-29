<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Manajemen Absurd Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/dashboard">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.users.index') }}">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.products.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.orders.index') }}">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.returns.index') }}">Retur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.record-chats.index') }}">Chat</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <span class="navbar-text text-white me-3">
                        Welcome, {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
