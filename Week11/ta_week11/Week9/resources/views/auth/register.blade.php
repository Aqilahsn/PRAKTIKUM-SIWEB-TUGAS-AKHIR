<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register — Risol Majesty</title>
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
    .wrap{position:relative;z-index:1;width:100%;max-width:440px;padding:16px;animation:muncul 0.5s ease both}
    @keyframes muncul{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)}}
    .card-box{background:rgba(24,13,6,0.95);border:1px solid var(--border);border-radius:22px;padding:40px 36px 34px;box-shadow:0 24px 60px rgba(0,0,0,0.55)}
    .brand-dot{width:42px;height:42px;background:linear-gradient(135deg,var(--amber),var(--gold));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#FAF6F1;margin-bottom:16px}
    .eyebrow{font-size:0.7rem;letter-spacing:0.22em;text-transform:uppercase;color:var(--amber);display:block;margin-bottom:5px}
    .judul{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;color:var(--cream);line-height:1.2;margin-bottom:4px}
    .judul em{font-style:italic;color:var(--gold)}
    .sub{font-size:0.82rem;color:var(--muted);margin-bottom:26px}
    .form-label{font-size:0.72rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);display:block;margin-bottom:7px}
    .form-control{width:100%;background:rgba(255,255,255,0.04);border:1px solid var(--border);border-radius:10px;padding:11px 14px;font-family:'DM Sans',sans-serif;font-size:0.92rem;color:var(--cream);outline:none;transition:border-color 0.25s}
    .form-control::placeholder{color:rgba(155,134,117,0.45)}
    .form-control:focus{background:rgba(255,255,255,0.07);border-color:var(--amber);box-shadow:0 0 0 3px rgba(200,98,42,0.13)}
    .btn-submit{width:100%;background:linear-gradient(135deg,var(--amber),var(--gold));border:none;color:#FAF6F1;font-family:'DM Sans',sans-serif;font-size:0.85rem;font-weight:500;padding:12px 20px;border-radius:99px;cursor:pointer;transition:all 0.25s;margin-top:8px}
    .btn-submit:hover{background:linear-gradient(135deg,var(--brown),var(--amber));transform:translateY(-2px)}
    .link-nav{color:var(--muted);font-size:0.83rem;text-decoration:none}
    .link-nav:hover{color:var(--cream)}
    .error-text{color:#ECA090;font-size:0.78rem;margin-top:4px;display:block}
  </style>
</head>
<body>
  <div class="bg-glow-1"></div>
  <div class="bg-glow-2"></div>
  <div class="bg-grid"></div>
  <div class="wrap">
    <div class="card-box">
      <div class="brand-dot"><i class="bi bi-person-plus"></i></div>
      <span class="eyebrow">Risol Majesty · Daftar Akun</span>
      <h1 class="judul">Buat <em>Akun Baru</em></h1>
      <p class="sub">Daftar untuk mulai menggunakan aplikasi</p>

      @if($errors->any())
      <div style="background:rgba(180,45,40,0.12);border:1px solid rgba(180,45,40,0.3);border-radius:10px;color:#ECA090;font-size:0.83rem;padding:10px 14px;margin-bottom:18px;">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <ul class="mb-0 ps-3">
          @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="name" class="form-control" placeholder="Nama Anda" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="email@gmail.com" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
        </div>
        <div class="mb-4">
          <label class="form-label">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
        </div>
        <button type="submit" class="btn-submit">
          <i class="bi bi-person-check me-2"></i>Daftar Sekarang
        </button>
      </form>

      <div class="text-center mt-3" style="display:flex;justify-content:space-between;align-items:center;">
        <a href="{{ route('home') }}" class="link-nav"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
        <a href="{{ route('login') }}" class="link-nav">Sudah punya akun? <span style="color:var(--gold);">Login</span></a>
      </div>
    </div>
  </div>
</body>
</html>
