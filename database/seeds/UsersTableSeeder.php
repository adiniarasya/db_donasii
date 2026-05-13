<?php

// database/seeders/UsersTableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@donasi.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);
        
        // Admin kedua (opsional)
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@donasi.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);
        
        // Donatur (5 orang)
        $donaturs = [
            ['Ahmad Fauzi', 'ahmad@email.com'],
            ['Siti Nurhaliza', 'siti@email.com'],
            ['Budi Santoso', 'budi@email.com'],
            ['Dewi Kartika', 'dewi@email.com'],
            ['Rizki Ramadhan', 'rizki@email.com'],
        ];
        
        foreach ($donaturs as $donatur) {
            User::create([
                'name' => $donatur[0],
                'email' => $donatur[1],
                'password' => Hash::make('password123'),
                'role' => 'donatur'
            ]);
        }
        
        // Kurir (3 orang)
        $kurirs = [
            ['Andi Kurir', 'andi@kurir.com', '081234567890', 'Jl. Merdeka No.1, Jakarta'],
            ['Budi Kurir', 'budi@kurir.com', '081298765432', 'Jl. Sudirman No.5, Bandung'],
            ['Cahyo Kurir', 'cahyo@kurir.com', '081355577788', 'Jl. Pahlawan No.10, Surabaya'],
        ];
        
        foreach ($kurirs as $kurir) {
            $user = User::create([
                'name' => $kurir[0],
                'email' => $kurir[1],
                'password' => Hash::make('password123'),
                'role' => 'kurir'
            ]);
            
            // Create kurir profile
            \App\KurirProfile::create([
                'user_id' => $user->id,
                'no_hp' => $kurir[2],
                'alamat' => $kurir[3]
            ]);
        }
    }
}