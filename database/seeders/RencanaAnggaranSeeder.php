<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RencanaAnggaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'id_periode' => rand(1, 5),
                'id_kategori' => rand(1, 5),
                'id_proyek' => rand(1, 5),
                'departemen_id' => rand(1, 5),
                'jumlah_anggaran' => rand(1000000, 100000000),
                'keterangan' => 'Anggaran ke-' . $i,
                'tanggal_dibuat' => Carbon::now()->subDays(rand(0, 30)),
            ];
        }

        DB::table('rencana_anggarans')->insert($data);
    }
}
