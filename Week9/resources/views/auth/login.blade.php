<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Risol Majesty</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    :root{--amber:#C8622A;--gold:#E8974A;--cream:#F7F0E8;--brown:#6B3A22;--muted:#9B8675;--border:rgba(200,150,100,0.2)}
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'DM Sans',sans-serif;font-weight:300;min-height:100vh;display:flex;align-items:center;justify-content:center;background-color:#0D0805}
    .bg-glow-1{position:fixed;top:-120px;left:-120px;width:480px;height:480px;background:radial-gradient(circle,rgba(200,98,42,0.13) 0%,transparent 70%);pointer-events:none}
    .bg-glow-2{position:fixed;bottom:-80px;right:-80px;width:380px;height:380px;background:radial-gradient(circle,rgba(107,58,34,0.16) 0%,transparent 70%);pointer-events:none}
    .bg-grid{position:fixed;inset:0;background-image:linear-gradient(rgba(200,98,42,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(200,98,42,0.03) 1px,transparent 1px);background-size:55px 55px;pointer-events:none}
    .login-wrap{position:relative;z-index:1;width:100%;max-width:440px;padding:16px;animation:muncul 0.5s ease both}
    @keyframes muncul{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)}}
    .login-card{background:rgba(24,13,6,0.95);border:1px solid var(--border);border-radius:22px;padding:40px 36px 34px;box-shadow:0 24px 60px rgba(0,0,0,0.55)}
    .brand-dot{width:42px;height:42px;background:linear-gradient(135deg,var(--amber),var(--gold));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#FAF6F1;margin-bottom:16px}
    .eyebrow{font-size:0.7rem;letter-spacing:0.22em;text-transform:uppercase;color:var(--amber);display:block;margin-bottom:5px}
    .login-judul{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;color:var(--cream);line-height:1.2;margin-bottom:4px}
    .login-judul em{font-style:italic;color:var(--gold)}
    .login-sub{font-size:0.82rem;color:var(--muted);margin-bottom:26px}
    .form-label{font-size:0.72rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);display:block;margin-bottom:7px}
    .form-control{width:100%;background:rgba(255,255,255,0.04);border:1px solid var(--border);border-radius:10px;padding:11px 14px;font-family:'DM Sans',sans-serif;font-size:0.92rem;color:var(--cream);outline:none;transition:border-color 0.25s}
    .form-control::placeholder{color:rgba(155,134,117,0.45)}
    .form-control:focus{background:rgba(255,255,255,0.07);border-color:var(--amber);box-shadow:0 0 0 3px rgba(200,98,42,0.13)}
    .btn-login{width:100%;background:linear-gradient(135deg,var(--amber),var(--gold));border:none;color:#FAF6F1;font-family:'DM Sans',sans-serif;font-size:0.85rem;font-weight:500;padding:12px 20px;border-radius:99px;cursor:pointer;transition:all 0.25s;margin-top:8px}
    .btn-login:hover{background:linear-gradient(135deg,var(--brown),var(--amber));transform:translateY(-2px)}
    .link-kembali{color:var(--muted);font-size:0.83rem;text-decoration:none}
    .link-kembali:hover{color:var(--cream)}
    .login-hint{margin-top:20px;padding-top:16px;border-top:1px solid var(--border);font-size:0.77rem;color:var(--muted);text-align:center;line-height:1.7}
    .login-hint code{background:rgba(200,98,42,0.12);color:var(--gold);padding:1px 6px;border-radius:4px}
    .error-text{color:#ECA090;font-size:0.82rem;margin-top:4px;display:block}
  </style>
</head>
<body>
  <div class="bg-glow-1"></div>
  <div class="bg-glow-2"></div>
  <div class="bg-grid"></div>
  <div class="login-wrap">
    <div class="login-card">
      <div class="brand-dot"><i class="bi bi-shop"></i></div>
      <span class="eyebrow">Risol Majesty · Admin Panel</span>
      <h1 class="login-judul">Masuk ke <em>Dashboard</em></h1>
      <p class="login-sub">Silakan login untuk mengelola stok produk</p>

      @if($errors->any())
      <div style="background:rgba(180,45,40,0.12);border:1px solid rgba(180,45,40,0.3);border-radius:10px;color:#ECA090;font-size:0.83rem;padding:10px 14px;margin-bottom:18px;">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        @foreach($errors->all() as $error){{ $error }}@endforeach
      </div>
      @endif

      @if(session('status'))
      <div style="background:rgba(40,160,80,0.12);border:1px solid rgba(40,160,80,0.3);border-radius:10px;color:#86efac;font-size:0.83rem;padding:10px 14px;margin-bottom:18px;">
        {{ session('status') }}
      </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="admin@gmail.com" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn-login">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </form>

      <!-- Separator -->
      <div style="display:flex;align-items:center;margin:20px 0;gap:12px;">
        <div style="flex:1;height:1px;background:rgba(200,150,100,0.2);"></div>
        <span style="color:var(--muted);font-size:0.8rem;">atau masuk dengan</span>
        <div style="flex:1;height:1px;background:rgba(200,150,100,0.2);"></div>
      </div>

      <!-- Tombol Google OAuth -->
      <a href="{{ route('google.redirect') }}"
         style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:11px 20px;border-radius:99px;background:rgba(255,255,255,0.06);border:1px solid rgba(200,150,100,0.25);color:var(--cream);font-size:0.85rem;font-weight:500;text-decoration:none;transition:all 0.25s;"
         onmouseover="this.style.background='rgba(255,255,255,0.1)'"
         onmouseout="this.style.background='rgba(255,255,255,0.06)'">
        <svg width="18" height="18" viewBox="0 0 48 48">
          <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
          <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
          <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
          <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
        </svg>
        Login dengan Google
      </a>

      <div class="text-center mt-3" style="display:flex;justify-content:space-between;align-items:center;">
        <a href="{{ route('home') }}" class="link-kembali"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
        <a href="{{ route('register') }}" class="link-kembali">Belum punya akun? <span style="color:var(--gold);">Daftar</span></a>
      </div>

      <div class="login-hint">
        Demo Admin &nbsp;·&nbsp; email: <code>admin@gmail.com</code> &nbsp;·&nbsp; password: <code>admin123</code><br>
        Demo User &nbsp;·&nbsp; email: <code>user@gmail.com</code> &nbsp;·&nbsp; password: <code>user123</code>
      </div>
    </div>
  </div>
</body>
</html>
