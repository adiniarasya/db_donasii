<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Donasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $donasiUang = Donasi::where('user_id', Auth::id())
            ->where('jenis_donasi', 'uang')
            ->sum('nominal');
            
        $donasiBarang = Donasi::where('user_id', Auth::id())
            ->where('jenis_donasi', 'barang')
            ->count();
            
        $totalDonasi = Donasi::where('user_id', Auth::id())->count();
        $donasiSelesai = Donasi::where('user_id', Auth::id())->where('status', 'selesai')->count();
        
        $recentDonasi = Donasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('donatur.dashboard', compact(
            'donasiUang', 'donasiBarang', 'totalDonasi', 'donasiSelesai', 'recentDonasi'
        ));
    }
}