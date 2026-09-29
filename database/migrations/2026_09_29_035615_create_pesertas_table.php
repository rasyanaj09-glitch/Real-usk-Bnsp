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
            
            $table->foreignId('skema_id')
                  ->constrained('skema_sertifikasi')
                  ->onDelete('cascade'); 
            
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
