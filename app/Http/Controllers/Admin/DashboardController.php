<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Donasi;
use App\User;
use App\Penjemputan;
use App\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDonasiUang = Donasi::where('jenis_donasi', 'uang')->where('status', 'selesai')->sum('nominal');
        $totalDonasiBarang = Donasi::where('jenis_donasi', 'barang')->where('status', 'selesai')->count();
        $totalDonatur = User::where('role', 'donatur')->count();
        $totalPenjemputan = Penjemputan::count();
        
        $donasiPending = Donasi::where('status', 'pending')->count();
        $donasiBarangPending = Donasi::where('jenis_donasi', 'barang')->where('status', 'pending')->count();
        
        $recentDonasi = Donasi::with('user')->orderBy('created_at', 'desc')->take(10)->get();
        
        return view('admin.dashboard', compact(
            'totalDonasiUang', 'totalDonasiBarang', 'totalDonatur', 
            'totalPenjemputan', 'donasiPending', 'donasiBarangPending', 
            'recentDonasi'
        ));
    }
}