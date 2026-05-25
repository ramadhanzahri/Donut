<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — Mawmaw Donut</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Playfair+Display:ital,wght@0,700;1,600&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      height: 100%;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh;
      background: #1a0a10;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      -webkit-font-smoothing: antialiased;
    }

    /* ── Background blobs ── */
    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(72px);
      opacity: .38;
      pointer-events: none;
      animation: blobFloat 8s ease-in-out infinite;
    }

    .blob-1 {
      width: 520px;
      height: 520px;
      background: radial-gradient(circle, #e91e8c 0%, #880e4f 100%);
      top: -140px;
      right: -120px;
      animation-delay: 0s;
    }

    .blob-2 {
      width: 360px;
      height: 360px;
      background: radial-gradient(circle, #f48fb1 0%, #e91e8c 80%);
      bottom: -80px;
      left: -80px;
      opacity: .22;
      animation-delay: 3s;
    }

    .blob-3 {
      width: 220px;
      height: 220px;
      background: radial-gradient(circle, #ff4081 0%, #e91e8c 100%);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: .12;
      animation-delay: 5.5s;
    }

    @keyframes blobFloat {

      0%,
      100% {
        transform: translateY(0) scale(1);
      }

      40% {
        transform: translateY(-18px) scale(1.04);
      }

      70% {
        transform: translateY(10px) scale(.97);
      }
    }

    .blob-1 {
      animation-name: blobFloat1;
    }

    @keyframes blobFloat1 {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      40% {
        transform: translate(-16px, -22px) scale(1.05);
      }

      70% {
        transform: translate(12px, 10px) scale(.96);
      }
    }

    /* ── Card ── */
    .login-wrap {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 430px;
      padding: 16px;
    }

    .login-card {
      background: rgba(255, 255, 255, .97);
      border-radius: 22px;
      padding: 42px 40px 38px;
      box-shadow:
        0 2px 8px rgba(0, 0, 0, .1),
        0 20px 60px rgba(0, 0, 0, .32),
        0 0 0 1px rgba(255, 255, 255, .12);
      animation: cardIn .5s cubic-bezier(.22, 1, .36, 1);
    }

    @keyframes cardIn {
      from {
        opacity: 0;
        transform: translateY(30px) scale(.96);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* ── Header ── */
    .login-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #e91e8c, #ff4081);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin: 0 auto 20px;
      box-shadow: 0 8px 24px rgba(233, 30, 140, .38);
    }

    .login-card h1 {
      text-align: center;
      font-family: 'Playfair Display', serif;
      font-size: 24px;
      color: #1a0a10;
      margin-bottom: 6px;
    }

    .login-card .subtitle {
      text-align: center;
      font-size: 13px;
      color: #b07090;
      margin-bottom: 30px;
    }

    /* ── Alert ── */
    .alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 15px;
      border-radius: 10px;
      font-size: 13px;
      margin-bottom: 20px;
    }

    .alert-error {
      background: #ffebee;
      border: 1px solid #ef9a9a;
      color: #c62828;
    }

    .alert-success {
      background: #e8f5e9;
      border: 1px solid #a5d6a7;
      color: #2e7d32;
    }

    /* ── Form ── */
    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .06em;
      color: #6d3252;
      margin-bottom: 7px;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 15px;
      color: #c89ab0;
      pointer-events: none;
    }

    .form-group input {
      width: 100%;
      padding: 13px 42px;
      border: 1.5px solid #f0c0d8;
      border-radius: 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      color: #1a0a10;
      background: #fff;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    .form-group input:focus {
      border-color: #e91e8c;
      box-shadow: 0 0 0 3px rgba(233, 30, 140, .1);
    }

    .form-group input.is-invalid {
      border-color: #e57373;
      background: #fff8f8;
    }

    .field-error {
      font-size: 12px;
      color: #c62828;
      margin-top: 5px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    /* Toggle password */
    .pwd-toggle {
      position: absolute;
      right: 13px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #c89ab0;
      font-size: 15px;
      padding: 4px;
      line-height: 1;
      transition: color .2s;
    }

    .pwd-toggle:hover {
      color: #e91e8c;
    }

    /* ── Submit button ── */
    .btn-login {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #e91e8c, #ff4081);
      color: #fff;
      border: none;
      border-radius: 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 6px;
      box-shadow: 0 6px 22px rgba(233, 30, 140, .32);
      transition: opacity .2s, transform .15s, box-shadow .2s;
      position: relative;
      overflow: hidden;
    }

    .btn-login::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, .12);
      opacity: 0;
      transition: opacity .2s;
    }

    .btn-login:hover::before {
      opacity: 1;
    }

    .btn-login:hover {
      transform: translateY(-1px);
      box-shadow: 0 10px 28px rgba(233, 30, 140, .36);
    }

    .btn-login:active {
      transform: scale(.98);
    }

    /* ── Footer ── */
    .login-footer {
      text-align: center;
      margin-top: 22px;
      font-size: 13px;
      color: #b07090;
    }

    .login-footer a {
      color: #e91e8c;
      text-decoration: none;
      font-weight: 600;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }

    /* ── Dots decoration ── */
    .dots {
      position: absolute;
      bottom: 28px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 8px;
      z-index: 5;
    }

    .dots span {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .22);
    }

    .dots span:nth-child(2) {
      background: rgba(255, 255, 255, .5);
      width: 20px;
      border-radius: 3px;
    }
  </style>
