<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departemen;
use Faker\Factory as Faker;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 40; $i++) {
            Departemen::create([
                'nama_departemen' => 'Departemen ' . $i,
                'deskripsi' => $faker->sentence(8),
                'tanggal_dibuat' => now(), // ← tambahkan ini
            ]);
        }
    }
}
