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
        Schema::create('kategori_anggarans', function (Blueprint $table) {
            $table->id('id_kategori'); // mengganti 'id' menjadi 'id_kategori'
            $table->string('nama_kategori')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamp('tanggal_dibuat')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_anggarans');
    }
};
