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
        if (!Schema::hasTable('transaksis')) {
            Schema::create('transaksis', function (Blueprint $table) {
                $table->id('id_transaksi');
                $table->unsignedBigInteger('id_periode');
                $table->unsignedBigInteger('id_kategori');
                $table->unsignedBigInteger('id_proyek')->nullable();
                $table->unsignedBigInteger('departemen_id')->nullable();
                $table->enum('jenis_transaksi', ['pemasukan', 'pengeluaran']);
                $table->date('tanggal_transaksi');
                $table->decimal('jumlah_transaksi', 15, 2);
                $table->text('deskripsi')->nullable();
                $table->string('bukti_pendukung')->nullable();
                $table->timestamp('tanggal_dibuat')->useCurrent();
                $table->timestamps();
        
                // Foreign keys (optional)
                // $table->foreign('id_periode')->references('id')->on('periodes');
                // $table->foreign('id_kategori')->references('id')->on('kategoris');
                // ... dan seterusnya
            });
        }
           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
