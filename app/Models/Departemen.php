<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'departemens';

    // Primary key yang digunakan
    protected $primaryKey = 'id_departemen';

    // Tidak pakai created_at dan updated_at
    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_departemen',
        'deskripsi',
    ];

    // Format casting kolom tanggal_dibuat
    protected $casts = [
        'tanggal_dibuat' => 'datetime',
    ];
    public function departemen()
{
    return $this->belongsTo(Departemen::class, 'departemen_id', 'id_departemen');
}


    // ============================
    // Custom Query Methods
    // ============================

    // Ambil semua data departemen
    public static function getAllDepartemen()
    {
        return self::orderBy('tanggal_dibuat', 'desc')->get();
    }

    // Ambil departemen berdasarkan ID
    public static function getById($id)
    {
        return self::find($id);
    }

    // Cari berdasarkan nama
    public static function searchByName($keyword)
    {
        return self::where('nama_departemen', 'like', '%' . $keyword . '%')->get();
    }

    // Buat data departemen baru
    public static function createDepartemen($data)
    {
        return self::create($data);
    }

    // Update departemen
    public static function updateDepartemen($id, $data)
    {
        $departemen = self::find($id);
        if ($departemen) {
            $departemen->update($data);
            return $departemen;
        }
        return null;
    }

    // Hapus departemen
    public static function deleteDepartemen($id)
    {
        $departemen = self::find($id);
        if ($departemen) {
            return $departemen->delete();
        }
        return false;
    }
}
