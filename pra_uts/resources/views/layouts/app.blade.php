<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce') - Toko Online Modern</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(auth()->check())
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    Keranjang
                                    @if(session()->has('cart') && count(session()->get('cart')) > 0)
                                        <span class="badge">{{ count(session()->get('cart')) }}</span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <span class="nav-link">{{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6">
                    <h4>Tentang Kami</h4>
                    <p style="color: #cbd5e0; font-size: 14px;">Toko online terpercaya dengan produk berkualitas dan harga terbaik.</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>Kategori</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="#">Elektronik</a></li>
                        <li><a href="#">Gaming</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Olahraga</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>Bantuan</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>Sosial Media</h4>
                    <p style="color: #cbd5e0;">
                        <a href="#">Instagram</a><br>
                        <a href="#">Facebook</a><br>
                        <a href="#">Twitter</a>
                    </p>
                </div>
            </div>
            <div style="border-top: 1px solid #2d3748; padding-top: 20px; text-align: center; color: #cbd5e0;">
                <p style="margin: 0;">&copy; 2026 E-Commerce Modern. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alert messages after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    @yield('js')
</body>
</html>
