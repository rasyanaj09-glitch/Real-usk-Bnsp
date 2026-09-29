<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SkemaSertifikasi;

class SkemaSeeder extends Seeder
{
    public function run(): void
    {
        SkemaSertifikasi::create([
            'kode_skema' => 'SKM-JWD-001',
            'nama_skema' => 'Junior Web Developer',
            'jenis' => 'Okupasi',
            'jumlah_unit' => 6
        ]);

        SkemaSertifikasi::create([
            'kode_skema' => 'SKM-JNA-002',
            'nama_skema' => 'Junior Network Administrator',
            'jenis' => 'Okupasi',
            'jumlah_unit' => 8
        ]);

        SkemaSertifikasi::create([
            'kode_skema' => 'SKM-JWD-003',
            'nama_skema' => 'Web Programmer',
            'jenis' => 'Klaster',
            'jumlah_unit' => 5
        ]);
    }
}
