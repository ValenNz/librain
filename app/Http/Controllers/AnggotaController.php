<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    public function index(): View
    {
        $anggotas = Anggota::paginate(10);
        return view('pages.user-management.index', compact('anggotas'));
    }

    public function create(): View
    {
        return view('pages.user-management.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggota,email',
            'telepon' => ['nullable', 'string', 'regex:/^[0-9+\-\s]+$/', 'min:10', 'max:15'],
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['nama', 'email', 'telepon', 'status']);

        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('storage/anggota'), $imageName);
            $data['foto'] = $imageName;
        }

        Anggota::create($data);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id): View
    {
        $anggota = Anggota::findOrFail($id);
        return view('pages.user-management.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
{
    $rules = [
        'nama' => 'sometimes|required|string|max:255',
        'telepon' => 'sometimes|required|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'sometimes|required|in:active,inactive',
    ];

    if ($request->filled('email')) {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('anggota', 'email')->ignore($anggota->id),
            ];
        }


    $validated = Validator::make($request->all(), $rules)->validate();

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

    if ($request->hasFile('foto')) {
        if ($anggota->foto && file_exists(public_path('storage/'.$anggota->foto))) {
            unlink(public_path('storage/anggota'.$anggota->foto));
        }

        $file = $request->file('foto');
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('storage/anggota'), $imageName);
        $data['foto'] = $imageName;
    }

    $anggota->update($data);

    return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
}

    public function destroy(Anggota $anggota)
    {
        if ($anggota->foto && file_exists(public_path('storage/'.$anggota->foto))) {
            unlink(public_path('storage/'.$anggota->foto));
        }

        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $anggotas = Anggota::where('nama', 'LIKE', '%' . $search . '%')
                          ->select('id', 'nama')
                          ->limit(10)
                          ->get();

        return response()->json($anggotas);
    }

}
