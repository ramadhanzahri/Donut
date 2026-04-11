@extends('layouts.app')

@section('title', 'Profil Perusahaan')

@section('content')

{{-- ═══════════ PAGE HEADER ═══════════ --}}
<div class="page-header">
    <h2>🏢 Profil Perusahaan</h2>
    <p>
        Informasi ini tampil di halaman publik —
        <a href="{{ route('profil') }}" target="_blank" rel="noopener noreferrer"
            style="color: var(--pink); font-weight: 600;">
            Lihat halaman publik ↗
        </a>
    </p>
</div>

{{-- ═══════════ ALERT ═══════════ --}}
@if(session('success'))
<div class="alert alert-success">
    <span>✅</span>
    <span>{{ session('success') }}</span>
</div>
@endif

@if($errors->any())
<div class="alert alert-error">
    <div>
        <strong>⚠️ Terdapat kesalahan:</strong>
        <ul style="margin: 6px 0 0 16px; padding: 0;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{{-- ═══════════ FORM ═══════════ --}}
<form action="{{ route('profile-perusahaan.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ─── CARD 1: Identitas ─── --}}
    <div class="card">
        <div class="card-top">
            <h3 class="card-title">📋 Identitas Perusahaan</h3>
        </div>
        <div style="padding: 22px 26px;">

            {{-- Nama Perusahaan --}}
            <div class="form-field">
                <label for="nama_perusahaan">Nama Perusahaan <span style="color:var(--pink)">*</span></label>
                <input
                    type="text"
                    id="nama_perusahaan"
                    name="nama_perusahaan"
                    value="{{ old('nama_perusahaan', $profile->nama_perusahaan) }}"
                    placeholder="Contoh: Maw Maw Donut"
                    maxlength="150"
                    required>
                @error('nama_perusahaan')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Telepon & Email --}}
            <div class="form-grid">
                <div class="form-field">
                    <label for="telepon">No. Telepon / WhatsApp</label>
                    <input
                        type="text"
                        id="telepon"
                        name="telepon"
                        value="{{ old('telepon', $profile->telepon) }}"
                        placeholder="081234567890"
                        maxlength="20">
                    <small style="color: var(--text-light); font-size: 12px;">Format 08xxx, tanpa tanda hubung.</small>
                    @error('telepon')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $profile->email) }}"
                        placeholder="email@perusahaan.com"
                        maxlength="100">
                    @error('email')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
    </div>

    {{-- ─── CARD 2: Deskripsi ─── --}}
    <div class="card">
        <div class="card-top">
            <h3 class="card-title">📝 Deskripsi</h3>
        </div>
        <div style="padding: 22px 26px;">

            <div class="form-field">
                <label for="deskripsi">Deskripsi Singkat</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    placeholder="Deskripsi singkat tentang perusahaan (tampil di hero halaman publik)..."
                    maxlength="500"
                    oninput="document.getElementById('desCount').textContent = this.value.length + '/500'">{{ old('deskripsi', $profile->deskripsi) }}</textarea>
                <small style="color: var(--text-light); font-size: 12px; display:flex; justify-content:space-between; margin-top:4px;">
                    <span>Tampil sebagai tagline singkat di halaman profil publik.</span>
                    <span id="desCount">{{ mb_strlen($profile->deskripsi ?? '') }}/500</span>
                </small>
                @error('deskripsi')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    {{-- ─── CARD 3: Sejarah ─── --}}
    <div class="card">
        <div class="card-top">
            <h3 class="card-title">📖 Sejarah Perusahaan</h3>
        </div>
        <div style="padding: 22px 26px;">

            <div class="form-field">
                <label for="sejarah">Sejarah Perusahaan</label>
                <textarea
                    id="sejarah"
                    name="sejarah"
                    rows="8"
                    placeholder="Ceritakan sejarah berdirinya perusahaan, visi, misi, dan perjalanannya...&#10;&#10;Gunakan baris baru untuk memisahkan paragraf."
                    maxlength="5000"
                    oninput="document.getElementById('sejarahCount').textContent = this.value.length + '/5000'">{{ old('sejarah', $profile->sejarah) }}</textarea>
                <small style="color: var(--text-light); font-size: 12px; display:flex; justify-content:space-between; margin-top:4px;">
                    <span>Gunakan baris baru untuk memisahkan paragraf.</span>
                    <span id="sejarahCount">{{ mb_strlen($profile->sejarah ?? '') }}/5000</span>
                </small>
                @error('sejarah')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    {{-- ─── CARD 4: Logo ─── --}}
    <div class="card">
        <div class="card-top">
            <h3 class="card-title">🖼️ Logo Perusahaan</h3>
        </div>
        <div style="padding: 22px 26px;">

            @if($profile->logo)
            <div style="margin-bottom: 16px;">
                <p style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); margin-bottom: 8px;">
                    Logo Saat Ini
                </p>
                <img
                    src="{{ $profile->logo_url }}"
                    alt="Logo {{ $profile->nama_perusahaan }}"
                    class="img-preview"
                    style="max-height: 120px; max-width: 260px; object-fit: contain; border: 1px solid var(--border); border-radius: var(--radius); padding: 8px; background: var(--white);">
            </div>
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 18px; padding: 12px 14px; background: var(--error-bg, #fdf0f3); border: 1px solid var(--error-bdr, #f5c0cb); border-radius: var(--radius-sm);">
                <input
                    type="checkbox"
                    name="hapus_logo"
                    value="1"
                    id="hapusLogo"
                    {{ old('hapus_logo') ? 'checked' : '' }}
                    style="width: 16px; height: 16px; accent-color: var(--pink); cursor: pointer;">
                <label for="hapusLogo" style="font-size: 13px; color: var(--error-text, #c0392b); cursor: pointer; font-weight: 600; margin: 0; text-transform: none; letter-spacing: 0;">
                    🗑️ Hapus logo saat ini
                </label>
            </div>
            @else
            <div style="display: flex; align-items: center; justify-content: center; width: 120px; height: 120px; background: var(--pink-blush, #fff0f5); border-radius: var(--radius); font-size: 2.5rem; margin-bottom: 16px; border: 1.5px dashed var(--border);">
                🏢
            </div>
            <p style="font-size: 13px; color: var(--text-light); margin-bottom: 16px;">Belum ada logo. Upload logo perusahaan di bawah.</p>
            @endif

            <div class="form-field">
                <label for="logoInput">{{ $profile->logo ? 'Ganti dengan Logo Baru' : 'Upload Logo' }}</label>
                <input
                    type="file"
                    id="logoInput"
                    name="logo"
                    accept="image/jpg,image/jpeg,image/png,image/webp"
                    style="padding: 8px 14px; cursor: pointer;">
                <small style="color: var(--text-light); font-size: 12px;">Format: jpg, jpeg, png, webp. Maks: 2MB.</small>
                @error('logo')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Preview logo baru --}}
            <div id="logoPreview" style="display: none; margin-top: 8px;">
                <p style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); margin-bottom: 6px;">Preview:</p>
                <img
                    id="previewImg"
                    src=""
                    alt="Preview Logo"
                    class="img-preview"
                    style="max-height: 120px; max-width: 260px; object-fit: contain; border: 1px solid var(--border); border-radius: var(--radius); padding: 8px; background: var(--white);">
            </div>

        </div>
    </div>

    {{-- ─── CARD 5: Alamat ─── --}}
    <div class="card">
        <div class="card-top">
            <h3 class="card-title">📍 Alamat</h3>
        </div>
        <div style="padding: 22px 26px;">

            <div class="form-field">
                <label for="alamat">Alamat Lengkap</label>
                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                    placeholder="Jl. Contoh No. 1, Kota, Provinsi"
                    maxlength="500">{{ old('alamat', $profile->alamat) }}</textarea>
                @error('alamat')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    {{-- ─── ACTION BUTTONS ─── --}}
    <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 32px; flex-wrap: wrap;">
        <button type="submit" class="btn-primary">
            💾 Simpan Perubahan
        </button>
        <a href="{{ route('dashboard') }}" class="btn-secondary">
            ✖ Batal
        </a>
    </div>

</form>

@endsection

@push('scripts')
<script>
    // Preview logo sebelum upload
    document.getElementById('logoInput').addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('logoPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush