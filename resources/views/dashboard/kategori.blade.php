@extends('layouts.app')
@section('title', 'Kelola Kategori')

@section('content')

{{-- ═══════════════════════════════════
     PAGE HEADER
═══════════════════════════════════ --}}
<div class="page-header">
  <h2>🏷️ Kelola Kategori</h2>
  <p>Tambah, edit, atau hapus kategori produk</p>
</div>

{{-- ═══════════════════════════════════
     FLASH MESSAGES
═══════════════════════════════════ --}}
@if(session('success'))
  <div class="alert alert-success">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-error">❌ {{ session('error') }}</div>
@endif

{{-- ═══════════════════════════════════
     CARD UTAMA
═══════════════════════════════════ --}}
<div class="card">

  {{-- Card Header --}}
  <div class="card-top">
    <div style="display:flex;align-items:center;gap:10px;">
      <span class="card-title">Daftar Kategori</span>
      <span class="badge badge-admin">{{ $kategoris->count() }} kategori</span>
    </div>
    <button class="btn-primary" id="addToggleBtn" onclick="toggleForm()">
      ➕ Tambah Kategori
    </button>
  </div>

  {{-- ── Form Tambah (collapsed by default) ── --}}
  <div class="add-form-wrap" id="addForm">
    <div class="form-section-title">➕ Form Tambah Kategori Baru</div>
    <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-grid">

        <div class="form-field">
          <label>Nama Kategori <span class="required">*</span></label>
          <input type="text"
                 name="nama_kategori"
                 placeholder="cth. Baby Donat, Donat Premium..."
                 value="{{ old('nama_kategori') }}"
                 required
                 autofocus>
          @error('nama_kategori')
            <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        <div class="form-field">
          <label>Status <span class="required">*</span></label>
          <select name="status">
            <option value="aktif"    {{ old('status', 'aktif') == 'aktif'    ? 'selected' : '' }}>
              ✅ Aktif
            </option>
            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
              ⛔ Nonaktif
            </option>
          </select>
          @error('status')
            <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

      </div>

      <div class="form-field">
        <label>
          Gambar Kategori
          <span class="optional">(opsional · JPG/PNG/WEBP · maks. 2MB)</span>
        </label>
        <div class="file-upload-wrap" id="fileWrapAdd">
          <input type="file"
                 name="gambar"
                 id="fileAdd"
                 accept="image/*"
                 onchange="previewImg(this, 'prvAdd', 'fileWrapAdd')"
                 style="display:none;">
          <label for="fileAdd" class="file-upload-label" id="fileLabelAdd">
            <span class="file-icon">🖼️</span>
            <span class="file-text">Klik untuk memilih gambar</span>
            <span class="file-hint">atau seret & lepas di sini</span>
          </label>
          <img id="prvAdd" class="img-preview" style="display:none;" alt="Preview">
          <button type="button"
                  class="file-clear"
                  id="clearAdd"
                  style="display:none;"
                  onclick="clearImg('prvAdd','fileAdd','fileLabelAdd','clearAdd')">
            ✕ Hapus Gambar
          </button>
        </div>
        @error('gambar')
          <div class="field-error">⚠ {{ $message }}</div>
        @enderror
      </div>

      <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn-primary">💾 Simpan Kategori</button>
        <button type="button" class="btn-secondary" onclick="toggleForm()">✕ Batal</button>
      </div>

    </form>
  </div>

  {{-- ── Tabel ── --}}
  @if($kategoris->isEmpty())
    <div class="empty-state">
      <div class="empty-state-icon">🏷️</div>
      <h3>Belum ada kategori</h3>
      <p>Mulai dengan menambahkan kategori pertama untuk mengorganisir produk Anda.</p>
      <button class="btn-primary" onclick="toggleForm()">➕ Tambah Kategori Pertama</button>
    </div>
  @else
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th style="width:48px;">No</th>
          <th style="width:70px;">Gambar</th>
          <th>Nama Kategori</th>
          <th style="width:110px;">Jumlah Produk</th>
          <th style="width:100px;">Status</th>
          <th style="width:110px;">Dibuat</th>
          <th style="width:140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kategoris as $i => $k)
        <tr>

          {{-- No --}}
          <td class="td-num">{{ $i + 1 }}</td>

          {{-- Gambar --}}
          <td>
            @if($k->gambar)
              <img src="{{ Storage::url($k->gambar) }}"
                   alt="{{ $k->nama_kategori }}"
                   width="48" height="48"
                   loading="lazy"
                   style="width:48px;height:48px;border-radius:10px;
                          object-fit:cover;border:2px solid var(--border);">
            @else
              <div class="img-placeholder">🏷️</div>
            @endif
          </td>

          {{-- Nama --}}
          <td>
            <strong style="font-size:14px;">{{ $k->nama_kategori }}</strong>
          </td>

          {{-- Jumlah Produk --}}
          <td>
            @php $jml = $k->produk_count ?? ($k->jumlah_produk ?? 0); @endphp
            <span class="badge {{ $jml > 0 ? 'badge-admin' : 'badge-nonaktif' }}">
              {{ $jml }} produk
            </span>
          </td>

          {{-- Status --}}
          <td>
            <span class="badge {{ $k->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
              {{ $k->status == 'aktif' ? '✅ Aktif' : '⛔ Nonaktif' }}
            </span>
          </td>

          {{-- Tanggal --}}
          <td class="td-date">{{ $k->created_at->format('d M Y') }}</td>

          {{-- Aksi --}}
          <td>
            <div class="action-group">
              <button class="btn-edit"
                title="Edit kategori ini"
                onclick="openEdit(
                  {{ $k->id_kategori }},
                  '{{ addslashes($k->nama_kategori) }}',
                  '{{ $k->status }}',
                  '{{ $k->gambar ? Storage::url($k->gambar) : '' }}'
                )">
                ✏️ Edit
              </button>

              <form method="POST"
                    action="{{ route('kategori.destroy', $k->id_kategori) }}"
                    onsubmit="return confirmDelete('{{ addslashes($k->nama_kategori) }}')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn-danger"
                        title="Hapus kategori ini"
                        {{ ($k->produk_count ?? 0) > 0 ? 'disabled' : '' }}>
                  🗑 Hapus
                </button>
              </form>
            </div>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Keterangan tabel --}}
  <div class="table-footer">
    <span>💡 Kategori yang masih memiliki produk tidak dapat dihapus.</span>
  </div>
  @endif

