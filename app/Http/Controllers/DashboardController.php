<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Anggota;
use Illuminate\View\View;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Statistik Utama
        $totalAnggota = Anggota::count();
        $bukuDipinjam = Peminjaman::whereDoesntHave('pengembalian')->count();
        $bukuDikembalikan = Pengembalian::count();
        $jumlahDenda = Denda::where('status', 'Non Paid')->sum('jumlah');

        $bukuPopuler = Peminjaman::withCount('pengembalian')
            ->with('buku:id,judul')
            ->orderByDesc('pengembalian_count')
            ->first();
        $aktivitas = Peminjaman::with(['anggota' => function ($query) {
                $query->select('id', 'nama');
            }])
            ->latest()
            ->take(5)
            ->get(['id', 'anggota_id', 'tanggal_pinjam']); 

        return view('pages.dashboard.index', compact(
            'totalAnggota',
            'bukuDipinjam',
            'bukuDikembalikan',
            'aktivitas'
        ));
    }
}
