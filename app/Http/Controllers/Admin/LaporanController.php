<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Laporan;
use App\Donasi;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF; // Tambahkan ini

class LaporanController extends Controller
{
    public function index()
    {
        // ambil data laporan (kalau ada)
        $laporans = Laporan::orderBy('periode', 'desc')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK
        |--------------------------------------------------------------------------
        */

        $donasiPerBulan = Donasi::select(
                DB::raw("MONTH(tanggal) as bulan"),
                DB::raw("SUM(CASE WHEN jenis_donasi = 'uang' THEN nominal ELSE 0 END) as total_uang"),
                DB::raw("SUM(CASE WHEN jenis_donasi = 'barang' THEN jumlah_barang ELSE 0 END) as total_barang")
            )
            ->where('status', '!=', 'ditolak')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $chartLabels = [];
        $chartUang = [];
        $chartBarang = [];

        foreach ($donasiPerBulan as $data) {

            $chartLabels[] = $namaBulan[$data->bulan];
            $chartUang[] = $data->total_uang;
            $chartBarang[] = $data->total_barang;
        }

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN DONASI
        |--------------------------------------------------------------------------
        */

        $totalUang = Donasi::where('jenis_donasi', 'uang')
            ->where('status', '!=', 'ditolak')
            ->sum('nominal');

        $totalBarang = Donasi::where('jenis_donasi', 'barang')
            ->where('status', '!=', 'ditolak')
            ->sum('jumlah_barang');

        $totalDonatur = Donasi::distinct('user_id')
            ->count('user_id');

        /*
        |--------------------------------------------------------------------------
        | AUTO GENERATE TABEL LAPORAN
        |--------------------------------------------------------------------------
        | Kalau tabel laporan kosong,
        | otomatis ambil dari data donasi
        |--------------------------------------------------------------------------
        */

        if ($laporans->isEmpty()) {

            $laporans = collect();

            foreach ($donasiPerBulan as $data) {

                $jumlahDonatur = Donasi::whereMonth('tanggal', $data->bulan)
                    ->distinct()
                    ->count('user_id');

                $laporans->push((object)[
                    'periode' => $namaBulan[$data->bulan],
                    'total_donasi_uang' => $data->total_uang,
                    'total_donasi_barang' => $data->total_barang,
                    'jumlah_donatur' => $jumlahDonatur,
                ]);
            }
        }

        return view('admin.laporan.index', compact(
            'laporans',
            'chartLabels',
            'chartUang',
            'chartBarang',
            'totalUang',
            'totalBarang',
            'totalDonatur'
        ));
    }

    /**
     * =========================================================================
     * METHOD CETAK PDF PER PERIODE
     * =========================================================================
     */
    public function cetakPDF($periode)
    {
        // Cari data laporan berdasarkan periode
        $laporan = Laporan::where('periode', $periode)->first();
        
        // Jika tidak ada di tabel laporan, ambil dari data donasi
        if (!$laporan) {
            // Konversi nama bulan ke angka
            $namaBulan = [
                'Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4,
                'Mei' => 5, 'Jun' => 6, 'Jul' => 7, 'Agu' => 8,
                'Sep' => 9, 'Okt' => 10, 'Nov' => 11, 'Des' => 12
            ];
            
            $bulan = $namaBulan[$periode] ?? null;
            
            if ($bulan) {
                // Hitung data donasi untuk bulan tersebut
                $totalUangBulan = Donasi::where('jenis_donasi', 'uang')
                    ->where('status', '!=', 'ditolak')
                    ->whereMonth('tanggal', $bulan)
                    ->sum('nominal');
                
                $totalBarangBulan = Donasi::where('jenis_donasi', 'barang')
                    ->where('status', '!=', 'ditolak')
                    ->whereMonth('tanggal', $bulan)
                    ->sum('jumlah_barang');
                
                $jumlahDonaturBulan = Donasi::whereMonth('tanggal', $bulan)
                    ->where('status', '!=', 'ditolak')
                    ->distinct('user_id')
                    ->count('user_id');
                
                // Buat object laporan sementara
                $laporan = (object)[
                    'periode' => $periode,
                    'total_donasi_uang' => $totalUangBulan,
                    'total_donasi_barang' => $totalBarangBulan,
                    'jumlah_donatur' => $jumlahDonaturBulan,
                ];
            }
        }
        
        // Jika data tidak ditemukan, return error
        if (!$laporan) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan');
        }
        
        // Data total keseluruhan untuk ringkasan
        $totalUang = Donasi::where('jenis_donasi', 'uang')
            ->where('status', '!=', 'ditolak')
            ->sum('nominal');
        
        $totalBarang = Donasi::where('jenis_donasi', 'barang')
            ->where('status', '!=', 'ditolak')
            ->sum('jumlah_barang');
        
        $totalDonatur = Donasi::distinct('user_id')
            ->count('user_id');
        
        // Ambil detail donasi untuk periode ini (opsional)
        $bulanAngka = null;
        $namaBulan = [
            'Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4,
            'Mei' => 5, 'Jun' => 6, 'Jul' => 7, 'Agu' => 8,
            'Sep' => 9, 'Okt' => 10, 'Nov' => 11, 'Des' => 12
        ];
        
        $bulanAngka = $namaBulan[$laporan->periode] ?? null;
        
        $detailDonasi = [];
        if ($bulanAngka) {
            $detailDonasi = Donasi::whereMonth('tanggal', $bulanAngka)
                ->where('status', '!=', 'ditolak')
                ->with('user')
                ->orderBy('tanggal', 'desc')
                ->get();
        }
        
        // Load view PDF
        $pdf = PDF::loadView('admin.laporan.pdf', compact(
            'laporan', 
            'totalUang', 
            'totalBarang', 
            'totalDonatur',
            'detailDonasi'
        ));
        
        // Set ukuran kertas A4 portrait
        $pdf->setPaper('A4', 'portrait');
        
        // Download PDF
        return $pdf->download('laporan_donasi_' . $laporan->periode . '_' . date('Ymd') . '.pdf');
    }
}