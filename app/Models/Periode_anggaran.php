<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode_anggaran extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi plural otomatis
    protected $table = 'periode_anggarans';

    // Primary key yang bukan 'id'
    protected $primaryKey = 'id_periode';

    // Non-incrementing jika kamu ingin override lebih lanjut
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Timestamps (jika kamu hanya pakai `tanggal_dibuat`)
    public $timestamps = false;

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nama_periode',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status',
        'tanggal_dibuat',
    ];

    /**
     * Scope: Ambil hanya yang status-nya aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope: Ambil periode yang sedang berlangsung hari ini
     */
    public function scopeSedangBerlangsung($query)
    {
        $today = now()->toDateString();
        return $query->where('tanggal_mulai', '<=', $today)
                     ->where('tanggal_berakhir', '>=', $today);
    }
}
// Compare