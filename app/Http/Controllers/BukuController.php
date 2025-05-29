<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BukuController extends Controller
{
    public function index(): View
    {
        $bukus = Buku::paginate(10);
        return view('pages.book-management.index', compact('bukus'));
    }

    public function create(): View
    {
        return view('pages.book-management.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit']);

        if ($request->hasFile('foto_sampul')) {
            $imageName = time().'.'.$request->foto_sampul->extension();
            $request->foto_sampul->move(public_path('storage/buku/'), $imageName);
            $data['foto_sampul'] = $imageName;
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku): View
    {
        return view('pages.book-management.edit', compact('buku'));
    }


    public function update(Request $request, Buku $buku)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|digits:4',
        'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit']);

    if ($request->hasFile('foto_sampul')) {
        // Hapus foto lama jika ada
        if ($buku->foto_sampul && file_exists(public_path('storage/buku/'.$buku->foto_sampul))) {
            unlink(public_path('storage/buku/'.$buku->foto_sampul));
        }

        $imageName = time().'.'.$request->foto_sampul->extension();
        $request->foto_sampul->move(public_path('storage/buku/'), $imageName);
        $data['foto_sampul'] = $imageName;
    }

    $buku->update($data);

    return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
}

    public function destroy(Buku $buku)
    {
        if ($buku->foto_sampul) {
            $path = public_path('storage/'.$buku->foto_sampul);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
