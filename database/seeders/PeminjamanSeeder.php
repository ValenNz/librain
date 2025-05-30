<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Anggota;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua ID anggota dan buku yang sudah ada
        $anggotas = \App\Models\Anggota::pluck('id');
        $bukus = \App\Models\Buku::pluck('id');

        // Generate 30 peminjaman
        for ($i = 1; $i <= 30; $i++) {
            $tanggalPinjam = $faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d');
            $tanggalTempo = Carbon::parse($tanggalPinjam)->addDays(rand(7, 30))->format('Y-m-d');

            DB::table('peminjaman')->insert([
                'anggota_id' => $faker->randomElement($anggotas),
                'buku_id' => $faker->randomElement($bukus),
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_tempo' => $tanggalTempo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
