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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_pengguna');
            $table->string('email')->unique();
            $table->string('kata_sandi');
            $table->enum('peran', ['administrator', 'manajer', 'staf'])->default('staf');
            $table->unsignedBigInteger('departemen_id')->nullable();
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->timestamps();

            $table->foreign('departemen_id')->references('id_departemen')->on('departemens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
