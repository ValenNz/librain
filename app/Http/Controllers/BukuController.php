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
            $request->foto_sampul->move(public_path('storage'), $imageName);
            $data['foto_sampul'] = $imageName;
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku): View
    {
        return view('pages.book-management.edit', compact('buku'));
    }

    
    public function update(Request $request, Anggota $anggota)
{
    // Validasi input dinamis
    $rules = [
        'nama' => 'required|string|max:255',
        'telepon' => 'nullable|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'in:active,inactive',
    ];

    // Jika email diubah, lakukan validasi unik (kecuali untuk data saat ini)
    if ($request->filled('email')) {
        $rules['email'] = [
            'required',
            'email',
            Rule::unique('anggota', 'email')->ignore($anggota->id),
        ];
    }

    // Jalankan validasi dengan rules dinamis
    $validated = Validator::make($request->all(), $rules)->validate();

    // Filter field mana saja yang mau diupdate
    $data = [];

    if ($request->filled('nama')) {
        $data['nama'] = $request->input('nama');
    }

    if ($request->filled('email')) {
        $data['email'] = $request->input('email');
    }

    if ($request->filled('telepon')) {
        $data['telepon'] = $request->input('telepon');
    }

    if ($request->filled('status')) {
        $data['status'] = $request->input('status');
    }

    // Upload foto jika ada
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika tersedia
        if ($anggota->foto && file_exists(public_path('storage/'.$anggota->foto))) {
            unlink(public_path('storage/'.$anggota->foto));
        }

        // Simpan foto baru
        $file = $request->file('foto');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage'), $imageName);
        $data['foto'] = $imageName;
    }

    // Update data hanya yang berubah
    $anggota->update($data);

    return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
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
