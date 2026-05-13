<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Donasi;
use App\Penjemputan;
use Illuminate\Http\Request;

class PenjemputanController extends Controller
{
    public function assign(Request $request, $donasi_id)
    {
        $request->validate([
            'kurir_id' => 'required|exists:users,id',
            'tanggal_jemput' => 'required|date',
            'alamat_jemput' => 'required|string'
        ]);
        
        $donasi = Donasi::findOrFail($donasi_id);
        
        // Cek apakah sudah ada penjemputan untuk donasi ini
        $existingPenjemputan = Penjemputan::where('donasi_id', $donasi_id)->first();
        
        if ($existingPenjemputan) {
            return redirect()->back()->with('error', 'Donasi ini sudah diassign ke kurir!');
        }
        
        // Buat penjemputan baru
        Penjemputan::create([
            'donasi_id' => $donasi_id,
            'kurir_id' => $request->kurir_id,
            'alamat_jemput' => $request->alamat_jemput,
            'tanggal_jemput' => $request->tanggal_jemput,
            'status' => 'menunggu'
        ]);
        
        // Update status donasi
        $donasi->update(['status' => 'diverifikasi']);
        
        return redirect()->route('admin.donasi.show', $donasi_id)
            ->with('success', 'Kurir berhasil ditugaskan!');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
        
        // Update status berdasarkan urutan
        $statusFlow = [
            'menunggu' => 'diproses',
            'diproses' => 'menuju',
            'menuju' => 'selesai'
        ];
        
        if (isset($statusFlow[$penjemputan->status])) {
            $penjemputan->update(['status' => $statusFlow[$penjemputan->status]]);
            
            // Jika selesai, update status donasi
            if ($penjemputan->status == 'selesai') {
                $penjemputan->donasi->update(['status' => 'selesai']);
            }
            
            return redirect()->back()->with('success', 'Status penjemputan berhasil diupdate!');
        }
        
        return redirect()->back()->with('error', 'Status tidak dapat diupdate!');
    }
    
    public function index()
    {
        $penjemputans = Penjemputan::with('donasi.user', 'kurir')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.penjemputan.index', compact('penjemputans'));
    }
    
    public function destroy($id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
        $donasiId = $penjemputan->donasi_id;
        
        // Hapus penjemputan
        $penjemputan->delete();
        
        // Update status donasi kembali ke diverifikasi
        Donasi::where('id', $donasiId)->update(['status' => 'diverifikasi']);
        
        return redirect()->back()->with('success', 'Penugasan kurir dibatalkan!');
    }
}