<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate 20 buku
        for ($i = 1; $i <= 20; $i++) {
            DB::table('buku')->insert([
                'judul' => $faker->sentence(3),
                'penulis' => $faker->name,
                'penerbit' => $faker->company,
                'tahun_terbit' => $faker->year($max = 'now'),
                'foto_sampul' => null, // atau bisa menggunakan URL foto sampul dummy
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
