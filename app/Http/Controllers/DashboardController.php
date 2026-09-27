<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total film
        $totalFilm = Film::count();
        
        // Hitung total genre unik
        $totalGenre = Film::select('genre')->distinct()->count();
        
        // AMBIL SEMUA FILM (sebelumnya pasti ada ->take(5) di sini, sekarang kita hapus)
        // Pakai ->get() supaya keambil semua datanya
        $filmTerbaru = Film::latest()->get();

        return view('dashboard', compact('totalFilm', 'totalGenre', 'filmTerbaru'));
    }
}