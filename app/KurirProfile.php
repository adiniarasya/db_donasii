<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KurirProfile extends Model
{
    protected $table = 'kurir_profile';
    
    protected $fillable = ['user_id', 'no_hp', 'alamat'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}