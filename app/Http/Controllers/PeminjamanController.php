<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
   public function index(): View
{
    $peminjamans = Peminjaman::with(['anggota', 'buku'])
        ->whereDoesntHave('pengembalian')
        ->paginate(10);

    return view('pages.peminjaman-management.index', compact('peminjamans'));
}

    public function create(): View
    {
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        return view('pages.peminjaman-management.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'anggota_id' => 'required|exists:anggota,id',
        'buku_id' => 'required|exists:buku,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_tempo' => 'required|date|after_or_equal:tanggal_pinjam'
    ]);

    $startNew = $validated['tanggal_pinjam'];
    $endNew = $validated['tanggal_tempo'];
    $bukuId = $validated['buku_id'];

    $overlap = Peminjaman::where('buku_id', $bukuId)
        ->whereDoesntHave('pengembalian')
        ->where(function($query) use ($startNew, $endNew) {
            $query->whereBetween('tanggal_pinjam', [$startNew, $endNew])
                ->orWhereBetween('tanggal_tempo', [$startNew, $endNew])
                ->orWhere(function($q) use ($startNew, $endNew) {
                    $q->where('tanggal_pinjam', '<=', $startNew)
                        ->where('tanggal_tempo', '>=', $endNew);
                });
        })
        ->exists();

    if ($overlap) {
        return back()->withErrors(['buku_id' => 'Buku sudah dipinjam dalam rentang tanggal yang dipilih.'])->withInput();
    }

    Peminjaman::create($validated);

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
}



    public function edit(Peminjaman $peminjaman): View
    {
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        return view('pages.peminjaman-management.edit', compact('peminjaman', 'anggotas', 'bukus'));
    }

   public function update(Request $request, Peminjaman $peminjaman)
{
    $validated = $request->validate([
        'anggota_id' => 'required|exists:anggota,id',
        'buku_id' => 'required|exists:buku,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_tempo' => 'required|date|after_or_equal:tanggal_pinjam'
    ]);

    $startNew = $validated['tanggal_pinjam'];
    $endNew = $validated['tanggal_tempo'];
    $bukuId = $validated['buku_id'];

    $needsValidation = (
        $peminjaman->buku_id != $bukuId ||
        $peminjaman->tanggal_pinjam != $startNew ||
        $peminjaman->tanggal_tempo != $endNew
    );

    if ($needsValidation) {
        $overlap = Peminjaman::where('buku_id', $bukuId)
            ->where('id', '!=', $peminjaman->id)
            ->whereDoesntHave('pengembalian')
            ->where(function($query) use ($startNew, $endNew) {
                $query->whereBetween('tanggal_pinjam', [$startNew, $endNew])
                      ->orWhereBetween('tanggal_tempo', [$startNew, $endNew])
                      ->orWhere(function($q) use ($startNew, $endNew) {
                          $q->where('tanggal_pinjam', '<=', $startNew)
                            ->where('tanggal_tempo', '>=', $endNew);
                      });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['buku_id' => 'Buku sudah dipinjam dalam rentang tanggal yang dipilih.'])->withInput();
        }
    }

    $peminjaman->update($validated);

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
}



    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }


}
