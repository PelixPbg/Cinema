@extends('layouts.app')

@section('page_title', 'Daftar Film')
@section('page_subtitle', 'Kelola seluruh koleksi film yang tersimpan di sistem.')

@section('page_actions')
<div class="d-flex flex-column flex-sm-row gap-3">
    <form action="{{ route('films.index') }}" method="GET" class="position-relative">
        <i class="fas fa-search position-absolute text-faint" style="top: 50%; transform: translateY(-50%); left: 12px; font-size: 0.8rem;"></i>
        <input type="text" name="search" class="form-control ps-5" placeholder="Cari judul atau genre..." value="{{ request('search') }}" style="width: 260px;">
    </form>
    <a href="{{ route('films.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Film
    </a>
</div>
@endsection

@section('content')

@if(request('search'))
    <div class="text-sm text-muted mb-3">
        Menampilkan hasil untuk <span class="fw-semibold text-main">&ldquo;{{ request('search') }}&rdquo;</span>
    </div>
@endif

<div class="surface overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="ps-4" width="64">Poster</th>
                    <th>Detail Judul</th>
                    <th>Sutradara</th>
                    <th>Tahun</th>
                    <th>Rating</th>
                    <th class="text-end pe-4" width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($films as $film)
                <tr>
                    <td class="ps-4">
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="rounded" style="width: 48px; height: 68px; object-fit: cover; border: 1px solid var(--border);">
                    </td>
                    <td>
                        <div class="table-film-title">{{ $film->judul }}</div>
                        <span class="badge">{{ $film->genre }}</span>
                    </td>
                    <td class="text-muted">{{ $film->sutradara }}</td>
                    <td class="text-muted">{{ $film->tahun_rilis }}</td>
                    <td>
                        <div class="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= round($film->rating / 2) ? 'filled' : '' }}"></i>
                            @endfor
                            <span class="rating-value">{{ $film->rating }}</span>
                        </div>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-1">
                            <a href="{{ route('films.show', $film->id) }}" class="btn-icon" data-bs-toggle="tooltip" title="Lihat Detail" aria-label="Lihat detail {{ $film->judul }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('films.edit', $film->id) }}" class="btn-icon" data-bs-toggle="tooltip" title="Edit Data" aria-label="Edit {{ $film->judul }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Film \'{{ $film->judul }}\' akan dihapus permanen dan tidak dapat dikembalikan. Lanjutkan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon danger" data-bs-toggle="tooltip" title="Hapus Film" aria-label="Hapus {{ $film->judul }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            @if(request('search'))
                                <i class="fas fa-magnifying-glass"></i>
                                <h6>Film Tidak Ditemukan</h6>
                                <p>Coba gunakan kata kunci yang berbeda.</p>
                                <a href="{{ route('films.index') }}" class="btn btn-secondary">Reset Pencarian</a>
                            @else
                                <i class="fas fa-film"></i>
                                <h6>Belum Ada Film</h6>
                                <p>Tambahkan film pertama ke koleksi CineManage.</p>
                                <a href="{{ route('films.create') }}" class="btn btn-primary">Tambah Film</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($films, 'links'))
    <div class="mt-4">{{ $films->links() }}</div>
@endif
@endsection