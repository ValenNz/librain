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
        $peminjamans = Peminjaman::with(['anggota', 'buku'])->paginate(10);
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

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
