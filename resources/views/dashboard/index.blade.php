@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

{{-- ═══════════════════════════════════
     PAGE HEADER
═══════════════════════════════════ --}}
<div class="page-header">
  <h2>📊 Dashboard</h2>
  <p>
    Selamat datang, <strong>{{ Auth::user()->name }}</strong>
    &nbsp;·&nbsp;
    <span style="color:var(--text-light);">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
  </p>
</div>

{{-- ═══════════════════════════════════
     STAT CARDS
═══════════════════════════════════ --}}
<div class="stats-grid">

  <div class="stat-card">
    <div class="stat-icon" style="background:#fce4ec;">🍩</div>
    <div class="stat-body">
      <p>Total Produk</p>
      <h3>{{ $stats['total_produk'] }}</h3>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon" style="background:#e8f5e9;">✅</div>
    <div class="stat-body">
      <p>Produk Aktif</p>
      <h3>{{ $stats['aktif_produk'] }}</h3>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon" style="background:#fff8e1;">🏷️</div>
    <div class="stat-body">
      <p>Total Kategori</p>
      <h3>{{ $stats['total_kategori'] }}</h3>
    </div>
  </div>

  @if(Auth::user()->isSuperAdmin())
  <div class="stat-card">
    <div class="stat-icon" style="background:#e3f2fd;">👥</div>
    <div class="stat-body">
      <p>Total Admin</p>
      <h3>{{ $stats['total_user'] }}</h3>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon" style="background:#ede7f6;">🛡️</div>
    <div class="stat-body">
      <p>Super Admin</p>
      <h3>{{ $stats['superadmin'] }}</h3>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon" style="background:#fff0f5;">👤</div>
    <div class="stat-body">
      <p>Admin Biasa</p>
      <h3>{{ $stats['admin'] }}</h3>
    </div>
  </div>
  @endif

</div>

{{-- ═══════════════════════════════════
     2-COLUMN GRID: QUICK LINKS + PASSWORD
═══════════════════════════════════ --}}
<div class="dash-grid">

  {{-- ── Akses Cepat ── --}}
  <div class="card">
    <div class="card-top">
      <span class="card-title">🚀 Akses Cepat</span>
    </div>
    <div class="quick-links">

      <a href="{{ route('kategori.index') }}" class="quick-item">
        <div class="quick-icon" style="background:#fff8e1;">🏷️</div>
        <div class="quick-text">
          <strong>Kelola Kategori</strong>
          <span>Tambah / edit kategori produk</span>
        </div>
        <span class="quick-arrow">→</span>
      </a>

      <a href="{{ route('produk.index') }}" class="quick-item">
        <div class="quick-icon" style="background:#fce4ec;">🍩</div>
        <div class="quick-text">
          <strong>Kelola Produk</strong>
          <span>Tambah / edit data produk</span>
        </div>
        <span class="quick-arrow">→</span>
      </a>

      @if(Auth::user()->isSuperAdmin())
      <a href="{{ route('admins.index') }}" class="quick-item">
        <div class="quick-icon" style="background:#ede7f6;">👥</div>
        <div class="quick-text">
          <strong>Kelola Admin</strong>
          <span>Manajemen akun administrator</span>
        </div>
        <span class="quick-arrow">→</span>
      </a>
      @endif

      <a href="{{ route('beranda') }}" target="_blank" rel="noopener" class="quick-item">
        <div class="quick-icon" style="background:#e3f2fd;">🌐</div>
        <div class="quick-text">
          <strong>Lihat Website</strong>
          <span>Buka halaman publik di tab baru</span>
        </div>
        <span class="quick-arrow" style="opacity:.5;">↗</span>
      </a>

    </div>
  </div>

  {{-- ── Ganti Password ── --}}
  <div class="card">
    <div class="card-top">
      <span class="card-title">🔒 Ganti Password</span>
      <button class="btn-secondary" id="pwToggleBtn" onclick="togglePwForm()">
        ✏️ Ubah
      </button>
    </div>

    {{-- Collapsed info (default) --}}
    <div id="pwInfo" style="padding:28px 24px;display:flex;align-items:center;gap:16px;">
      <div style="width:52px;height:52px;background:var(--pink-pale);border-radius:14px;
                  display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">
        🔑
      </div>
      <div>
        <p style="font-size:14px;font-weight:600;margin-bottom:4px;">Password Akun</p>
        <p style="font-size:13px;color:var(--text-light);">
          Klik tombol <strong>Ubah</strong> untuk mengganti password login Anda.
        </p>
      </div>
    </div>

    {{-- Form (hidden, muncul saat toggle) --}}
    <div class="add-form-wrap" id="pwForm">

      @if(session('success_pw'))
      <div class="alert alert-success">✅ {{ session('success_pw') }}</div>
      @endif
      @if(session('error_pw'))
      <div class="alert alert-error">❌ {{ session('error_pw') }}</div>
      @endif

      <form method="POST" action="{{ route('profile.password') }}">
        @csrf
        @method('PUT')

        <div class="form-field">
          <label>Password Saat Ini</label>
          <div style="position:relative;">
            <span class="pw-icon">🔒</span>
            <input type="password"
              name="old_password"
              class="pw-input {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
              placeholder="Masukkan password lama"
              required>
          </div>
          @error('old_password')
          <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        <div class="form-field">
          <label>Password Baru</label>
          <div style="position:relative;">
            <span class="pw-icon">🔑</span>
            <input type="password"
              name="new_password"
              class="pw-input {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
              placeholder="Minimal 6 karakter"
              required>
          </div>
          @error('new_password')
          <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        <div class="form-field">
          <label>Konfirmasi Password Baru</label>
          <div style="position:relative;">
            <span class="pw-icon">✅</span>
            <input type="password"
              name="new_password_confirmation"
              class="pw-input"
              placeholder="Ulangi password baru"
              required>
          </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:4px;">
          <button type="submit" class="btn-primary">💾 Simpan Password</button>
          <button type="button" class="btn-secondary" onclick="togglePwForm()">Batal</button>
        </div>

      </form>
    </div>
  </div>

