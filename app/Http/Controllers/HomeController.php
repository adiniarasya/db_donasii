<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Laporan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalDonasiUang = Donasi::where('jenis_donasi', 'uang')->where('status', 'selesai')->sum('nominal');
        $totalDonasiBarang = Donasi::where('jenis_donasi', 'barang')->where('status', 'selesai')->count();
        
        // Perbaiki query ini - menggunakan DB::raw atau distinct count
        $totalDonatur = Donasi::where('status', 'selesai')
            ->distinct('user_id')
            ->count('user_id');
        
        $recentDonasi = Donasi::with('user')
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        return view('home', compact('totalDonasiUang', 'totalDonasiBarang', 'totalDonatur', 'recentDonasi'));
    }
}