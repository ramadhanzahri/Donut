{{-- ═══════════════════════════════════════════════════════
     DELETE CONFIRMATION MODAL — reusable partial
     Cara pakai:
       @include('dashboard.partials.delete-modal')
     Trigger via JS:
       openDeleteModal(url, judul, deskripsiHtml)
═══════════════════════════════════════════════════════ --}}

<div class="modal-overlay" id="deleteModal" style="z-index:600">
    <div class="modal" style="max-width:420px">
        <div class="modal-header" style="border-bottom-color:#fee2e2">
            <span class="modal-title" style="color:#dc2626">
                <i class="fa-solid fa-triangle-exclamation" style="margin-right:6px"></i>
                Konfirmasi Hapus
            </span>
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>

        <div class="modal-body" style="text-align:center;padding:32px 28px 24px">
            {{-- Ikon animasi --}}
            <div style="width:72px;height:72px;border-radius:50%;background:#fef2f2;
                        margin:0 auto 20px;display:flex;align-items:center;
                        justify-content:center;font-size:30px;
                        border:2px solid #fecaca;animation:pulseRed 1.6s infinite">
                <i class="fa-solid fa-trash" style="color:#dc2626"></i>
            </div>

            <h3 id="deleteModalTitle" style="font-size:16px;font-weight:700;
                color:var(--text);margin-bottom:10px">Hapus item ini?</h3>

            <p id="deleteModalDesc"
               style="font-size:13.5px;color:var(--text-mid);line-height:1.6;max-width:300px;margin:0 auto">
                Tindakan ini tidak dapat dibatalkan.
            </p>

            <div style="margin-top:18px;padding:10px 14px;background:#fef2f2;
                        border-radius:var(--radius-sm);border:1px solid #fecaca;
                        font-size:12px;color:#dc2626;display:flex;align-items:center;gap:8px">
                <i class="fa-solid fa-circle-info"></i>
                Data yang dihapus <strong>tidak bisa dipulihkan</strong>.
            </div>
        </div>

        <div class="modal-footer" style="border-top-color:#fee2e2">
            <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                <i class="fa-solid fa-xmark"></i> Batal
            </button>
            <form id="deleteForm" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" id="deleteConfirmBtn">
                    <i class="fa-solid fa-trash"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes pulseRed{
    0%,100%{box-shadow:0 0 0 0 rgba(220,38,38,.2)}
    50%{box-shadow:0 0 0 8px rgba(220,38,38,.0)}
}
</style>

<script>
function openDeleteModal(url, title, descHtml){
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModalTitle').textContent = title;
    document.getElementById('deleteModalDesc').innerHTML    = descHtml || 'Tindakan ini tidak dapat dibatalkan.';
    document.getElementById('deleteModal').classList.add('show');
}
function closeDeleteModal(){
    document.getElementById('deleteModal').classList.remove('show');
}

// Prevent double-submit: disable button after click
document.getElementById('deleteForm').addEventListener('submit', function(){
    var btn = document.getElementById('deleteConfirmBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menghapus...';
});
</script>
