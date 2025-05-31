<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class PengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengembalian = [
            [
                'peminjaman_id' => 1,
                'tanggal_kembali' => Date::now(),
                'catatan_kondisi' => 'Buku dalam kondisi baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'peminjaman_id' => 2,
                'tanggal_kembali' => Date::parse('2024-10-15'),
                'catatan_kondisi' => 'Buku sedikit rusak halaman 10-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'peminjaman_id' => 3,
                'tanggal_kembali' => Date::parse('2024-10-20'),
                'catatan_kondisi' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('pengembalian')->insert($pengembalian);
    }
}
