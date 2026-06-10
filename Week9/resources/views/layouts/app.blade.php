<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Risol Majesty — Artisan Snacks')</title>
  <meta name="description" content="@yield('meta_description', 'Risol Majesty - Artisan snacks dengan cita rasa premium handcrafted.')">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>

<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">Risol Majesty</a>

    <button class="navbar-toggler border-0" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarNav"
      style="color: rgba(247,240,232,0.8);">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
        </li>
        <li class="nav-item">
          <button class="nav-link btn btn-link" id="themeToggle" style="color: rgba(247,240,232,0.8);">
            <i class="bi bi-moon-fill"></i>
          </button>
        </li>

        @auth
          @if(auth()->user()->role === 'admin')
          <li class="nav-item">
            <a class="nav-link fw-500" href="{{ route('products') }}">
              <i class="bi bi-grid me-1"></i> Kelola Produk
            </a>
          </li>
          @endif

          {{-- Badge Role --}}
          <li class="nav-item">
            <span class="badge ms-1 me-2" style="background: {{ auth()->user()->role === 'admin' ? 'linear-gradient(135deg,#e76f51,#f4a261)' : 'rgba(200,98,42,0.25)' }}; color: {{ auth()->user()->role === 'admin' ? '#fff' : '#f4a261' }}; border-radius: 99px; font-size: 0.7rem; padding: 4px 10px;">
              {{ strtoupper(auth()->user()->role) }}
            </span>
          </li>

          <li class="nav-item">
            <div class="d-flex align-items-center gap-2 ms-2" style="border-left: 1px solid rgba(247,240,232,0.2); padding-left: 15px;">
              <div style="width:36px;height:36px;background:linear-gradient(135deg,#e76f51,#f4a261);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:16px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
              <span style="color: rgba(247,240,232,0.9); font-size: 14px;">{{ auth()->user()->name }}</span>
              <form action="{{ route('logout') }}" method="POST" class="d-inline m-0 p-0" style="margin-left:10px;padding-left:10px;border-left:1px solid rgba(247,240,232,0.2);">
                @csrf
                <button type="submit" class="nav-link btn btn-link" style="color: rgba(247,240,232,0.8); padding: 0;" title="Logout">
                  <i class="bi bi-box-arrow-right"></i>
                </button>
              </form>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link fw-500" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-500" href="{{ route('register') }}"><i class="bi bi-person-plus me-1"></i>Register</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- ===== ALERT GLOBAL ===== -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert" style="border-radius:12px;">
  <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert" style="border-radius:12px;">
  <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- ===== KONTEN HALAMAN ===== -->
@yield('content')

<!-- ===== FOOTER ===== -->
<footer class="text-center">
  <div class="container">
    <p class="mb-0">&copy; {{ date('Y') }} Risol Majesty. Semua hak cipta dilindungi.</p>
    <small>Sistem Manajemen Stok Produk</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Theme Toggle
  const btnTheme = document.getElementById('themeToggle');
  const body = document.body;
  if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    if (btnTheme) btnTheme.innerHTML = '<i class="bi bi-sun-fill"></i>';
  }
  if (btnTheme) {
    btnTheme.addEventListener('click', function() {
      body.classList.toggle('dark-mode');
      if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        btnTheme.innerHTML = '<i class="bi bi-sun-fill"></i>';
      } else {
        localStorage.removeItem('theme');
        btnTheme.innerHTML = '<i class="bi bi-moon-fill"></i>';
      }
    });
  }
</script>
@stack('scripts')

</body>
</html>
