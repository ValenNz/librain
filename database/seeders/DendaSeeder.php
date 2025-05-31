<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class DendaSeeder extends Seeder
{
    public function run()
    {
        $denda = [
            [
                'pengembalian_id' => 1,
                'jumlah' => 5000.00,
                'alasan' => 'Keterlambatan pengembalian',
                'status' => 'Non Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pengembalian_id' => 2,
                'jumlah' => 10000.00,
                'alasan' => 'Buku rusak',
                'status' => 'Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('denda')->insert($denda);
    }
}
