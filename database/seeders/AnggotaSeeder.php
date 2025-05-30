<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate 10 anggota
        for ($i = 1; $i <= 10; $i++) {
            DB::table('anggota')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->email,
                'telepon' => $faker->phoneNumber,
                'foto' => null, // atau bisa menggunakan URL foto dummy
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
