@extends('layouts.app')

@section('page_title', 'Detail Rating Film')
@section('page_subtitle', 'Informasi lengkap, sinopsis, dan metadata film.')

@section('page_actions')
<div class="d-flex gap-2">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary shadow-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <a href="{{ route('films.edit', $film->id) }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-edit"></i> Edit Data
    </a>
</div>
@endsection

@section('content')
<div class="surface p-0 overflow-hidden mx-auto" style="max-width: 960px;">
    <div class="row g-0">
        <!-- Poster Column (Lebar ditambah sedikit agar metadata di bawahnya tidak nabrak) -->
        <div class="col-md-5 col-lg-4" style="background: rgba(248, 250, 252, 0.4); border-right: 1px solid var(--border-light);">
            <div class="p-4">
                <div style="aspect-ratio: 2 / 3; border-radius: var(--radius-md); overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: var(--shadow-md); transition: transform 0.3s ease;">
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" data-bs-toggle="modal" data-bs-target="#imageModal" role="button" title="Klik untuk perbesar">
                </div>
            </div>
            
            <div class="px-4 pb-4">
                <div class="d-flex align-items-center justify-content-between text-sm py-3 gap-2" style="border-top: 1px solid var(--border-light);">
                    <span class="text-muted d-inline-flex align-items-center gap-2 flex-shrink-0 font-weight-500">
                        <span style="width: 28px; height: 28px; border-radius: 8px; background: var(--primary-soft); color: var(--primary-text); display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-clock" style="font-size: 0.75rem;"></i>
                        </span>
                        Durasi
                    </span>
                    <span class="fw-bold text-main text-end" style="white-space: nowrap;">{{ $film->durasi }} Menit</span>
                </div>
                <div class="d-flex align-items-center justify-content-between text-sm py-3 gap-2" style="border-top: 1px solid var(--border-light);">
                    <span class="text-muted d-inline-flex align-items-center gap-2 flex-shrink-0 font-weight-500">
                        <span style="width: 28px; height: 28px; border-radius: 8px; background: var(--accent-purple-soft); color: var(--accent-purple-text); display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-calendar" style="font-size: 0.75rem;"></i>
                        </span>
                        Tahun
                    </span>
                    <span class="fw-bold text-main text-end" style="white-space: nowrap;">{{ $film->tahun_rilis }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between text-sm py-3 gap-2" style="border-top: 1px solid var(--border-light);">
                    <span class="text-muted d-inline-flex align-items-center gap-2 flex-shrink-0 font-weight-500">
                        <span style="width: 28px; height: 28px; border-radius: 8px; background: var(--accent-green-soft); color: var(--accent-green-text); display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-plus" style="font-size: 0.75rem;"></i>
                        </span>
                        Ditambahkan
                    </span>
                    <span class="fw-bold text-main text-end" style="white-space: nowrap;">{{ $film->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Information Column -->
        <div class="col-md-7 col-lg-8 p-4 p-md-5">
            <!-- Genre Badge -->
            <div class="mb-3">
                <span class="badge" style="font-size: 0.75rem; letter-spacing: 0.04em; padding: 0.4rem 0.85rem; border: 1px solid var(--border-light);">
                    {{ $film->genre }}
                </span>
            </div>
            
            <h1 class="fw-bold mb-3 lh-sm" style="font-size: 2.25rem; letter-spacing: -0.02em;">{{ $film->judul }}</h1>

            <!-- RATING & DIRECTOR SECTION -->
            <div class="d-flex flex-wrap align-items-center gap-3 mb-4 pb-4" style="border-bottom: 1px solid var(--border-light);">
                <span class="text-sm text-muted">Sutradara <span class="fw-bold text-main" style="color: var(--primary-text);">{{ $film->sutradara }}</span></span>
                <span class="d-none d-sm-inline" style="color: var(--border-strong);">•</span>
                
                <div class="rating px-3 py-1" style="background: var(--accent-amber-soft); border-radius: 8px; border: 1px solid rgba(245, 158, 11, 0.2);">
                    @php $rating5 = $film->rating / 2; @endphp
                    <div class="d-flex align-items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($rating5))
                                <i class="fas fa-star" style="color: #F59E0B; font-size: 0.85rem;"></i>
                            @elseif($i == ceil($rating5) && $rating5 - floor($rating5) > 0)
                                <i class="fas fa-star-half-alt" style="color: #F59E0B; font-size: 0.85rem;"></i>
                            @else
                                <i class="fas fa-star" style="color: #E2E8F0; font-size: 0.85rem;"></i>
                            @endif
                        @endfor
                        <span class="ms-2 fw-bold" style="font-size: 0.95rem; color: var(--accent-amber-text);">
                            {{ $film->rating }} <span class="fw-normal" style="font-size: 0.75rem; opacity: 0.7;">/ 10</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- SYNOPSIS BLOCK -->
            <div class="mb-5">
                <span class="eyebrow d-block mb-3" style="color: var(--primary-text);">Sinopsis Cerita</span>
                <div style="background: linear-gradient(to right, rgba(37, 99, 235, 0.04), transparent); border-left: 3px solid var(--primary); padding: 1.25rem 1.5rem; border-radius: 0 var(--radius-md) var(--radius-md) 0;">
                    <p class="text-muted mb-0" style="line-height: 1.85; font-size: 0.95rem; white-space: pre-line; color: #334155 !important;">{{ $film->deskripsi }}</p>
                </div>
            </div>

            <!-- TOMBOL HAPUS -->
            <div class="pt-4 d-flex justify-content-end" style="border-top: 1px solid var(--border-light);">
                <button type="button" class="btn btn-secondary text-danger" style="background: transparent; border-color: transparent; box-shadow: none;" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash-can"></i> Hapus Data Film
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-lg); background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
            <div class="modal-body p-4 text-center">
                <div class="mb-3 text-danger" style="font-size: 2.5rem;">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <h5 class="fw-bold mb-2">Hapus Data Film?</h5>
                <p class="text-muted text-sm mb-4">Film <strong>"{{ $film->judul }}"</strong> beserta ratingnya akan dihapus permanen.</p>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn px-4" style="background-color: var(--danger); color: white; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIGHTBOX POSTER -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1) grayscale(100%) brightness(200%);"></button>
            </div>
            <div class="modal-body text-center pt-0">
                <img id="largePreviewImg" src="{{ asset('storage/' . $film->poster) }}" class="img-fluid rounded shadow-lg" alt="Preview Gambar Besar" style="max-height: 80vh; object-fit: contain; border: 1px solid rgba(255,255,255,0.2);">
            </div>
        </div>
    </div>
</div>
@endsection