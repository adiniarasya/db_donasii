<?php

// app/Http/Controllers/Donatur/DonasiController.php
namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    public function create()
    {
        return view('donatur.donasi.create');
    }
    
    public function store(Request $request)
    {
        // Validasi
        $rules = [
            'jenis_donasi' => 'required|in:uang,barang',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ];
        
        if ($request->jenis_donasi == 'uang') {
            $rules['nominal'] = 'required|numeric|min:10000';
        } else {
            $rules['nama_barang'] = 'required|string|max:255';
            $rules['jumlah_barang'] = 'required|numeric|min:1';
            $rules['kondisi'] = 'required|in:baru,bekas,rusak';
        }
        
        $request->validate($rules);
        
        // Simpan data
        $data = [
            'user_id' => Auth::id(),
            'jenis_donasi' => $request->jenis_donasi,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
            'tanggal' => $request->tanggal
        ];
        
        if ($request->jenis_donasi == 'uang') {
            $data['nominal'] = $request->nominal;
        } else {
            $data['nama_barang'] = $request->nama_barang;
            $data['jumlah_barang'] = $request->jumlah_barang;
            $data['kondisi'] = $request->kondisi;
        }
        
        Donasi::create($data);
        
        return redirect()->route('donatur.riwayat')
            ->with('success', 'Donasi berhasil dikirim! Menunggu verifikasi admin.');
    }
    
    public function riwayat()
    {
        $donasis = Donasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('donatur.donasi.riwayat', compact('donasis'));
    }
}