<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Menyesuaikan nama tabel jika tidak sesuai dengan Laravel default
    protected $table = 'transaksis';

    // Menentukan primary key jika tidak default 'id'
    protected $primaryKey = 'id_transaksi';

    // Jika tidak memakai timestamp created_at & updated_at
    public $timestamps = true;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'id_periode',
        'id_kategori',
        'id_proyek',
        'departemen_id',
        'jenis_transaksi',
        'tanggal_transaksi',
        'jumlah_transaksi',
        'deskripsi',
        'bukti_pendukung',
        'tanggal_dibuat',
    ];

    /**
     * Relasi ke model PeriodeAnggaran
     */
    // Transaksi.php
public function periode() {
    return $this->belongsTo(Periode_anggaran::class, 'id_periode');
}

public function kategori() {
    return $this->belongsTo(Kategori_anggaran::class, 'id_kategori');
}

public function proyek() {
    return $this->belongsTo(Proyek::class, 'id_proyek');
}

public function departemen() {
    return $this->belongsTo(Departemen::class, 'departemen_id');
}

}
