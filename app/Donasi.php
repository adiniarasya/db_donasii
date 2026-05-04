<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';
    
    protected $fillable = [
        'user_id', 'jenis_donasi', 'nominal', 'nama_barang', 
        'jumlah_barang', 'kondisi', 'deskripsi', 'status', 'tanggal'
    ];
    
    protected $dates = ['tanggal'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function penjemputan()
    {
        return $this->hasOne(Penjemputan::class);
    }
    
    public function getKondisiLabelAttribute()
    {
        $labels = [
            'baru' => 'Baru',
            'bekas' => 'Bekas - Layak Pakai',
            'rusak' => 'Rusak - Perlu Perbaikan'
        ];
        return $labels[$this->kondisi] ?? $this->kondisi;
    }
}