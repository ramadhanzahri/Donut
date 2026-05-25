@extends('layouts.app')
@section('title', 'Produk')
@section('page-title', 'Kelola Produk')

@push('styles')
<style>
    .prod-img {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        background: var(--pink-pale);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0
    }

    .prod-name-wrap {
        display: flex;
        align-items: center;
        gap: 12px
    }

    .img-preview-wrap {
        position: relative;
        display: inline-block
    }

    .img-preview {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        margin-top: 8px
    }

    .img-placeholder-box {
        background: var(--pink-pale);
        border: 2px dashed var(--pink-light);
        border-radius: var(--radius-sm);
        padding: 28px;
        text-align: center;
        color: var(--text-light);
        font-size: 13px;
        margin-top: 8px;
        cursor: pointer
    }

    .img-placeholder-box i {
        font-size: 28px;
        color: var(--pink-light);
        display: block;
        margin-bottom: 6px
    }

    .filter-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        align-items: center
    }

    .filter-bar select,
    .filter-bar input {
        height: 38px;
        padding: 0 12px;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 13px;
        color: var(--text);
        background: var(--surface-2);
        outline: none;
        transition: border-color var(--t)
    }

    .filter-bar select:focus,
    .filter-bar input:focus {
        border-color: var(--pink)
    }

    .modal.modal-lg {
        max-width: 680px
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h2>Produk</h2>
        <p>Kelola semua varian produk donat</p>
    </div>
    <button class="btn btn-primary" onclick="openModal('addModal')">
        <i class="fa-solid fa-plus"></i> Tambah Produk
    </button>
</div>

{{-- Filter --}}
<div class="filter-bar">
    <form method="GET" action="{{ route('produk.index') }}" style="display:flex;gap:10px;flex-wrap:wrap">
        <select name="kategori" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $kat)
            <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                {{ $kat->nama_kategori }}
            </option>
            @endforeach
        </select>
        <select name="status" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="aktif" {{ request('status') === 'aktif'    ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
        </select>
        <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}"
            style="min-width:180px">
        <button type="submit" class="btn btn-secondary" style="height:38px">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        @if(request()->hasAny(['kategori','status','q']))
        <a href="{{ route('produk.index') }}" class="btn btn-secondary" style="height:38px">
            <i class="fa-solid fa-xmark"></i> Reset
        </a>
        @endif
    </form>
</div>

<div class="card" style="padding:0">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:48px;padding-left:20px">No</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th style="width:100px;text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $i => $p)
                <tr>
                    <td style="padding-left:20px">{{ $i + 1 }}</td>
                    <td>
                        <div class="prod-name-wrap">
                            @if($p->gambar)
                            <img class="prod-img" src="{{ $p->gambar_url }}" alt="{{ $p->nama_produk }}">
                            @else
                            <div class="prod-img">🍩</div>
                            @endif
                            <span style="font-weight:600;color:var(--text)">{{ $p->nama_produk }}</span>
                        </div>
                    </td>
                    <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                    <td style="font-weight:600">{{ $p->harga_rupiah }}</td>
                    <td>
                        <span class="badge {{ $p->status === 'aktif' ? 'badge-success' : 'badge-danger' }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;justify-content:center">
                            <button class="btn btn-sm btn-outline-pink"
                                onclick="openEditModal({{ $p }})">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger"
                                onclick="openDeleteModal(
                                    '{{ route('produk.destroy', $p->id_produk) }}',
                                    'Hapus Produk?',
                                    'Produk <strong>{{ addslashes($p->nama_produk) }}</strong> akan dihapus permanen beserta gambarnya.'
                                )">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">🍩</div>
                            <p>Belum ada produk. Tambahkan produk pertama!</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ═══ MODAL TAMBAH ═══ --}}
<div class="modal-overlay" id="addModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <span class="modal-title"><i class="fa-solid fa-plus" style="color:var(--pink);margin-right:6px"></i>Tambah Produk</span>
            <button class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                <div>
                    <div class="form-group">
                        <label class="form-label">Nama Produk <span style="color:var(--pink)">*</span></label>
                        <input type="text" name="nama_produk" class="form-control" required
                            placeholder="Nama produk" value="{{ old('nama_produk') }}">
                        @error('nama_produk')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori <span style="color:var(--pink)">*</span></label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga <span style="color:var(--pink)">*</span></label>
                        <input type="number" name="harga" class="form-control" required
                            placeholder="Contoh: 15000" min="0" value="{{ old('harga') }}">
                        @error('harga')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif" {{ old('status','aktif') === 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4"
                            placeholder="Deskripsi singkat produk">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gambar Produk</label>
                        <div class="img-placeholder-box" onclick="document.getElementById('addGambar').click()">
                            <i class="fa-solid fa-image"></i>
                            Klik untuk upload gambar
                            <small style="display:block;margin-top:4px;font-size:11px">JPG, PNG, WebP — max 2MB</small>
                        </div>
                        <input type="file" id="addGambar" name="gambar" accept="image/*"
                            style="display:none" onchange="previewImg(this,'addPreview')">
                        <img id="addPreview" class="img-preview" style="display:none" alt="Preview">
                        @error('gambar')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ═══ MODAL EDIT ═══ --}}
<div class="modal-overlay" id="editModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <span class="modal-title"><i class="fa-solid fa-pencil" style="color:var(--pink);margin-right:6px"></i>Edit Produk</span>
            <button class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" action="" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                <div>
                    <div class="form-group">
                        <label class="form-label">Nama Produk <span style="color:var(--pink)">*</span></label>
                        <input type="text" name="nama_produk" id="editNama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori <span style="color:var(--pink)">*</span></label>
                        <select name="id_kategori" id="editKategori" class="form-control" required>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga <span style="color:var(--pink)">*</span></label>
                        <input type="number" name="harga" id="editHarga" class="form-control" required min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" id="editStatus" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-aktif</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="editDeskripsi" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ganti Gambar <span style="color:var(--text-light);font-weight:400">(opsional)</span></label>
                        <div class="img-placeholder-box" onclick="document.getElementById('editGambar').click()">
                            <i class="fa-solid fa-image"></i> Klik untuk ganti gambar
                        </div>
                        <input type="file" id="editGambar" name="gambar" accept="image/*"
                            style="display:none" onchange="previewImg(this,'editPreview')">
                        <img id="editPreview" class="img-preview" style="display:none" alt="Preview">
                        <div id="editCurrentImg" style="margin-top:8px"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- ═══ MODAL DELETE ═══ --}}
@include('dashboard.partials.delete-modal')

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    function previewImg(input, previewId) {
        var preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function openEditModal(p) {
        document.getElementById('editForm').action = '/produk-admin/' + p.id_produk;
        document.getElementById('editNama').value = p.nama_produk;
        document.getElementById('editKategori').value = p.id_kategori;
        document.getElementById('editHarga').value = p.harga;
        document.getElementById('editStatus').value = p.status;
        document.getElementById('editDeskripsi').value = p.deskripsi || '';
        var curImg = document.getElementById('editCurrentImg');
        if (p.gambar) {
            curImg.innerHTML = '<img src="' + p.gambar_url + '" class="img-preview" style="display:block" alt="Gambar saat ini">';
        } else {
            curImg.innerHTML = '';
        }
        document.getElementById('editPreview').style.display = 'none';
        openModal('editModal');
    }

    @if($errors - > any()) openModal('addModal');
    @endif

    document.querySelectorAll('.modal-overlay').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (e.target === el) el.classList.remove('show');
        });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.show').forEach(function(el) {
            el.classList.remove('show');
        });
    });
</script>
@endpush
@endsection