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
        if (!Schema::hasTable('rencana_anggarans')) {
            Schema::create('rencana_anggarans', function (Blueprint $table) {
                $table->id('id_rencana');
                $table->unsignedBigInteger('id_periode');
                $table->unsignedBigInteger('id_kategori');
                $table->unsignedBigInteger('id_proyek')->nullable();
                $table->unsignedBigInteger('departemen_id')->nullable();
                $table->decimal('jumlah_anggaran', 15, 2)->default(0);
                $table->text('keterangan')->nullable();
                $table->timestamp('tanggal_dibuat')->useCurrent();
                $table->timestamps();
            });
        }
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_anggarans');
    }
};
