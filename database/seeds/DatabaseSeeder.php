<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\KurirProfile;
use App\Donasi;
use App\Penjemputan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // DONATUR
        $donatur = User::create([
            'name' => 'Donatur',
            'email' => 'donatur@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'donatur'
        ]);

        // KURIR
        $kurir = User::create([
            'name' => 'Kurir',
            'email' => 'kurir@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'kurir'
        ]);

        KurirProfile::create([
            'user_id' => $kurir->id,
            'no_hp' => '08123456789',
            'alamat' => 'Jl. Krukut'
        ]);

        // DONASI BARANG
        $donasi = Donasi::create([
            'user_id' => $donatur->id,
            'jenis_donasi' => 'barang',
            'nama_barang' => 'Baju',
            'jumlah_barang' => 10,
            'kondisi' => 'baru',
            'deskripsi' => 'Baju layak pakai',
            'status' => 'diverifikasi',
            'tanggal' => now()
        ]);

        // DONASI UANG
        $donasi = Donasi::create([
            'user_id' => $donatur->id,
            'jenis_donasi' => 'uang',
            'nominal' => 500000,
            'deskripsi' => 'Donasi uang untuk korban bencana',
            'status' => 'pending',
            'tanggal' => now()
        ]);

        // PENJEMPUTAN
        Penjemputan::create([
            'donasi_id' => $donasi->id,
            'kurir_id' => $kurir->id,
            'alamat_jemput' => 'Jl. PLN',
            'tanggal_jemput' => now(),
            'status' => 'menunggu'
        ]);
    }
}