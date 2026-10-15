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
        'ijazah',
    'foto_sertifikat',
    'nama_peserta',
    'alamat',
    'no_hp',
    'email',
    'ijazah',
    'foto_sertifikat',
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