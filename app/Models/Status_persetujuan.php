<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_persetujuan extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari default
    protected $table = 'status_persetujuans';

    // Primary key kustom
    protected $primaryKey = 'id_persetujuan';

    // Kalau primary key bukan tipe int autoincrement
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Timestamps default (created_at dan updated_at)
    public $timestamps = true;

    // Kolom tanggal yang bukan default
    protected $dates = ['tanggal_status'];

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'id_rencana',
        'id_pengguna',
        'status',
        'catatan',
        'tanggal_status',
    ];

    // Relasi ke rencana anggaran
    public function rencana()
    {
        return $this->belongsTo(RencanaAnggaran::class, 'id_rencana', 'id_rencana');
    }

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

// Relasi ke departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id_departemen');
    }

// Relasi ke proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id');
    }
}