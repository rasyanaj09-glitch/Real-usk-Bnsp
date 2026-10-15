<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke tabel users & skema
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('skema_id')
                  ->constrained('skema_sertifikasi')
                  ->onDelete('cascade');

            // Data KTP & Identitas Peserta
            $table->string('nik', 16)->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('foto_ktp')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('foto_sertifikat')->nullable();

            $table->string('nama_peserta');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};