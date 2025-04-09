<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriAnggaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 40; $i++) {
            $data[] = [
                'nama_kategori' => 'Kategori Anggaran ' . $i,
                'deskripsi' => 'Deskripsi untuk kategori anggaran ke-' . $i,
                'tanggal_dibuat' => now(),
            ];
        }

        DB::table('kategori_anggarans')->insert($data);
    }
}
