<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    
    protected $fillable = [
        'periode', 'total_donasi_uang', 'total_donasi_barang', 'jumlah_donatur'
    ];
}