<?php


use Illuminate\Database\Seeder;
use App\Donasi;
use App\User;
use App\Penjemputan;

class PenjemputanSeeder extends Seeder
{
    public function run()
    {
        // Ambil donasi barang yang statusnya sudah diverifikasi atau selesai
        $donasiBarang = Donasi::where('jenis_donasi', 'barang')
            ->whereIn('status', ['diverifikasi', 'selesai'])
            ->get();
        
        $kurirs = User::where('role', 'kurir')->get();
        
        foreach ($donasiBarang as $donasi) {
            // Kurangi donasi yang diproses (80% donasi barang dapat kurir)
            if (rand(1, 100) <= 80) {
                $kurir = $kurirs->random();
                
                Penjemputan::create([
                    'donasi_id' => $donasi->id,
                    'kurir_id' => $kurir->id,
                    'alamat_jemput' => $this->randomAlamat(),
                    'tanggal_jemput' => $this->randomTanggalJemput($donasi->tanggal),
                    'status' => $this->randomPenjemputanStatus()
                ]);
            }
        }
    }
    
    private function randomAlamat()
    {
        $alamats = [
            'Jl. Kenangan No.45, RT 02 RW 05, Jakarta Selatan',
            'Jl. Mawar Indah Blok A No.12, Bandung',
            'Perumahan Griya Asri, Jl. Cempaka No.8, Surabaya',
            'Jl. Diponegoro No.23, Yogyakarta',
            'Komplek Bumi Indah, Jl. Melati No.15, Semarang'
        ];
        return $alamats[array_rand($alamats)];
    }
    
    private function randomTanggalJemput($tanggalDonasi)
    {
        $start = strtotime($tanggalDonasi);
        $end = $start + (7 * 24 * 60 * 60); // +7 hari
        $random = rand($start, $end);
        return date('Y-m-d', $random);
    }
    
    private function randomPenjemputanStatus()
    {
        $statuses = ['menunggu', 'diproses', 'menuju', 'selesai', 'batal'];
        return $statuses[array_rand($statuses)];
    }
}