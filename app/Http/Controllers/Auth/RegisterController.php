<?php

// app/Http/Controllers/Auth/RegisterController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\KurirProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        auth()->login($user);
        
        // Redirect berdasarkan role
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role == 'kurir') {
            return redirect('/kurir/penjemputan');
        } else {
            return redirect('/donatur/dashboard');
        }
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:donatur,kurir'],
        ];
        
        // Jika user yang login adalah admin, izinkan daftar admin
        if (auth()->check() && auth()->user()->role == 'admin') {
            $rules['role'] = ['required', 'in:donatur,kurir,admin'];
        }
        
        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        // Jika role kurir, otomatis buat profile
        if ($user->role == 'kurir') {
            KurirProfile::create([
                'user_id' => $user->id,
                'no_hp' => '-',
                'alamat' => '-'
            ]);
        }

        return $user;
    }
}