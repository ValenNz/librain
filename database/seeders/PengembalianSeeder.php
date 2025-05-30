<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class PengembalianSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua peminjaman yang belum punya pengembalian (tanpa menggunakan kolom pengembalian_id)
        $peminjamenTanpaPengembalian = Peminjaman::doesntHave('pengembalian')->get();

        if ($peminjamenTanpaPengembalian->isEmpty()) {
            $this->command->info("Tidak ada peminjaman tanpa pengembalian.");
            return;
        }

        foreach ($peminjamenTanpaPengembalian->take(5) as $peminjaman) {
            // Tentukan apakah buku dikembalikan tepat waktu atau terlambat
            $tanggalTempo = Carbon::parse($peminjaman->tanggal_tempo);

            if (rand(0, 1)) {
                $tanggalKembali = $tanggalTempo; // Tepat waktu
            } else {
                $tanggalKembali = $tanggalTempo->copy()->addDays(rand(1, 7)); // Terlambat
            }

            // Simpan pengembalian
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => $tanggalKembali,
                'catatan_kondisi' => $faker->sentence(3),
            ]);
        }

        $this->command->info("Seeder pengembalian berhasil dijalankan.");
    }
}
