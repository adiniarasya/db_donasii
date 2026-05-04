<?php


namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];
    
    protected $hidden = ['password', 'remember_token'];
    
    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }
    
    public function kurirProfile()
    {
        return $this->hasOne(KurirProfile::class);
    }
    
    public function penjemputan()
    {
        return $this->hasMany(Penjemputan::class, 'kurir_id');
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isDonatur()
    {
        return $this->role === 'donatur';
    }
    
    public function isKurir()
    {
        return $this->role === 'kurir';
    }
}