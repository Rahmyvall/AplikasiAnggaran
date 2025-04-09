<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'penggunas'; // Nama tabel
    protected $primaryKey = 'id_pengguna'; // Primary key kustom
    public $timestamps = true; // Aktifkan created_at dan updated_at

    protected $fillable = [
        'nama_pengguna',
        'email',
        'kata_sandi',
        'peran',
        'departemen_id',
        'tanggal_daftar',
    ];

    // Relasi ke tabel Departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id', 'id_departemen');
    }
}
