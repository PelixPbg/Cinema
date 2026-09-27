@extends('layouts.app')

@section('page_title', 'Rating Film')
@section('page_subtitle', 'Catat dan kelola rating pribadi dari film-film yang telah Anda tonton.')

@section('page_actions')
<a href="{{ route('films.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Data Film
</a>
@endsection

@section('content')
@php
    $tahunTerbaru = $filmTerbaru->max('tahun_rilis');
    $ratingRataRata = $filmTerbaru->count() ? round($filmTerbaru->avg('rating'), 1) : null;
@endphp

<!-- Baris Statistik Ringkas -->
<div class="stat-row mb-5">
    <div class="stat-item">
        <span class="stat-label">Total Film</span>
        <span class="stat-value">{{ $totalFilm }}</span>
    </div>
    <div class="stat-item">
        <span class="stat-label">Total Genre</span>
        <span class="stat-value">{{ $totalGenre }}</span>
    </div>
    <div class="stat-item">
        <span class="stat-label">Film Terbaru</span>
        <span class="stat-value">{{ $tahunTerbaru ?? '—' }}</span>
    </div>
    <div class="stat-item">
        <span class="stat-label">Rating Rata-rata</span>
        <span class="stat-value">{{ $ratingRataRata ?? '—' }} <small>/ 10</small></span>
    </div>
</div>

<!-- Grid Koleksi Film -->
<div class="film-grid">
    @forelse($filmTerbaru as $film)
        <a href="{{ route('films.show', $film->id) }}" class="film-card" title="Klik untuk melihat detail / edit {{ $film->judul }}">
            <div class="poster-wrap">
                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" loading="lazy">
            </div>
            <div class="film-card-body">
                
                <!-- Layout Baru: Judul dan Rating sejajar -->
                <div class="d-flex justify-content-between align-items-center gap-2 mb-1">
                    <div class="film-card-title mb-0" style="flex: 1; min-width: 0;">{{ $film->judul }}</div>
                    <div class="rating flex-shrink-0" style="font-size: 0.75rem; font-weight: 600; color: var(--text-main);">
                        <i class="fas fa-star" style="color: var(--warning);"></i> {{ $film->rating }}
                    </div>
                </div>
                
                <!-- Sutradara di bawahnya -->
                <div class="film-card-director">{{ $film->sutradara }}</div>
                
                <!-- Genre -->
                <div class="film-card-meta mt-2 d-block">
                    <span class="badge">{{ $film->genre }}</span>
                </div>
                
            </div>
        </a>
    @empty
        <div class="surface" style="grid-column: 1 / -1;">
            <div class="empty-state">
                <i class="fas fa-film"></i>
                <h6>Belum Ada Film</h6>
                <p>Tambahkan rating film pertama Anda di Cinema.</p>
                <a href="{{ route('films.create') }}" class="btn btn-primary">Tambah Rating Film</a>
            </div>
        </div>
    @endforelse
</div>
@endsection