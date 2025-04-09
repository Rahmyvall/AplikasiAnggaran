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
        Schema::create('status_persetujuans', function (Blueprint $table) {
            $table->id('id_persetujuan'); // ID utama
            $table->unsignedBigInteger('id_rencana'); // Foreign key ke rencana_anggaran
            $table->unsignedBigInteger('id_pengguna'); // Foreign key ke pengguna
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_status')->useCurrent();
            $table->timestamps();

            // Relasi
            $table->foreign('id_rencana')->references('id_rencana')->on('rencana_anggarans')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('penggunas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_persetujuans');
    }
};
