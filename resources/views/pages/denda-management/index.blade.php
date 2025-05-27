@extends('layouts.app')
@section('title', 'Daftar Denda - LIBRAIN')
@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<h1 class="text-3xl font-bold mb-6">Daftar Denda</h1>

{{-- <a href="{{ route('denda.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6 inline-block">
    Add Denda
</a> --}}

<div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Denda</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Peminjaman</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($dendas as $denda)
<tr>
    <td>{{ $denda->id }}</td>
    <td>{{ data_get($denda, 'pengembalian.peminjaman_id', '-') }}</td>
    <td>{{ data_get($denda, 'pengembalian.peminjaman.anggota.nama', '-') }}</td>
    <td>{{ data_get($denda, 'pengembalian.peminjaman.buku.judul', '-') }}</td>
    <td>Rp{{ number_format($denda->jumlah, 2) }}</td>
    <td>{{ $denda->alasan ?? '-' }}</td>
    <td>
        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
            {{ $denda->status == 'Paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $denda->status }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
        <a href="{{ route('denda.edit', $denda->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
        <form action="{{ route('denda.destroy', $denda->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
        </form>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $dendas->links() }}
    </div>
</div>

<div id="exportDendaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-xl w-96">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold">Export Laporan Denda</h3>
            <button id="closeExportModalBtn" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('denda.export') }}" method="GET">
            <div class="mb-4">
                <label for="format" class="block text-sm font-medium text-gray-700">Pilih Format</label>
                <select name="format" id="format" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Format --</option>
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>
            <button type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-200">
                Export
            </button>
        </form>
    </div>
</div>

<button id="exportDendaBtn"
    class="mt-6 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
    Export Laporan
</button>

<script>
    document.getElementById("exportDendaBtn").addEventListener("click", () => {
        document.getElementById("exportDendaModal").classList.remove("hidden");
        document.getElementById("exportDendaModal").classList.add("flex");
    });

    document.getElementById("closeExportModalBtn").addEventListener("click", () => {
        document.getElementById("exportDendaModal").classList.add("hidden");
        document.getElementById("exportDendaModal").classList.remove("flex");
    });

    document.getElementById("exportDendaModal").addEventListener("click", (e) => {
        if (e.target === document.getElementById("exportDendaModal")) {
            document.getElementById("exportDendaModal").classList.add("hidden");
            document.getElementById("exportDendaModal").classList.remove("flex");
        }
    });
</script>

@endsection
