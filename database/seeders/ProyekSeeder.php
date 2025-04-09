<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyek;
use Illuminate\Support\Str;

class ProyekSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $statusList = ['perencanaan', 'berjalan', 'tertunda', 'selesai', 'dibatalkan'];

        for ($i = 1; $i <= 150; $i++) {
            $namaProyek = 'Proyek ' . $faker->unique()->words(3, true);

            $tanggalMulai = $faker->dateTimeBetween('-6 months', '+2 months');
            $tanggalBerakhir = (clone $tanggalMulai)->modify('+'.rand(15, 90).' days');

            Proyek::create([
                'nama_proyek' => $namaProyek,
                'deskripsi' => $faker->sentence(10),
                'tanggal_mulai' => $tanggalMulai->format('Y-m-d'),
                'tanggal_berakhir' => $tanggalBerakhir->format('Y-m-d'),
                'status' => $faker->randomElement($statusList),
            ]);
        }
    }
}
