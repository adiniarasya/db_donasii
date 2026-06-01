<?php


namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Penjemputan;
use App\Donasi;
use App\KurirProfile;
use Illuminate\Http\Request;

class PenjemputanController extends Controller
{
    public function index()
    {
        $penjemputans = Penjemputan::with('donasi.user')
            ->where('kurir_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('kurir.penjemputan.index', compact('penjemputans'));
    }
    
    public function updateStatus($id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
        
        if ($penjemputan->kurir_id != auth()->id()) {
            abort(403);
        }
        
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
            
            return redirect()->back()->with('success', 'Status berhasil diupdate');
        }
        
        return redirect()->back()->with('error', 'Status tidak dapat diupdate');
    }
        public function assign(Request $request, $donasi_id)
    {
        $request->validate([
            'kurir_id' => 'required',
            'tanggal_jemput' => 'required|date',
            'alamat_jemput' => 'required'
        ]);
        
        $donasi = Donasi::findOrFail($donasi_id);
        Penjemputan::create([
            'donasi_id' => $donasi_id,
            'kurir_id' => $request->kurir_id,
            'alamat_jemput' => $request->alamat_jemput,
            'tanggal_jemput' => $request->tanggal_jemput,
            'status' => 'menunggu'
        ]);

         $donasi->update(['status' => 'diverifikasi']);
        
        return redirect()->back()->with('success', 'Kurir berhasil ditugaskan');
    }

    public function profil()
    {
        $kurir = auth()->user();

        return view('kurir.profil', compact('kurir'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'no_hp' => 'required',
            'alamat' => 'required'
        ]);

        $profile = auth()->user()->kurirProfile;

        if ($profile) {
            $profile->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        } else {
            \App\KurirProfile::create([
                'user_id' => auth()->id(),
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        }

        return redirect()->route('kurir.profil')->with('success', 'Profil berhasil diperbarui');
    }
}