</div>

{{-- ═══════════════════════════════════
     MODAL EDIT
═══════════════════════════════════ --}}
<div class="modal-overlay" id="editModal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
  <div class="modal">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;">
      <h3 id="editModalTitle">✏️ Edit Kategori</h3>
      <button class="modal-close"
              onclick="document.getElementById('editModal').classList.remove('open')"
              aria-label="Tutup modal">✕</button>
    </div>

    <form id="editForm" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-field">
        <label>Nama Kategori <span class="required">*</span></label>
        <input type="text" name="nama_kategori" id="eNama" required>
      </div>

      <div class="form-field">
        <label>Status <span class="required">*</span></label>
        <select name="status" id="eStatus">
          <option value="aktif">✅ Aktif</option>
          <option value="nonaktif">⛔ Nonaktif</option>
        </select>
      </div>

      <div class="form-field">
        <label>
          Gambar Baru
          <span class="optional">(kosongkan jika tidak diubah)</span>
        </label>
        <div class="file-upload-wrap" id="fileWrapEdit">
          <input type="file"
                 name="gambar"
                 id="fileEdit"
                 accept="image/*"
                 onchange="previewImg(this, 'prvEdit', 'fileWrapEdit')"
                 style="display:none;">
          <label for="fileEdit" class="file-upload-label" id="fileLabelEdit">
            <span class="file-icon">🖼️</span>
            <span class="file-text">Klik untuk ganti gambar</span>
            <span class="file-hint">JPG / PNG / WEBP</span>
          </label>
          <img id="prvEdit" class="img-preview" style="display:none;" alt="Preview">
          <button type="button"
                  class="file-clear"
                  id="clearEdit"
                  style="display:none;"
                  onclick="clearImg('prvEdit','fileEdit','fileLabelEdit','clearEdit')">
            ✕ Hapus Gambar
          </button>
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn-secondary"
                onclick="document.getElementById('editModal').classList.remove('open')">
          Batal
        </button>
        <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
      </div>

    </form>
  </div>
</div>

@endsection

{{-- ═══════════════════════════════════
     STYLES (scoped)
═══════════════════════════════════ --}}
@push('styles')
<style>
/* Form section title */
.form-section-title {
  font-size: 13px; font-weight: 700;
  color: var(--text-muted);
  text-transform: uppercase; letter-spacing: .06em;
  margin-bottom: 18px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--border);
}
.required { color: var(--pink); font-weight: 700; }
.optional  { color: var(--text-light); font-size: 11px; font-weight: 400; }

