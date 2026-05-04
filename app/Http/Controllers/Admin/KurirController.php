<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use App\KurirProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KurirController extends Controller
{
    public function index()
    {
        $kurirs = User::where('role', 'kurir')
            ->with('kurirProfile')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.kurir.index', compact('kurirs'));
    }
    
    public function create()
    {
        return view('admin.kurir.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);
        
        // Buat user kurir
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kurir'
        ]);
        
        // Buat profile kurir
        KurirProfile::create([
            'user_id' => $user->id,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);
        
        return redirect()->route('admin.kurir.index')
            ->with('success', 'Kurir berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        $kurir = User::where('role', 'kurir')->with('kurirProfile')->findOrFail($id);
        return view('admin.kurir.edit', compact('kurir'));
    }
    
    public function update(Request $request, $id)
    {
        $kurir = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);
        
        $kurir->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        if ($request->password) {
            $kurir->update(['password' => Hash::make($request->password)]);
        }
        
        // Update profile
        if ($kurir->kurirProfile) {
            $kurir->kurirProfile->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        }
        
        return redirect()->route('admin.kurir.index')
            ->with('success', 'Kurir berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $kurir = User::findOrFail($id);
        
        // Hapus profile dulu
        if ($kurir->kurirProfile) {
            $kurir->kurirProfile->delete();
        }
        
        $kurir->delete();
        
        return redirect()->route('admin.kurir.index')
            ->with('success', 'Kurir berhasil dihapus!');
    }
}