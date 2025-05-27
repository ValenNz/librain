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
    $validated = $request->validate([
        'peminjaman_id' => 'required|exists:peminjaman,id',
        'tanggal_kembali' => 'required|date',
        'catatan_kondisi' => 'nullable|string|max:255'
    ]);

    $peminjaman = Peminjaman::find($validated['peminjaman_id']);

    if (!$peminjaman) {
        return back()->withErrors(['peminjaman_id' => 'Data peminjaman tidak ditemukan']);
    }

    $telat = Carbon::parse($validated['tanggal_kembali'])->diffInDays(Carbon::parse($peminjaman->tanggal_tempo));

    $pengembalian = Pengembalian::create([
        'peminjaman_id' => $validated['peminjaman_id'],
        'tanggal_kembali' => $validated['tanggal_kembali'],
        'catatan_kondisi' => $validated['catatan_kondisi'] ?? null,
    ]);

    if ($telat > 0) {
        Denda::create([
            'pengembalian_id' => $pengembalian->id,
            'jumlah' => $telat * 2000,
            'alasan' => "Terlambat $telat hari",
            'status' => 'Non Paid'
        ]);
    }

    return redirect()->route('pengembalian.index')->with('success', 'Buku berhasil dikembalikan.');
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


}
