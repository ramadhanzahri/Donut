@extends('layouts.app')
@section('title','Kelola Admin')

@section('content')
<div class="page-header">
  <h2>👥 Kelola Admin</h2>
  <p>Tambah, edit, atau hapus akun administrator sistem</p>
</div>

@if(session('success'))
  <div class="alert alert-success">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-error">❌ {{ session('error') }}</div>
@endif

<div class="card">
  <div class="card-top">
    <span class="card-title">Daftar Admin ({{ $admins->count() }})</span>
    <button class="btn-primary" onclick="toggleForm()">➕ Tambah Admin</button>
  </div>

  {{-- Form Tambah --}}
  <div class="add-form-wrap" id="addForm">
    <form method="POST" action="{{ route('admins.store') }}">
      @csrf
      <div class="form-grid">
        <div class="form-field">
          <label>Nama Lengkap</label>
          <input type="text" name="name"
            placeholder="Nama lengkap admin"
            value="{{ old('name') }}" required>
          @error('name')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-field">
          <label>Username</label>
          <input type="text" name="username"
            placeholder="Username untuk login"
            value="{{ old('username') }}"
            autocomplete="off" required>
          @error('username')<div class="field-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="form-grid">
        <div class="form-field">
          <label>Password</label>
          <input type="password" name="password"
            placeholder="Min. 6 karakter" required>
          @error('password')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-field">
          <label>Role</label>
          <select name="role">
            <option value="admin"      {{ old('role','admin')=='admin'     ?'selected':'' }}>Admin</option>
            <option value="superadmin" {{ old('role')=='superadmin'        ?'selected':'' }}>Super Admin</option>
          </select>
          @error('role')<div class="field-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="submit" class="btn-primary">💾 Simpan Admin</button>
        <button type="button" class="btn-secondary" onclick="toggleForm()">Batal</button>
      </div>
    </form>
  </div>

  {{-- Tabel --}}
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Role</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($admins as $i => $admin)
        <tr>
          <td style="color:#b07090;">{{ $i+1 }}</td>
          <td>
            <div style="display:flex;align-items:center;gap:10px;">
              <div style="width:36px;height:36px;background:#e91e8c;border-radius:50%;
                          display:flex;align-items:center;justify-content:center;
                          color:#fff;font-weight:700;font-size:14px;flex-shrink:0;">
                {{ strtoupper(substr($admin->name,0,1)) }}
              </div>
              <div>
                <strong>{{ $admin->name }}</strong>
                @if($admin->id === Auth::id())
                  <span class="badge badge-aktif" style="font-size:10px;margin-left:4px;">Anda</span>
                @endif
              </div>
            </div>
          </td>
          <td><span class="mono">{{ $admin->username }}</span></td>
          <td>
            <span class="badge {{ $admin->role=='superadmin'?'badge-super':'badge-admin' }}">
              {{ $admin->role }}
            </span>
          </td>
          <td style="font-size:12px;color:#b07090;">
            {{ optional($admin->created_at)->format('d M Y') ?? '-' }}
          </td>
          <td>
            <div style="display:flex;gap:7px;">
              <button class="btn-secondary" style="padding:6px 12px;font-size:12px;"
                onclick="openEdit(
                  {{ $admin->id }},
                  '{{ addslashes($admin->name) }}',
                  '{{ $admin->username }}',
                  '{{ $admin->role }}'
                )">✏️ Edit</button>
              @if($admin->id !== Auth::id())
              <form method="POST"
                    action="{{ route('admins.destroy',$admin->id) }}"
                    onsubmit="return confirm('Hapus admin \'{{ addslashes($admin->name) }}\'?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger">🗑 Hapus</button>
              </form>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr class="empty-row">
          <td colspan="6">Belum ada admin lain di sistem.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <h3>✏️ Edit Admin</h3>
    <form id="editForm" method="POST" action="">
      <input type="hidden" name="_token" id="editToken">
      <input type="hidden" name="_method" value="PUT">
      <div class="form-field">
        <label>Nama Lengkap</label>
        <input type="text" name="name" id="eName" required>
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-field">
        <label>Username</label>
        <input type="text" name="username" id="eUsername" required>
        @error('username')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-field">
        <label>Role</label>
        <select name="role" id="eRole">
          <option value="admin">Admin</option>
          <option value="superadmin">Super Admin</option>
        </select>
      </div>
      <div class="form-field">
        <label>Password Baru
          <span style="color:#b07090;font-weight:400;">(kosongkan jika tidak diubah)</span>
        </label>
        <input type="password" name="password" placeholder="Min. 6 karakter">
        @error('password')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-secondary"
          onclick="document.getElementById('editModal').classList.remove('open')">Batal</button>
        <button type="submit" class="btn-primary">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
function toggleForm(){
  document.getElementById('addForm').classList.toggle('open');
}
function openEdit(id,name,username,role){
  const editForm = document.getElementById('editForm');
  editForm.action = '{{ route("admins.update", ":id") }}'.replace(':id', id);
  editForm.querySelector('input[name="_token"]').value = '{{ csrf_token() }}';
  document.getElementById('eName').value        = name;
  document.getElementById('eUsername').value    = username;
  document.getElementById('eRole').value        = role;
  document.getElementById('editModal').classList.add('open');
}
document.getElementById('editModal').addEventListener('click',function(e){
  if(e.target===this) this.classList.remove('open');
});
@if($errors->any())
  document.getElementById('addForm').classList.add('open');
@endif
</script>
@endpush