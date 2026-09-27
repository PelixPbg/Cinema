@extends('layouts.app')

@section('page_title', 'Tambah Rating Film')
@section('page_subtitle', 'Masukkan data film beserta rating dan ulasan Anda.')

<!-- Tombol Kembali -->
@section('page_actions')
<a href="{{ route('dashboard') }}" class="btn btn-secondary shadow-sm">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" id="filmForm">
    @csrf

    <div class="surface p-4 p-md-5 mx-auto" style="max-width: 800px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px);">

        <div class="section-heading mb-4 pb-2" style="border-bottom: 1px solid var(--border-light);">
            <h5 class="mb-0 fw-bold" style="color: var(--primary-text);">Informasi Dasar</h5>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <label class="form-label">Judul Film</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="field_judul" value="{{ old('judul') }}" placeholder="Contoh: Inception">
                @error('judul') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Genre</label>
                <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" id="field_genre" value="{{ old('genre') }}" placeholder="Contoh: Sci-Fi, Thriller">
                @error('genre') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Sutradara</label>
                <input type="text" class="form-control @error('sutradara') is-invalid @enderror" name="sutradara" id="field_sutradara" value="{{ old('sutradara') }}">
                @error('sutradara') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Tahun Rilis</label>
                <input type="number" class="form-control @error('tahun_rilis') is-invalid @enderror" name="tahun_rilis" id="field_tahun" value="{{ old('tahun_rilis') }}">
                @error('tahun_rilis') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="section-heading mb-4 pb-2" style="border-bottom: 1px solid var(--border-light);">
            <h5 class="mb-0 fw-bold" style="color: var(--primary-text);">Spesifikasi &amp; Rating</h5>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <label class="form-label">Durasi <span class="text-muted fw-normal">(Menit)</span></label>
                <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" id="field_durasi" value="{{ old('durasi') }}">
                @error('durasi') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Rating <span class="text-muted fw-normal">(Skala 10)</span></label>
                <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" name="rating" id="field_rating" value="{{ old('rating') }}">
                @error('rating') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="section-heading mb-4 pb-2" style="border-bottom: 1px solid var(--border-light);">
            <h5 class="mb-0 fw-bold" style="color: var(--primary-text);">Sinopsis &amp; Poster</h5>
        </div>
        <div class="mb-4">
            <label class="form-label">Sinopsis / Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="field_deskripsi" rows="5" placeholder="Tuliskan deskripsi plot film...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-5">
            <label class="form-label">Upload Poster</label>
            
            <!-- Area Dropzone Area Unggah -->
            <label class="upload-dropzone d-block" id="dropzone">
                <i class="fas fa-cloud-arrow-up"></i>
                <span class="dz-title d-block">Klik atau seret file ke sini</span>
                <span class="dz-sub">JPG, JPEG, PNG atau WEBP — maksimal 2MB</span>
                <input type="file" name="poster" id="posterInput" accept="image/*">
            </label>

            <!-- Area Preview Hasil Unggah -->
            <div class="upload-preview d-none" id="posterPreview" style="align-items: center; gap: 1.25rem; border: 1px solid var(--border); border-radius: 8px; padding: 1rem; background: rgba(248, 250, 252, 0.6);">
                <div style="width: 70px; height: 100px; flex-shrink: 0; border-radius: 6px; overflow: hidden; border: 1px solid var(--border);">
                    <img id="posterPreviewImg" src="" alt="Preview poster" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal" title="Klik untuk memperbesar">
                </div>
                <div class="upload-preview-info" style="flex-grow: 1;">
                    <div class="up-name" id="posterFileName">Nama file</div>
                    <div class="up-sub text-primary fw-medium">Siap untuk diunggah</div>
                </div>
                <button type="button" class="up-remove" id="posterRemove" style="font-size: 0.8125rem; color: var(--danger); background: #fff; border: 1px solid var(--danger-border); padding: 0.4rem 0.75rem; border-radius: 6px;">
                    <i class="fas fa-trash-can me-1"></i> Hapus
                </button>
            </div>
            
            @error('poster') <div class="text-danger text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-end gap-3 pt-4" style="border-top: 1px solid var(--border-light);">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </div>
</form>

<!-- Modal untuk nampilin gambar besar (Lightbox) -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1) grayscale(100%) brightness(200%);"></button>
            </div>
            <div class="modal-body text-center pt-0">
                <img id="largePreviewImg" src="" class="img-fluid rounded shadow-lg" alt="Preview Gambar Besar" style="max-height: 80vh; object-fit: contain; border: 1px solid rgba(255,255,255,0.2);">
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    (function () {
        var input = document.getElementById('posterInput');
        var dropzone = document.getElementById('dropzone');
        var preview = document.getElementById('posterPreview');
        var previewImg = document.getElementById('posterPreviewImg');
        var largePreviewImg = document.getElementById('largePreviewImg');
        var fileName = document.getElementById('posterFileName');
        var removeBtn = document.getElementById('posterRemove');
        var form = document.getElementById('filmForm');

        // Field inputs untuk memori ketikan saat refresh
        var fields = ['judul', 'genre', 'sutradara', 'tahun_rilis', 'durasi', 'rating', 'deskripsi'];

        // Pulihkan data dari localStorage jika ada saat halaman dimuat
        fields.forEach(function(fieldName) {
            var el = document.getElementById('field_' + fieldName) || document.querySelector('[name="' + fieldName + '"]');
            if (el && !el.value) {
                var savedVal = localStorage.getItem('film_draft_' + fieldName);
                if (savedVal) el.value = savedVal;
            }
            
            // Simpan otomatis ke localStorage setiap kali user mengetik
            if (el) {
                el.addEventListener('input', function() {
                    localStorage.setItem('film_draft_' + fieldName, el.value);
                });
            }
        });

        // Hapus memori draf di localStorage saat form berhasil disubmit
        form.addEventListener('submit', function() {
            fields.forEach(function(fieldName) {
                localStorage.removeItem('film_draft_' + fieldName);
            });
        });

        function showPreview(file) {
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                largePreviewImg.src = e.target.result; 
                fileName.textContent = file.name;
                
                dropzone.classList.remove('d-block');
                dropzone.classList.add('d-none');
                
                preview.classList.remove('d-none');
                preview.classList.add('d-flex');
            };
            reader.readAsDataURL(file);
        }

        input.addEventListener('change', function () {
            if (input.files && input.files[0]) showPreview(input.files[0]);
        });

        ['dragover', 'dragenter'].forEach(function (evt) {
            dropzone.addEventListener(evt, function (e) { e.preventDefault(); dropzone.classList.add('dragover'); });
        });
        ['dragleave', 'drop'].forEach(function (evt) {
            dropzone.addEventListener(evt, function (e) { e.preventDefault(); dropzone.classList.remove('dragover'); });
        });
        dropzone.addEventListener('drop', function (e) {
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                input.files = e.dataTransfer.files;
                showPreview(e.dataTransfer.files[0]);
            }
        });

        removeBtn.addEventListener('click', function () {
            input.value = '';
            
            preview.classList.remove('d-flex');
            preview.classList.add('d-none');
            
            dropzone.classList.remove('d-none');
            dropzone.classList.add('d-block');
        });
    })();
</script>
@endsection
@endsection