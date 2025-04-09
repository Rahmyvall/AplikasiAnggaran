<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status_persetujuan;
use App\Models\RencanaAnggaran;
use App\Models\Pengguna;
use Illuminate\Support\Str;

class StatusPersetujuanSeeder extends Seeder
{
    public function run(): void
    {
        $rencanaIds = RencanaAnggaran::pluck('id_rencana')->toArray();
        $penggunaIds = Pengguna::pluck('id_pengguna')->toArray();

        if (empty($rencanaIds) || empty($penggunaIds)) {
            $this->command->warn('Data rencana_anggaran atau pengguna belum ada. Seeder dibatalkan.');
            return;
        }

        for ($i = 0; $i < 40; $i++) {
            Status_persetujuan::create([
                'id_rencana' => fake()->randomElement($rencanaIds),
                'id_pengguna' => fake()->randomElement($penggunaIds),
                'status' => fake()->randomElement(['menunggu', 'disetujui', 'ditolak']),
                'catatan' => fake()->optional()->sentence(),
                'tanggal_status' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);
        }
    }
}
