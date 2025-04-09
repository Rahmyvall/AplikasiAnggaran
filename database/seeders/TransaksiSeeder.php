<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 40; $i++) {
            Transaksi::create([
                'id_periode' => rand(1, 5), // pastikan ID ini ada di tabel periode
                'id_kategori' => rand(1, 5), // sesuaikan dengan data real
                'id_proyek' => rand(1, 5), // atau null jika tidak wajib
                'departemen_id' => rand(1, 5), // atau null
                'jenis_transaksi' => $faker->randomElement(['pemasukan', 'pengeluaran']),
                'tanggal_transaksi' => $faker->date(),
                'jumlah_transaksi' => $faker->randomFloat(2, 10000, 10000000),
                'deskripsi' => $faker->sentence(),
                'bukti_pendukung' => null, // bisa diisi file fake kalau pakai testing upload
                'tanggal_dibuat' => $faker->dateTime(),
            ]);
        }
    }
}
