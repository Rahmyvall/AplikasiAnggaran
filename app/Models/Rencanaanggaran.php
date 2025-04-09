<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAnggaran extends Model
{
    use HasFactory;

    protected $table = 'rencana_anggarans';
    protected $primaryKey = 'id_rencana';

    protected $fillable = [
        'id_periode',
        'id_kategori',
        'id_proyek',
        'departemen_id',
        'jumlah_anggaran',
        'keterangan',
        'tanggal_dibuat',
    ];

    public $timestamps = true;

    public function periode()
    {
        return $this->belongsTo(Periode_anggaran::class, 'id_periode', 'id_periode');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_anggaran::class, 'id_kategori', 'id_kategori');
    }

    // RencanaAnggaran.php

public function proyek()
{
    return $this->belongsTo(Proyek::class, 'id_proyek', 'id'); // kolom foreign, kolom primary
}


    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id', 'id_departemen');
    }
}

