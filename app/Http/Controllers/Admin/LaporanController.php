<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Laporan;
use App\Donasi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::orderBy('periode', 'desc')->get();
        
        // Data untuk chart
        $chartLabels = [];
        $chartUang = [];
        $chartBarang = [];
        
        foreach ($laporans->take(6) as $laporan) {
            $chartLabels[] = $laporan->periode;
            $chartUang[] = $laporan->total_donasi_uang;
            $chartBarang[] = $laporan->total_donasi_barang;
        }
        
        $totalUang = Donasi::where('jenis_donasi', 'uang')->where('status', 'selesai')->sum('nominal');
        $totalBarang = Donasi::where('jenis_donasi', 'barang')->where('status', 'selesai')->count();
        
        // Perbaiki query ini
        $totalDonatur = Donasi::where('status', 'selesai')
            ->distinct('user_id')
            ->count('user_id');
        
        return view('admin.laporan.index', compact(
            'laporans', 'chartLabels', 'chartUang', 'chartBarang', 
            'totalUang', 'totalBarang', 'totalDonatur'
        ));
    }
}