<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;
use Illuminate\Support\Facades\DB;
use App\Models\Denda;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index(): View
    {
        $dendas = Denda::with('pengembalian.peminjaman')->paginate(10);
        return view('pages.denda-management.index', compact('dendas'));
    }

    public function show(Denda $denda): View
    {
        return view('pages.denda-management.show', compact('denda'));
    }

    public function edit(Denda $denda): View
    {
        return view('pages.denda-management.edit', compact('denda'));
    }

    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'status' => 'required|in:Paid,Non Paid'
        ]);

        $denda->update(['status' => $request->input('status')]);

        return redirect()->route('denda.index')->with('success', 'Status denda berhasil diubah.');
    }

    public function destroy(Denda $denda)
    {
        $denda->delete();

        return redirect()->route('denda.index')->with('success', 'Data denda berhasil dihapus.');
    }


    public function export(Request $request)
{
    $format = $request->query('format');

    if ($format == 'csv') {
        $filename = 'denda_' . now()->format('Y-m-d_His') . '.csv';
        $filePath = storage_path('app/public/' . $filename);

        $data = Denda::with(['pengembalian.peminjaman.anggota', 'pengembalian.peminjaman.buku'])->get();

        $csv = Writer::createFromPath($filePath, 'w+');
        $csv->insertOne([
            'ID Denda',
            'ID Peminjaman',
            'Nama Anggota',
            'Judul Buku',
            'Jumlah',
            'Alasan',
            'Status',
            'Tanggal Kembali'
        ]);

        foreach ($data as $denda) {
            $csv->insertOne([
                $denda->id,
                $denda->pengembalian?->peminjaman_id ?? '-',
                optional(optional($denda->pengembalian?->peminjaman)->anggota)->nama ?? '-',
                optional(optional($denda->pengembalian?->peminjaman)->buku)->judul ?? '-',
                number_format($denda->jumlah, 2),
                $denda->alasan ?? '-',
                $denda->status,
                optional($denda->pengembalian)->tanggal_kembali ?? '-'
            ]);
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

}
}
