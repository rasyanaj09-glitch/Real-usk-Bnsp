<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        Peserta::create([
            'skema_id' => 1,
            'nama_peserta' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 12, Jakarta',
            'no_hp' => '081234567890',
            'email' => 'budi.santoso@email.com',
        ]);

        Peserta::create([
            'skema_id' => 1,
            'nama_peserta' => 'Siti Aminah',
            'alamat' => 'Jl. Sudirman No. 45, Bandung',
            'no_hp' => '089876543210',
            'email' => 'siti.aminah@email.com',
        ]);

        Peserta::create([
            'skema_id' => 2,
            'nama_peserta' => 'Rian Hidayat',
            'alamat' => 'Jl. Gatot Subroto No. 88, Surabaya',
            'no_hp' => '085712345678',
            'email' => 'rian.hidayat@email.com',
        ]);
    }
}
