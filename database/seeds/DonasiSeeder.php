<?php


use Illuminate\Database\Seeder;
use App\Donasi;
use App\User;

class DonasiSeeder extends Seeder
{
    public function run()
    {
        $donaturs = User::where('role', 'donatur')->get();
        
        // Donasi Uang
        $donasiUang = [
            ['nominal' => 100000, 'deskripsi' => 'Donasi untuk korban bencana alam'],
            ['nominal' => 250000, 'deskripsi' => 'Semoga bermanfaat'],
            ['nominal' => 500000, 'deskripsi' => 'Bantuan untuk anak yatim'],
            ['nominal' => 75000, 'deskripsi' => 'Dari keluarga kecil'],
            ['nominal' => 1000000, 'deskripsi' => 'Donasi rutin bulanan'],
            ['nominal' => 150000, 'deskripsi' => 'Semoga cepat pulih'],
            ['nominal' => 300000, 'deskripsi' => 'Dari para donatur'],
            ['nominal' => 2000000, 'deskripsi' => 'Bantuan besar untuk bencana'],
        ];
        
        foreach ($donaturs as $index => $donatur) {
            // 3-4 donasi uang per donatur
            for ($i = 0; $i < rand(2, 4); $i++) {
                $uang = $donasiUang[array_rand($donasiUang)];
                Donasi::create([
                    'user_id' => $donatur->id,
                    'jenis_donasi' => 'uang',
                    'nominal' => $uang['nominal'],
                    'deskripsi' => $uang['deskripsi'],
                    'status' => $this->randomStatus(),
                    'tanggal' => $this->randomDate()
                ]);
            }
            
            // 2-3 donasi barang per donatur
            for ($i = 0; $i < rand(1, 3); $i++) {
                Donasi::create([
                    'user_id' => $donatur->id,
                    'jenis_donasi' => 'barang',
                    'nama_barang' => $this->randomBarang(),
                    'jumlah_barang' => rand(1, 10),
                    'kondisi' => $this->randomKondisi(),
                    'deskripsi' => 'Donasi barang untuk yang membutuhkan',
                    'status' => $this->randomStatus(),
                    'tanggal' => $this->randomDate()
                ]);
            }
        }
    }
    
    private function randomStatus()
    {
        $statuses = ['pending', 'diverifikasi', 'selesai', 'ditolak'];
        return $statuses[array_rand($statuses)];
    }
    
    private function randomDate()
    {
        $start = strtotime('2026-01-01');
        $end = strtotime('2026-04-30');
        $random = rand($start, $end);
        return date('Y-m-d', $random);
    }
    
    private function randomBarang()
    {
        $barangs = [
            'Baju layak pakai', 'Buku pelajaran', 'Mainan anak', 
            'Selimut', 'Makanan kering', 'Peralatan sekolah',
            'Sepatu', 'Alat tulis', 'Jaket', 'Popok bayi',
            'Susu formula', 'Obat-obatan', 'Perlengkapan mandi'
        ];
        return $barangs[array_rand($barangs)];
    }
    
    private function randomKondisi()
    {
        $kondisis = ['baru', 'bekas', 'rusak'];
        return $kondisis[array_rand($kondisis)];
    }
}
