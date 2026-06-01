<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Donasi;
use App\User;
use App\Penjemputan;
use Illuminate\Http\Request;

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
        $kurirs = User::where('role', 'kurir')->with('kurirProfile')->get();
        
        return view('admin.donasi.show', compact('donasi', 'kurirs'));
    }
    
    public function verifikasi($id)
    {
        $donasi = Donasi::findOrFail($id);

        // Jika donasi uang langsung selesai diverifikasi
        if ($donasi->jenis_donasi == 'uang') {

            $donasi->update([
                'status' => 'selesai'
            ]);

            return back()->with('success', 'Donasi uang berhasil diverifikasi');
        }

        // Jika barang hanya diverifikasi dulu
        $donasi->update([
            'status' => 'diverifikasi'
        ]);

        return back()->with('success', 'Donasi barang berhasil diverifikasi, silakan assign kurir');
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

    public function assignKurir(Request $request, $id)
{
    $request->validate([
        'kurir_id' => 'required',
        'tanggal_jemput' => 'required|date'
    ]);

    $donasi = Donasi::findOrFail($id);

    Penjemputan::create([
        'donasi_id' => $donasi->id,
        'kurir_id' => $request->kurir_id,
        'alamat_jemput' => $donasi->user->alamat ?? '-',
        'tanggal_jemput' => $request->tanggal_jemput,
        'status' => 'menunggu'
    ]);

    return redirect()->back()
        ->with('success', 'Kurir berhasil ditugaskan!');
}
}