<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@s.com',
            'password' => bcrypt('123'),
        ]);

        $this->call([
            SkemaSeeder::class,
            PesertaSeeder::class,
        ]);
    }
}