</head>

<body>

  <!-- Blobs dekoratif -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
  <div class="dots">
    <span></span><span></span><span></span><span></span>
  </div>

  <div class="login-wrap">
    <div class="login-card">

      <!-- Icon -->
      <div class="login-icon" aria-hidden="true">🍩</div>
      <h1>Mawmaw Donut</h1>
      <p class="subtitle">Masuk ke panel administrasi</p>

      <!-- Alert error (auth gagal) -->
      @if($errors->has('auth'))
      <div class="alert alert-error" role="alert">
        🔐 {{ $errors->first('auth') }}
      </div>
      @elseif(session('success'))
      <div class="alert alert-success" role="alert">
        ✅ {{ session('success') }}
      </div>
      @endif

      <!-- Form -->
      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Username --}}
        <div class="form-group">
          <label for="username">Username</label>
          <div class="input-wrap">
            <span class="input-icon">👤</span>
            <input
              type="text"
              id="username"
              name="username"
              placeholder="Masukkan username"
              value="{{ old('username') }}"
              autocomplete="username"
              autofocus
              class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
              required>
          </div>
          @error('username')
          <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-wrap">
            <span class="input-icon">🔒</span>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Masukkan password"
              autocomplete="current-password"
              class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
              required>
            <button type="button"
              class="pwd-toggle"
              id="pwdToggle"
              aria-label="Tampilkan password">
              👁
            </button>
          </div>
          @error('password')
          <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login">
          <span id="btnText">🚀 Masuk ke Dashboard</span>
        </button>

      </form>

      <!-- Back to website -->
      <div class="login-footer">
        <a href="{{ route('beranda') }}">← Kembali ke Website</a>
      </div>

    </div>
  </div>

  <script>
    // Toggle show/hide password
    (function() {
      var btn = document.getElementById('pwdToggle');
      var input = document.getElementById('password');
      var visible = false;

      if (btn && input) {
        btn.addEventListener('click', function() {
          visible = !visible;
          input.type = visible ? 'text' : 'password';
          btn.textContent = visible ? '🙈' : '👁';
          btn.setAttribute('aria-label', visible ? 'Sembunyikan password' : 'Tampilkan password');
        });
      }

      // Loading state saat submit
      var form = document.querySelector('form');
      var btnText = document.getElementById('btnText');
      if (form && btnText) {
        form.addEventListener('submit', function() {
          btnText.textContent = '⏳ Memproses...';
        });
      }
    })();
  </script>
</body>

</html>