<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BukuSeeder;
use Database\Seeders\DendaSeeder;
use Database\Seeders\AnggotaSeeder;
use Database\Seeders\PeminjamanSeeder;
use Database\Seeders\PengembalianSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AnggotaSeeder::class,
            BukuSeeder::class,
            PeminjamanSeeder::class,
            PengembalianSeeder::class,
            DendaSeeder::class,
        ]);
    }
}
