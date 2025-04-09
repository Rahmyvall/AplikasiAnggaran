<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_anggaran extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit (jika tidak mengikuti konvensi Laravel)
    protected $table = 'kategori_anggarans';

    // Nama primary key (jika bukan 'id')
    protected $primaryKey = 'id_kategori';

    // Tidak menggunakan timestamps default Laravel (created_at & updated_at)
    public $timestamps = false;

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'tanggal_dibuat',
    ];
}
