@extends('layouts.app')
@section('title', 'Kelola Admin')
@section('page-title', 'Kelola Admin')

@push('styles')
<style>
    .admin-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .avatar-aktif {
        background: var(--pink);
    }

    .avatar-nonaktif {
        background: var(--text-light);
    }

    .status-toggle {
        display: inline-flex;
        align-items: center;
        gap: 0;
        border-radius: 20px;
        overflow: hidden;
        border: 1.5px solid var(--border);
        background: var(--surface);
        cursor: pointer;
    }

    .status-toggle form {
        display: contents;
    }

    .toggle-btn {
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: background var(--t), color var(--t);
        font-family: 'DM Sans', sans-serif;
        background: transparent;
        color: var(--text-light);
    }

    .toggle-btn.aktif-btn.on {
        background: #edfdf5;
        color: #1a7a4a;
    }

    .toggle-btn.nonaktif-btn.on {
        background: #fff0f0;
        color: #e74c3c;
    }

    .row-nonaktif td {
        opacity: .55;
    }

    .row-nonaktif:hover td {
        opacity: .8;
    }

    .stats-mini {
        display: flex;
        gap: 14px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .stat-mini-card {
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: var(--shadow);
        flex: 1;
        min-width: 160px;
    }

    .stat-mini-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0
    }

    .icon-all {
        background: var(--pink-pale);
        color: var(--pink);
    }

    .icon-aktif {
        background: #edfdf5;
        color: #1a7a4a;
    }

    .icon-nonaktif {
        background: #fff0f0;
        color: #e74c3c;
    }

    .icon-super {
        background: #fffbea;
        color: #856404;
    }

    .stat-mini-val {
        font-size: 22px;
        font-weight: 800;
        color: var(--text);
        line-height: 1
    }

    .stat-mini-lbl {
        font-size: 11px;
        color: var(--text-light);
        margin-top: 2px
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h2>Kelola Admin</h2>
        <p>Manajemen akun pengguna panel admin</p>
    </div>
    <button class="btn btn-primary" onclick="openModal('addModal')">
        <i class="fa-solid fa-user-plus"></i> Tambah Admin
    </button>
</div>

{{-- Stats Mini --}}
<div class="stats-mini">
    <div class="stat-mini-card">
        <div class="stat-mini-icon icon-all"><i class="fa-solid fa-users"></i></div>
        <div>
            <div class="stat-mini-val">{{ $admins->count() }}</div>
            <div class="stat-mini-lbl">Total Admin</div>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon icon-aktif"><i class="fa-solid fa-circle-check"></i></div>
        <div>
            <div class="stat-mini-val">{{ $admins->where('status','aktif')->count() }}</div>
            <div class="stat-mini-lbl">Aktif</div>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon icon-nonaktif"><i class="fa-solid fa-circle-xmark"></i></div>
        <div>
            <div class="stat-mini-val">{{ $admins->where('status','nonaktif')->count() }}</div>
            <div class="stat-mini-lbl">Non-aktif</div>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon icon-super"><i class="fa-solid fa-shield-halved"></i></div>
        <div>
            <div class="stat-mini-val">{{ $admins->where('role','superadmin')->count() }}</div>
            <div class="stat-mini-lbl">Super Admin</div>
        </div>
    </div>
</div>

<div class="card" style="padding:0">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:48px;padding-left:20px">No</th>
                    <th>Nama Admin</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th style="width:110px;text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $i => $admin)
                <tr class="{{ $admin->status === 'nonaktif' ? 'row-nonaktif' : '' }}">
                    <td style="padding-left:20px">{{ $i + 1 }}</td>

                    {{-- Nama + Avatar --}}
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            <div class="admin-avatar {{ $admin->status === 'aktif' ? 'avatar-aktif' : 'avatar-nonaktif' }}">
                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:700;color:var(--text);font-size:14px">
                                    {{ $admin->name }}
                                    @if($admin->id === Auth::id())
                                    <span class="badge badge-info" style="margin-left:4px">Anda</span>
                                    @endif
                                </div>
                                <div style="font-size:11px;color:var(--text-light)">
                                    {{ $admin->email ?? $admin->username . '@mawmaw.id' }}
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- Username --}}
                    <td style="font-family:monospace;font-size:13px">{{ $admin->username }}</td>

                    {{-- Role --}}
                    <td>
                        <span class="badge {{ $admin->role === 'superadmin' ? 'badge-warning' : 'badge-info' }}">
                            @if($admin->role === 'superadmin')
                            <i class="fa-solid fa-shield-halved" style="margin-right:3px"></i>
                            @else
                            <i class="fa-solid fa-user" style="margin-right:3px"></i>
                            @endif
                            {{ $admin->role }}
                        </span>
                    </td>

                    {{-- Status Toggle --}}
                    <td>
                        @if($admin->id === Auth::id())
                        {{-- Akun sendiri tidak bisa dinonaktifkan --}}
                        <span class="badge badge-success">
                            <i class="fa-solid fa-circle" style="font-size:8px;margin-right:3px"></i>aktif
                        </span>
                        @else
                        <div class="status-toggle" title="Klik untuk ubah status">
                            <form action="{{ route('admins.toggle-status', $admin->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="toggle-btn aktif-btn {{ $admin->status === 'aktif' ? 'on' : '' }}">
                                    <i class="fa-solid fa-circle" style="font-size:7px;margin-right:4px"></i>Aktif
                                </button>
                            </form>
                            <form action="{{ route('admins.toggle-status', $admin->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="toggle-btn nonaktif-btn {{ $admin->status === 'nonaktif' ? 'on' : '' }}">
                                    <i class="fa-solid fa-circle" style="font-size:7px;margin-right:4px"></i>Nonaktif
                                </button>
                            </form>
                        </div>
                        @endif
                    </td>

                    {{-- Dibuat --}}
                    <td style="font-size:13px">
                        {{ $admin->created_at ? $admin->created_at->format('d M Y') : '-' }}
                    </td>

                    {{-- Aksi --}}
                    <td>
                        <div style="display:flex;gap:6px;justify-content:center">
                            <button class="btn btn-sm btn-outline-pink"
                                title="Edit"
                                onclick="openEditModal(
                                    {{ $admin->id }},
                                    '{{ addslashes($admin->name) }}',
                                    '{{ addslashes($admin->username) }}',
                                    '{{ $admin->role }}',
                                    '{{ $admin->status }}'
                                )">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            @if($admin->id !== Auth::id())
                            <button class="btn btn-sm btn-danger"
                                title="Hapus"
                                onclick="openDeleteModal(
                                    '{{ route('admins.destroy', $admin->id) }}',
                                    'Hapus Akun Admin?',
                                    'Akun <strong>{{ addslashes($admin->name) }}</strong> akan dihapus permanen.'
                                )">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-secondary" disabled
                                title="Tidak dapat menghapus akun sendiri"
                                style="opacity:.35;cursor:not-allowed">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon">👤</div>
                            <p>Belum ada data admin.</p>
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
            <span class="modal-title">
                <i class="fa-solid fa-user-plus" style="color:var(--pink);margin-right:6px"></i>Tambah Admin
            </span>
            <button class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admins.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color:var(--pink)">*</span></label>
                    <input type="text" name="name" class="form-control" required
                        placeholder="Nama lengkap" value="{{ old('name') }}">
                    @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Username <span style="color:var(--pink)">*</span></label>
                    <input type="text" name="username" class="form-control" required
                        placeholder="Username untuk login" value="{{ old('username') }}">
                    @error('username')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password <span style="color:var(--pink)">*</span></label>
                    <div style="position:relative">
                        <input type="password" name="password" id="addPassword" class="form-control"
                            required placeholder="Minimal 6 karakter" style="padding-right:44px">
                        <button type="button" onclick="togglePass('addPassword',this)"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-light);cursor:pointer;font-size:15px">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Role <span style="color:var(--pink)">*</span></label>
                        <select name="role" class="form-control" required>
                            <option value="admin" {{ old('role','admin') === 'admin'      ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Status <span style="color:var(--pink)">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="aktif" {{ old('status','aktif') === 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                        </select>
                    </div>
                </div>
                @error('role') <span class="invalid-feedback">{{ $message }}</span>@enderror
                @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══ MODAL EDIT ═══ --}}
<div class="modal-overlay" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">
                <i class="fa-solid fa-user-pen" style="color:var(--pink);margin-right:6px"></i>Edit Admin
            </span>
            <button class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" action="" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color:var(--pink)">*</span></label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Username <span style="color:var(--pink)">*</span></label>
                    <input type="text" name="username" id="editUsername" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password Baru
                        <span style="color:var(--text-light);font-size:12px;font-weight:400">(kosongkan jika tidak diganti)</span>
                    </label>
                    <div style="position:relative">
                        <input type="password" name="password" id="editPassword"
                            class="form-control" placeholder="Isi untuk ganti password"
                            style="padding-right:44px">
                        <button type="button" onclick="togglePass('editPassword',this)"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-light);cursor:pointer;font-size:15px">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Role <span style="color:var(--pink)">*</span></label>
                        <select name="role" id="editRole" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Status <span style="color:var(--pink)">*</span></label>
                        <select name="status" id="editStatus" class="form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══ DELETE MODAL ═══ --}}
@include('dashboard.partials.delete-modal')

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    function openEditModal(id, name, username, role, status) {
        document.getElementById('editForm').action = '/admins/' + id;
        document.getElementById('editName').value = name;
        document.getElementById('editUsername').value = username;
        document.getElementById('editRole').value = role;
        document.getElementById('editStatus').value = status;
        document.getElementById('editPassword').value = '';
        openModal('editModal');
    }

    function togglePass(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    @if($errors - > any()) openModal('addModal');
    @endif

    document.querySelectorAll('.modal-overlay').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (e.target === el) el.classList.remove('show');
        });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.show')
            .forEach(function(el) {
                el.classList.remove('show');
            });
    });
</script>
@endpush
@endsection