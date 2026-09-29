<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class SkemaSertifikasi extends Model
{
    
    protected $table = 'skema_sertifikasi'; 

    protected $fillable = ['kode_skema', 'nama_skema', 'jenis', 'jumlah_unit'];

    public function peserta(): HasMany
    {
        return $this->hasMany(Peserta::class, 'skema_id');
    }
}
