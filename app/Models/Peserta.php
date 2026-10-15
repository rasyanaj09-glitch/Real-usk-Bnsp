<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Peserta extends Model
{

     protected $table = 'peserta'; 

   protected $fillable = [
    'user_id',
    'skema_id',
    'nik',
    'jenis_kelamin',
    'foto_ktp',
    'nama_peserta',
    'alamat',
    'no_hp',
    'email',
];

     public function skema(): BelongsTo
    {
       
        return $this->belongsTo(SkemaSertifikasi::class, 'skema_id'); 
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}