</div>

{{-- ═══════════════════════════════════
     INFO AKUN (bawah)
═══════════════════════════════════ --}}
<div class="card" style="margin-top:22px;">
  <div class="card-top">
    <span class="card-title">👤 Informasi Akun</span>
  </div>
  <div style="padding:22px 24px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">

    <div class="info-item">
      <span class="info-label">Nama Lengkap</span>
      <span class="info-value">{{ Auth::user()->name }}</span>
    </div>

    <div class="info-item">
      <span class="info-label">Username</span>
      <span class="info-value">
        <span class="mono">{{ Auth::user()->username }}</span>
      </span>
    </div>

    <div class="info-item">
      <span class="info-label">Role</span>
      <span class="info-value">
        <span class="badge {{ Auth::user()->isSuperAdmin() ? 'badge-super' : 'badge-admin' }}">
          {{ Auth::user()->role }}
        </span>
      </span>
    </div>

    <div class="info-item">
      <span class="info-label">Bergabung Sejak</span>
      <span class="info-value">
        {{ optional(Auth::user()->created_at)->format('d M Y') ?? '-' }}
      </span>
    </div>

  </div>
</div>

@endsection

@push('styles')
<style>
  /* ── 2-col grid ── */
  .dash-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
  }

  /* ── Quick Links ── */
  .quick-links {
    padding: 8px 0;
  }

  .quick-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 22px;
    text-decoration: none;
    color: var(--text);
    border-bottom: 1px solid var(--border);
    transition: background var(--t);
  }

  .quick-item:last-child {
    border-bottom: none;
  }

  .quick-item:hover {
    background: var(--pink-blush);
  }

  .quick-item:hover .quick-arrow {
    opacity: 1;
    color: var(--pink);
    transform: translateX(3px);
  }

  .quick-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .quick-text {
    flex: 1;
  }

  .quick-text strong {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 2px;
  }

  .quick-text span {
    font-size: 12px;
    color: var(--text-light);
  }

  .quick-arrow {
    font-size: 16px;
    color: var(--text-light);
    opacity: .4;
    transition: opacity var(--t), color var(--t), transform var(--t);
  }

  /* ── Password field icon ── */
  .pw-icon {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    pointer-events: none;
  }

  .pw-input {
    width: 100%;
    padding: 11px 14px 11px 40px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: var(--text);
    background: var(--white);
    outline: none;
    transition: border-color var(--t), box-shadow var(--t);
  }

  .pw-input:focus {
    border-color: var(--pink);
    box-shadow: 0 0 0 3px rgba(233, 30, 140, .08);
  }

  .pw-input.is-invalid {
    border-color: var(--error-bdr);
    background: #fff8f8;
  }

  /* ── Info Akun ── */
  .info-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .info-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: var(--text-muted);
  }

  .info-value {
    font-size: 15px;
    font-weight: 600;
  }

  /* ── Responsive ── */
  @media (max-width: 768px) {
    .dash-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  (function() {
    var form = document.getElementById('pwForm');
    var info = document.getElementById('pwInfo');
    var btn = document.getElementById('pwToggleBtn');
    var isOpen = false;

    function openForm() {
      isOpen = true;
      form.classList.add('open');
      info.style.display = 'none';
      btn.textContent = '✕ Tutup';
    }

    function closeForm() {
      isOpen = false;
      form.classList.remove('open');
      info.style.display = 'flex';
      btn.innerHTML = '✏️ Ubah';
    }

    window.togglePwForm = function() {
      isOpen ? closeForm() : openForm();
    };


    @if(session('success_pw') || session('error_pw') || $errors->has('old_password') || $errors->has('new_password'))
    openForm();
    @endif
  })();
</script>
@endpush