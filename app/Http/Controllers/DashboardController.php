<?php
namespace App\Http\Controllers;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalAnggota = Anggota::count();
        $bukuDipinjam = Peminjaman::whereDoesntHave('pengembalian')->count();
        $bukuDikembalikan = Pengembalian::count();

        $aktivitas = Peminjaman::with('anggota')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard.index', compact(
            'totalAnggota',
            'bukuDipinjam',
            'bukuDikembalikan',
            'aktivitas'
        ));
    }
}
