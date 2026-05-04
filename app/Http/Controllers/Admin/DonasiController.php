<?php

// app/Http/Controllers/Admin/DonasiController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Donasi;
use App\User;
use App\Penjemputan;

class DonasiController extends Controller
{
    public function index()
    {
        $donasis = Donasi::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.donasi.index', compact('donasis'));
    }
    
    public function show($id)
    {
        $donasi = Donasi::with('user', 'penjemputan.kurir')->findOrFail($id);
        
        // Ambil hanya user dengan role kurir dan pastikan memiliki profile
        $kurirs = User::where('role', 'kurir')
            ->with('kurirProfile')
            ->get()
            ->filter(function($kurir) {
                // Hanya tampilkan kurir yang sudah lengkap profile-nya
                return $kurir->kurirProfile !== null;
            });
        
        return view('admin.donasi.show', compact('donasi', 'kurirs'));
    }
    
    public function verifikasi($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => 'diverifikasi']);
        
        return redirect()->back()->with('success', 'Donasi berhasil diverifikasi');
    }
    
    public function selesai($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => 'selesai']);
        
        return redirect()->back()->with('success', 'Donasi selesai diproses');
    }
    
    public function tolak($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => 'ditolak']);
        
        return redirect()->back()->with('success', 'Donasi ditolak');
    }
}