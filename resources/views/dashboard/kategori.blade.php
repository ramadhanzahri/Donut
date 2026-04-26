@extends('layouts.app')
@section('title', 'Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')

<div class="page-header">
    <div>
        <h2>Kategori</h2>
        <p>Kelola kategori produk donat</p>
    </div>
    <button class="btn btn-primary" onclick="openModal('addModal')">
        <i class="fa-solid fa-plus"></i> Tambah Kategori
    </button>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:48px">No</th>
                    <th>Nama Kategori</th>
                    <th>Dibuat</th>
                    <th style="width:120px;text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $i => $kat)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight:600;color:var(--text)">{{ $kat->nama_kategori }}</td>
                    <td>{{ $kat->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;justify-content:center">
                            <button class="btn btn-sm btn-outline-pink"
                                onclick="openEditModal({{ $kat->id_kategori }}, '{{ addslashes($kat->nama_kategori) }}')">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger"
                                onclick="openDeleteModal(
                                    '{{ route('kategori.destroy', $kat->id_kategori) }}',
                                    'Hapus Kategori?',
                                    'Kategori <strong>{{ addslashes($kat->nama_kategori) }}</strong> akan dihapus permanen.'
                                )">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-icon">🏷️</div>
                            <p>Belum ada kategori. Tambahkan kategori pertama!</p>
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
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title"><i class="fa-solid fa-plus" style="color:var(--pink);margin-right:6px"></i>Tambah Kategori</span>
            <button class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Kategori <span style="color:var(--pink)">*</span></label>
                    <input type="text" name="nama_kategori" class="form-control"
                           placeholder="Contoh: Donat Coklat" required
                           value="{{ old('nama_kategori') }}">
                    @error('nama_kategori')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
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
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title"><i class="fa-solid fa-pencil" style="color:var(--pink);margin-right:6px"></i>Edit Kategori</span>
            <button class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Kategori <span style="color:var(--pink)">*</span></label>
                    <input type="text" name="nama_kategori" id="editNama" class="form-control" required>
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
function openModal(id){ document.getElementById(id).classList.add('show'); }
function closeModal(id){ document.getElementById(id).classList.remove('show'); }

function openEditModal(id, nama){
    document.getElementById('editForm').action = '/kategori/' + id;
    document.getElementById('editNama').value  = nama;
    openModal('editModal');
}

// Auto-open add modal kalau ada validation error
@if($errors->any())
    openModal('addModal');
@endif

// Close on overlay click
document.querySelectorAll('.modal-overlay').forEach(function(el){
    el.addEventListener('click', function(e){ if(e.target===el) el.classList.remove('show'); });
});
document.addEventListener('keydown',function(e){ if(e.key==='Escape') document.querySelectorAll('.modal-overlay.show').forEach(function(el){el.classList.remove('show');}); });
</script>
@endpush
@endsection
