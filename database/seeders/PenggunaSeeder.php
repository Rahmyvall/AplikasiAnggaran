<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Pengguna::create([
                'nama_pengguna' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'kata_sandi' => Hash::make('password123'), // semua default password
                'peran' => $faker->randomElement(['administrator', 'manajer', 'staf']),
                'departemen_id' => rand(1, 5), // pastikan ada departemen dengan ID 1–5
                'tanggal_daftar' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
