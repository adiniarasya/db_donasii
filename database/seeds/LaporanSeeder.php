<?php


use Illuminate\Database\Seeder;
use App\Laporan;
use App\Donasi;
use App\User;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    public function run()
    {
        // Generate laporan per bulan (Januari - April 2026)
        $months = ['2026-01', '2026-02', '2026-03', '2026-04'];
        
        foreach ($months as $month) {
            // Hitung donasi yang selesai di bulan tersebut
            $donasiSelesai = Donasi::where('status', 'selesai')
                ->whereYear('tanggal', substr($month, 0, 4))
                ->whereMonth('tanggal', substr($month, 5, 2))
                ->get();
            
            $totalUang = $donasiSelesai->where('jenis_donasi', 'uang')->sum('nominal');
            $totalBarang = $donasiSelesai->where('jenis_donasi', 'barang')->count();
            $jumlahDonatur = $donasiSelesai->groupBy('user_id')->count();
            
            Laporan::create([
                'periode' => $month,
                'total_donasi_uang' => $totalUang,
                'total_donasi_barang' => $totalBarang,
                'jumlah_donatur' => $jumlahDonatur
            ]);
        }
        
        // Tambah data dummy dengan nominal random
        Laporan::create([
            'periode' => '2026-05',
            'total_donasi_uang' => 8750000,
            'total_donasi_barang' => 24,
            'jumlah_donatur' => 12
        ]);
    }
}