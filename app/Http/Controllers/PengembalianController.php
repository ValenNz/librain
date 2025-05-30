<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Denda;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{

    public function index(): View
    {
        $pengembalians = Pengembalian::with('peminjaman')->paginate(10);
        return view('pages.pengembalian-management.index', compact('pengembalians'));
    }

    public function create(): View
    {
        $peminjamans = Peminjaman::whereDoesntHave('pengembalian')->get();
        return view('pages.pengembalian-management.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'catatan_kondisi' => 'nullable|string',
        ]);

        // Ambil data peminjaman
        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $pengembalians = Pengembalian::with('peminjaman', 'denda')->paginate(10);
        // Konversi tanggal ke pure date (tanpa waktu)
        $tanggalTempo = Carbon::parse($peminjaman->tanggal_tempo)->startOfDay(); // Hanya tanggal, jam diatur ke 00:00:00
        $tanggalKembali = Carbon::parse($request->tanggal_kembali)->startOfDay(); // Hanya tanggal, jam diatur ke 00:00:00

        // Simpan pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => $tanggalKembali,
            'catatan_kondisi' => $request->catatan_kondisi ?? '-',
        ]);

        // Hitung selisih hari keterlambatan
        $selisihHari = $tanggalKembali->gt($tanggalTempo) ? $tanggalKembali->diffInDays($tanggalTempo, false) : 0;

        if ($selisihHari > 0) {
            $dendaPerHari = 2000;
            $totalDenda = $selisihHari * $dendaPerHari;

            Denda::create([
                'pengembalian_id' => $pengembalian->id,
                'jumlah' => $totalDenda,
                'alasan' => "Terlambat $selisihHari hari",
                'status' => 'Non Paid', // cocok dengan enum
            ]);
        }

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function show(Pengembalian $pengembalian): View
    {
        return view('pages.pengembalian-management.show', compact('pengembalian'));
    }


    public function edit(Pengembalian $pengembalian): View
    {
        return view('pages.pengembalian-management.edit', compact('pengembalian'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $validated = $request->validate([
            'tanggal_kembali' => 'required|date',
            'catatan_kondisi' => 'nullable|string|max:500'
        ]);

        $pengembalian->update($validated);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }


    public function ajaxPeminjamans(Request $request)
{
    $term = $request->get('term', '');

    $query = Peminjaman::query()
        ->with('buku', 'anggota')
        ->where(function($q) use ($term) {
            $q->whereHas('buku', function($q2) use ($term) {
                $q2->where('judul', 'like', '%'.$term.'%');
            })
            ->orWhereHas('anggota', function($q2) use ($term) {
                $q2->where('nama', 'like', '%'.$term.'%');
            });
        })
        // Filter hanya peminjaman yang belum dikembalikan
        ->whereDoesntHave('pengembalian');

    $results = $query->get()->map(function($peminjaman) {
        return [
            'id' => $peminjaman->id,
            'buku' => $peminjaman->buku->judul,
            'anggota' => $peminjaman->anggota->nama,
        ];
    });

    return response()->json($results);
}


}
