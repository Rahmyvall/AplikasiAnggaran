<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periode_anggaran;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PeriodeAnggaranSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['aktif', 'tidak_aktif', 'selesai'];

        for ($i = 1; $i <= 100; $i++) {
            $bulan = Carbon::create(2024, rand(1, 12), 1)->format('F');
            $tahun = rand(2023, 2026);
            $nama = "Bulanan - $bulan $tahun";

            // Cek jika nama sudah ada (karena unique)
            if (Periode_anggaran::where('nama_periode', $nama)->exists()) {
                $nama .= ' #' . Str::random(5); // Tambahkan string unik
            }

            $tanggalMulai = Carbon::create($tahun, rand(1, 12), rand(1, 15));
            $tanggalBerakhir = (clone $tanggalMulai)->addDays(rand(10, 60));

            Periode_anggaran::create([
                'nama_periode' => $nama,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_berakhir' => $tanggalBerakhir,
                'status' => $statuses[array_rand($statuses)],
                'tanggal_dibuat' => now(),
            ]);
        }
    }
}
