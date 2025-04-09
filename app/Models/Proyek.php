<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit (optional kalau default plural sudah benar)
    protected $table = 'proyeks';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'nama_proyek',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status',
        'tanggal_dibuat',
    ];

    // Nonaktifkan timestamps default kalau kamu tidak pakai created_at & updated_at
    public $timestamps = true; // ubah ke false kalau kamu hanya pakai tanggal_dibuat
}
