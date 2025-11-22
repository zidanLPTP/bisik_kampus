<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelapor_id')->constrained('pelapor');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('kategori'); 
            $table->string('lokasi')->nullable();
            $table->string('foto_url')->nullable();
            $table->enum('status', ['Pending', 'Ditanggapi', 'Selesai'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
