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
    $request->validate([
        'peminjaman_id' => 'required|exists:peminjaman,id',
        'tanggal_kembali' => 'required|date',
        'catatan_kondisi' => 'nullable|string',
    ]);

    $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

    $tanggalTempo = Carbon::parse($peminjaman->tanggal_tempo)->startOfDay();
    $tanggalKembali = Carbon::parse($request->tanggal_kembali)->startOfDay();

    $pengembalian = Pengembalian::create([
        'peminjaman_id' => $peminjaman->id,
        'tanggal_kembali' => $tanggalKembali,
        'catatan_kondisi' => $request->catatan_kondisi ?? '-',
    ]);

    $selisihHari = $tanggalKembali->diffInDays($tanggalTempo);

    if ($selisihHari > 0) {
        $dendaPerHari = 2000;
        $totalDenda = $selisihHari * $dendaPerHari;

        Denda::create([
            'pengembalian_id' => $pengembalian->id,
            'jumlah' => $totalDenda,
            'alasan' => "Terlambat {$selisihHari} hari",
            'status' => 'Non Paid',
        ]);
    }

    $peminjaman->update(['pengembalian_id' => $pengembalian->id]);

    return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disimpan.');
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
    // Validasi input
    $validated = $request->validate([
        'tanggal_kembali' => 'required|date',
        'catatan_kondisi' => 'nullable|string|max:500',
    ]);

    // Ambil data peminjaman terkait
    $peminjaman = $pengembalian->peminjaman;

    // Parse tanggal
    $tanggalKembali = Carbon::parse($validated['tanggal_kembali'])->startOfDay();
    $tanggalTempo = Carbon::parse($peminjaman->tanggal_tempo)->startOfDay();

    // Hitung keterlambatan
    $selisihHari = $tanggalKembali->diffInDays($tanggalTempo);

    // Update pengembalian
    $pengembalian->update([
        'tanggal_kembali' => $tanggalKembali,
        'catatan_kondisi' => $validated['catatan_kondisi'],
    ]);

    // Handle denda
    if ($selisihHari > 0) {
        $dendaPerHari = 2000;
        $totalDenda = $selisihHari * $dendaPerHari;

        // Jika sudah ada denda, update
        if ($pengembalian->denda) {
            $pengembalian->denda->update([
                'jumlah' => $totalDenda,
                'alasan' => "Terlambat {$selisihHari} hari",
            ]);
        } else {
            // Jika belum ada denda, buat baru
            $pengembalian->denda()->create([
                'jumlah' => $totalDenda,
                'alasan' => "Terlambat {$selisihHari} hari",
                'status' => 'Non Paid',
            ]);
        }
    } else {
        // Jika tidak telat, hapus denda jika ada
        if ($pengembalian->denda) {
            $pengembalian->denda->delete();
        }
    }

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
