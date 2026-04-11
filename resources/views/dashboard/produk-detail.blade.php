@extends('layouts.app')
@section('title','Detail Produk')

@section('content')
<div class="page-header">
  <h2>🍩 Detail Produk</h2>
  <p>Informasi lengkap untuk: <strong>{{ $produk->nama_produk }}</strong></p>
</div>

@if(session('success'))
  <div class="alert alert-success">✅ {{ session('success') }}</div>
@endif

<div style="display:grid;grid-template-columns:300px 1fr;gap:24px;align-items:start;">

  {{-- Foto --}}
  <div class="card" style="overflow:hidden;">
    @if($produk->gambar)
      <img src="{{ Storage::url($produk->gambar) }}"
           alt="{{ $produk->nama_produk }}"
           style="width:100%;height:300px;object-fit:cover;display:block;">
    @else
      <div style="height:300px;background:#fce4ec;display:flex;
                  align-items:center;justify-content:center;font-size:80px;">🍩</div>
    @endif
    <div style="padding:16px;border-top:1px solid #f0c0d8;">
      <span class="badge {{ $produk->status=='aktif'?'badge-aktif':'badge-nonaktif' }}"
            style="width:100%;text-align:center;display:block;padding:8px;">
        {{ $produk->status == 'aktif' ? '✅ Produk Aktif' : '❌ Produk Nonaktif' }}
      </span>
    </div>
  </div>

  {{-- Info --}}
  <div class="card">
    <div class="card-top">
      <span class="card-title">Informasi Produk</span>
      <div style="display:flex;gap:8px;">
        <button class="btn-secondary" style="font-size:12px;padding:7px 14px;"
          onclick="document.getElementById('editModal').classList.add('open')">✏️ Edit</button>
        <form method="POST" action="{{ route('produk.destroy',$produk->id_produk) }}"
              onsubmit="return confirm('Hapus produk ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn-danger">🗑 Hapus</button>
        </form>
      </div>
    </div>
    <div style="padding:24px;">
      <table style="width:100%;border-collapse:collapse;">
        @php
          $rows = [
            ['Nama Produk',  $produk->nama_produk],
            ['Kategori',     $produk->kategori->nama_kategori ?? '-'],
            ['Harga',        'Rp '.number_format($produk->harga,0,',','.')],
            ['Status',       $produk->status],
            ['Ditambahkan',  $produk->created_at->format('d M Y, H:i').' WIB'],
            ['Terakhir Edit',$produk->updated_at->format('d M Y, H:i').' WIB'],
          ];
        @endphp
        @foreach($rows as $row)
        <tr>
          <td style="padding:10px 0;color:#b07090;font-size:13px;width:150px;vertical-align:top;">
            {{ $row[0] }}
          </td>
          <td style="padding:10px 0;font-size:15px;
            {{ $row[0]=='Harga'?'font-weight:700;color:#e91e8c;font-size:20px;':'' }}
            {{ $row[0]=='Nama Produk'?'font-weight:700;':'' }}">
            {{ $row[1] }}
          </td>
        </tr>
        @endforeach
        @if($produk->deskripsi)
        <tr>
          <td style="padding:10px 0;color:#b07090;font-size:13px;vertical-align:top;">Deskripsi</td>
          <td style="padding:10px 0;font-size:14px;color:#555;line-height:1.8;">
            {{ $produk->deskripsi }}
          </td>
        </tr>
        @endif
      </table>

      <div style="margin-top:22px;padding-top:20px;border-top:1px solid #f0c0d8;
                  display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('produk.index') }}" class="btn-secondary"
           style="text-decoration:none;">← Kembali</a>
        <a href="{{ route('katalog') }}" target="_blank" class="btn-secondary"
           style="text-decoration:none;">🌐 Lihat di Website ↗</a>
      </div>
    </div>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal-overlay" id="editModal">
  <div class="modal" style="width:520px;">
    <h3>✏️ Edit Produk</h3>
    <form method="POST"
          action="{{ route('produk.update',$produk->id_produk) }}"
          enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-field">
          <label>Nama Produk</label>
          <input type="text" name="nama_produk"
            value="{{ $produk->nama_produk }}" required>
        </div>
        <div class="form-field">
          <label>Kategori</label>
          <select name="id_kategori" required>
            @php $kategoris = \App\Models\Kategori::orderBy('nama_kategori')->get(); @endphp
            @foreach($kategoris as $kat)
              <option value="{{ $kat->id_kategori }}"
                {{ $produk->id_kategori==$kat->id_kategori?'selected':'' }}>
                {{ $kat->nama_kategori }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-grid">
        <div class="form-field">
          <label>Harga (Rp)</label>
          <input type="number" name="harga"
            value="{{ $produk->harga }}" min="0" required>
        </div>
        <div class="form-field">
          <label>Status</label>
          <select name="status">
            <option value="aktif"    {{ $produk->status=='aktif'   ?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ $produk->status=='nonaktif'?'selected':'' }}>Nonaktif</option>
          </select>
        </div>
      </div>
      <div class="form-field">
        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ $produk->deskripsi }}</textarea>
      </div>
      <div class="form-field">
        <label>Gambar Baru <span style="color:#b07090;font-weight:400;">(kosongkan jika tidak diubah)</span></label>
        <input type="file" name="gambar" accept="image/*"
               onchange="previewImg(this,'prvEdit')">
        @if($produk->gambar)
          <img id="prvEdit" src="{{ Storage::url($produk->gambar) }}"
               class="img-preview">
        @else
          <img id="prvEdit" class="img-preview" style="display:none;">
        @endif
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
function previewImg(input,id){
  var el = document.getElementById(id);
  if(input.files && input.files[0]){
    el.src = URL.createObjectURL(input.files[0]);
    el.style.display = 'block';
  }
}
document.getElementById('editModal').addEventListener('click',function(e){
  if(e.target===this) this.classList.remove('open');
});
</script>
@endpush