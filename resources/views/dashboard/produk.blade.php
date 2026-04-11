@extends('layouts.app')
@section('title','Kelola Produk')

@section('content')
<div class="page-header">
  <h2>🍩 Kelola Produk</h2>
  <p>Tambah, edit, atau hapus data produk</p>
</div>

@if(session('success'))
  <div class="alert alert-success">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-error">❌ {{ session('error') }}</div>
@endif

<div class="card">
  <div class="card-top">
    <span class="card-title">Daftar Produk ({{ $produks->count() }})</span>
    <button class="btn-primary" onclick="toggleForm()">➕ Tambah Produk</button>
  </div>

  {{-- Form Tambah --}}
  <div class="add-form-wrap" id="addForm">
    <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-grid">
        <div class="form-field">
          <label>Nama Produk</label>
          <input type="text" name="nama_produk"
            placeholder="cth. Baby Donat Isi 24"
            value="{{ old('nama_produk') }}" required>
          @error('nama_produk')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-field">
          <label>Kategori</label>
          <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kat)
              <option value="{{ $kat->id_kategori }}"
                {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                {{ $kat->nama_kategori }}
              </option>
            @endforeach
          </select>
          @error('id_kategori')<div class="field-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="form-grid">
        <div class="form-field">
          <label>Harga (Rp)</label>
          <input type="number" name="harga"
            placeholder="cth. 25000"
            value="{{ old('harga') }}" min="0" required>
          @error('harga')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-field">
          <label>Status</label>
          <select name="status">
            <option value="aktif"    {{ old('status','aktif')=='aktif'    ?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ old('status')=='nonaktif'         ?'selected':'' }}>Nonaktif</option>
          </select>
          @error('status')<div class="field-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="form-field">
        <label>Deskripsi <span style="color:#b07090;font-weight:400;">(opsional)</span></label>
        <textarea name="deskripsi" placeholder="Tuliskan deskripsi produk...">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-field">
        <label>Gambar Produk <span style="color:#b07090;font-weight:400;">(opsional)</span></label>
        <input type="file" name="gambar" accept="image/*" onchange="previewImg(this,'prvAdd')">
        @error('gambar')<div class="field-error">{{ $message }}</div>@enderror
        <img id="prvAdd" class="img-preview" style="display:none;">
      </div>
      <div style="display:flex;gap:10px;">
        <button type="submit" class="btn-primary">💾 Simpan Produk</button>
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
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($produks as $i => $p)
        <tr>
          <td style="color:#b07090;">{{ $i+1 }}</td>
          <td>
            @if($p->gambar)
              <img src="{{ Storage::url($p->gambar) }}"
                   style="width:50px;height:50px;border-radius:8px;object-fit:cover;">
            @else
              <span style="font-size:26px;">🍩</span>
            @endif
          </td>
          <td>
            <strong>{{ $p->nama_produk }}</strong><br>
            <span style="font-size:12px;color:#b07090;">
              {{ Str::limit($p->deskripsi, 40) }}
            </span>
          </td>
          <td>
            <span class="badge badge-admin">
              {{ $p->kategori->nama_kategori ?? '-' }}
            </span>
          </td>
          <td><strong>Rp {{ number_format($p->harga,0,',','.') }}</strong></td>
          <td>
            <span class="badge {{ $p->status=='aktif'?'badge-aktif':'badge-nonaktif' }}">
              {{ $p->status }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:6px;flex-wrap:wrap;">
              <a href="{{ route('produk.show',$p->id_produk) }}"
                 class="btn-secondary"
                 style="padding:6px 10px;font-size:12px;text-decoration:none;">
                 👁 Detail
              </a>
              <button class="btn-secondary" style="padding:6px 10px;font-size:12px;"
                onclick="openEdit(
                  {{ $p->id_produk }},
                  '{{ addslashes($p->nama_produk) }}',
                  {{ $p->id_kategori }},
                  {{ $p->harga }},
                  '{{ $p->status }}',
                  '{{ addslashes($p->deskripsi ?? '') }}',
                  '{{ $p->gambar ? Storage::url($p->gambar) : '' }}'
                )">✏️ Edit</button>
              <form method="POST"
                    action="{{ route('produk.destroy',$p->id_produk) }}"
                    onsubmit="return confirm('Hapus produk \'{{ addslashes($p->nama_produk) }}\'?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger">🗑 Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr class="empty-row">
          <td colspan="7">😔 Belum ada produk. Silakan tambahkan!</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal-overlay" id="editModal">
  <div class="modal" style="width:520px;">
    <h3>✏️ Edit Produk</h3>
    <form id="editForm" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-field">
          <label>Nama Produk</label>
          <input type="text" name="nama_produk" id="eNama" required>
        </div>
        <div class="form-field">
          <label>Kategori</label>
          <select name="id_kategori" id="eKat" required>
            @foreach($kategoris as $kat)
              <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-grid">
        <div class="form-field">
          <label>Harga (Rp)</label>
          <input type="number" name="harga" id="eHarga" min="0" required>
        </div>
        <div class="form-field">
          <label>Status</label>
          <select name="status" id="eStatus">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
        </div>
      </div>
      <div class="form-field">
        <label>Deskripsi</label>
        <textarea name="deskripsi" id="eDesk"></textarea>
      </div>
      <div class="form-field">
        <label>Gambar Baru <span style="color:#b07090;font-weight:400;">(kosongkan jika tidak diubah)</span></label>
        <input type="file" name="gambar" accept="image/*" onchange="previewImg(this,'prvEdit')">
        <img id="prvEdit" class="img-preview" style="display:none;">
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
function openEdit(id,nama,idKat,harga,status,desk,gambar){
  document.getElementById('editForm').action = '/produk-admin/' + id;
  document.getElementById('eNama').value  = nama;
  document.getElementById('eKat').value   = idKat;
  document.getElementById('eHarga').value = harga;
  document.getElementById('eStatus').value= status;
  document.getElementById('eDesk').value  = desk;
  var p = document.getElementById('prvEdit');
  if(gambar){ p.src = gambar; p.style.display = 'block'; }
  else       { p.style.display = 'none'; }
  document.getElementById('editModal').classList.add('open');
}
function previewImg(input, id){
  var el = document.getElementById(id);
  if(input.files && input.files[0]){
    el.src = URL.createObjectURL(input.files[0]);
    el.style.display = 'block';
  }
}
document.getElementById('editModal').addEventListener('click',function(e){
  if(e.target===this) this.classList.remove('open');
});
@if($errors->any())
  document.getElementById('addForm').classList.add('open');
@endif
</script>
@endpush