/* File upload area */
.file-upload-wrap { position: relative; }
.file-upload-label {
  display: flex; flex-direction: column; align-items: center;
  justify-content: center; gap: 4px;
  padding: 22px 16px;
  border: 2px dashed var(--border);
  border-radius: var(--radius);
  cursor: pointer;
  transition: border-color var(--t), background var(--t);
  background: var(--white);
  text-align: center;
}
.file-upload-label:hover {
  border-color: var(--pink);
  background: var(--pink-blush);
}
.file-icon  { font-size: 26px; }
.file-text  { font-size: 14px; font-weight: 600; color: var(--text-muted); }
.file-hint  { font-size: 12px; color: var(--text-light); }
.file-clear {
  display: flex; align-items: center; gap: 6px;
  margin-top: 8px;
  font-size: 12px; font-weight: 600; color: var(--error-text);
  background: var(--error-bg); border: 1px solid var(--error-bdr);
  padding: 5px 12px; border-radius: var(--radius-sm);
  cursor: pointer;
}
.file-clear:hover { background: #ffcdd2; }

/* Image preview */
.img-preview {
  width: 100%; max-height: 160px;
  object-fit: cover;
  border-radius: var(--radius);
  margin-top: 10px;
  border: 2px solid var(--border);
}

/* Image placeholder */
.img-placeholder {
  width: 48px; height: 48px;
  background: var(--pink-blush);
  border-radius: 10px; border: 2px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
}

/* Table helpers */
.td-num  { color: var(--text-light); font-size: 13px; text-align: center; }
.td-date { font-size: 12px; color: var(--text-light); white-space: nowrap; }

/* Action group */
.action-group { display: flex; gap: 7px; flex-wrap: wrap; align-items: center; }
.btn-edit {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 6px 12px;
  background: var(--pink-pale); color: var(--pink);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  font-size: 12px; font-weight: 600;
  cursor: pointer;
  transition: background var(--t);
}
.btn-edit:hover { background: #f8d7e5; }

/* Disabled danger button */
button[disabled].btn-danger {
  opacity: .4; cursor: not-allowed;
}

/* Table footer note */
.table-footer {
  padding: 12px 16px;
  background: #fffbf8;
  border-top: 1px solid var(--border);
  font-size: 12px; color: var(--text-light);
}

/* Empty state */
.empty-state {
  display: flex; flex-direction: column; align-items: center;
  text-align: center;
  padding: 56px 24px;
}
.empty-state-icon { font-size: 56px; margin-bottom: 16px; opacity: .5; }
.empty-state h3 { font-size: 17px; font-weight: 700; margin-bottom: 8px; }
.empty-state p  { font-size: 14px; color: var(--text-light); max-width: 36ch; margin-bottom: 20px; }

/* Modal close */
.modal-close {
  width: 32px; height: 32px;
  border-radius: 50%;
  background: var(--pink-pale); color: var(--text-muted);
  font-size: 14px; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; border: none;
  transition: background var(--t), color var(--t);
}
.modal-close:hover { background: var(--pink); color: #fff; }
</style>
@endpush

{{-- ═══════════════════════════════════
     SCRIPTS
═══════════════════════════════════ --}}
@push('scripts')
<script>
/* ── Toggle Form Tambah ── */
(function () {
  var form   = document.getElementById('addForm');
  var btn    = document.getElementById('addToggleBtn');
  var isOpen = false;

  window.toggleForm = function () {
    isOpen = !isOpen;
    form.classList.toggle('open', isOpen);
    btn.textContent = isOpen ? '✕ Tutup Form' : '➕ Tambah Kategori';
    if (isOpen) {
      // Scroll ke form
      form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  // Auto buka jika ada error validasi
  @if($errors->any())
    window.toggleForm();
  @endif
})();

/* ── Buka Modal Edit ── */
function openEdit(id, nama, status, gambar) {
  var modal = document.getElementById('editModal');
  document.getElementById('editForm').action = '/kategori/' + id;
  document.getElementById('eNama').value    = nama;
  document.getElementById('eStatus').value  = status;

  var img   = document.getElementById('prvEdit');
  var clear = document.getElementById('clearEdit');
  var label = document.getElementById('fileLabelEdit');

  if (gambar) {
    img.src           = gambar;
    img.style.display = 'block';
    clear.style.display = 'flex';
    label.style.display = 'none';
  } else {
    img.style.display   = 'none';
    clear.style.display = 'none';
    label.style.display = 'flex';
  }

  modal.classList.add('open');
}

/* ── Preview Gambar ── */
function previewImg(input, imgId, wrapId) {
  if (!input.files || !input.files[0]) return;

  var img   = document.getElementById(imgId);
  var clear = document.getElementById(imgId === 'prvAdd' ? 'clearAdd' : 'clearEdit');
  var label = document.getElementById(imgId === 'prvAdd' ? 'fileLabelAdd' : 'fileLabelEdit');

  img.src             = URL.createObjectURL(input.files[0]);
  img.style.display   = 'block';
  clear.style.display = 'flex';
  label.style.display = 'none';
}

/* ── Clear Gambar ── */
function clearImg(imgId, inputId, labelId, clearId) {
  document.getElementById(imgId).style.display   = 'none';
  document.getElementById(clearId).style.display = 'none';
  document.getElementById(labelId).style.display = 'flex';
  document.getElementById(inputId).value          = '';
}

/* ── Konfirmasi Hapus ── */
function confirmDelete(nama) {
  return confirm('Yakin ingin menghapus kategori "' + nama + '"?\nTindakan ini tidak dapat dibatalkan.');
}

/* ── Tutup Modal klik backdrop ── */
document.getElementById('editModal').addEventListener('click', function (e) {
  if (e.target === this) this.classList.remove('open');
});

/* ── Tutup Modal tekan Escape ── */
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    document.getElementById('editModal').classList.remove('open');
  }
});
</script>
@endpush