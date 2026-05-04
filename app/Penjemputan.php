<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    protected $table = 'penjemputan';
    
    protected $fillable = [
        'donasi_id', 'kurir_id', 'alamat_jemput', 'tanggal_jemput', 'status'
    ];
    
    protected $dates = ['tanggal_jemput'];
    
    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
    
    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }
    
    public function getStatusLabelAttribute()
    {
        $labels = [
            'menunggu' => 'Menunggu Kurir',
            'diproses' => 'Sedang Diproses',
            'menuju' => 'Menuju Lokasi',
            'selesai' => 'Barang Dijemput',
            'batal' => 'Dibatalkan'
        ];
        return $labels[$this->status] ?? $this->status;
    }
}