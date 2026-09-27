<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        // Langsung dialihkan ke dashboard agar halaman tabel lenyap dan tidak error
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'sutradara' => 'required|string|max:255',
            'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
            'durasi' => 'required|numeric|min:1',
            'rating' => 'required|numeric|min:0|max:10',
            'deskripsi' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload Poster
        $posterPath = $request->file('poster')->store('posters', 'public');

        // Simpan ke database
        Film::create([
            'judul' => $request->judul,
            'genre' => $request->genre,
            'sutradara' => $request->sutradara,
            'tahun_rilis' => $request->tahun_rilis,
            'durasi' => $request->durasi,
            'rating' => $request->rating,
            'deskripsi' => $request->deskripsi,
            'poster' => $posterPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Film berhasil ditambahkan!');
    }

    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'sutradara' => 'required|string|max:255',
            'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
            'durasi' => 'required|numeric|min:1',
            'rating' => 'required|numeric|min:0|max:10',
            'deskripsi' => 'required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Poster boleh kosong saat diedit
        ]);

        $data = $request->all();

        // Cek jika ada upload poster baru
        if ($request->hasFile('poster')) {
            // Hapus poster lama
            if (Storage::disk('public')->exists($film->poster)) {
                Storage::disk('public')->delete($film->poster);
            }
            // Upload poster baru
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $film->update($data);

        return redirect()->route('dashboard')->with('success', 'Data film berhasil diperbarui!');
    }

    public function destroy(Film $film)
    {
        // Hapus file poster
        if (Storage::disk('public')->exists($film->poster)) {
            Storage::disk('public')->delete($film->poster);
        }
        
        $film->delete();

        return redirect()->route('dashboard')->with('success', 'Film berhasil dihapus!');
    }
}