<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Peminjaman;
use Faker\Factory as Faker;
use App\Models\Pengembalian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DendaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua pengembalian yang melewati tanggal tempo
        $terlambat = \App\Models\Pengembalian::whereDate('tanggal_kembali', '>', \App\Models\Peminjaman::select('tanggal_tempo')->where('id', \DB::raw('pengembalian.peminjaman_id'))->get());

        foreach ($terlambat as $pengembalian) {
            $selisihHari = Carbon::parse($pengembalian->tanggal_kembali)->diffInDays(Carbon::parse(\App\Models\Peminjaman::find($pengembalian->peminjaman_id)->tanggal_tempo));

            DB::table('denda')->insert([
                'pengembalian_id' => $pengembalian->id,
                'jumlah' => $selisihHari * 2000, // Rp2000 per hari keterlambatan
                'alasan' => "Terlambat {$selisihHari} hari",
                'status' => 'Non Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
