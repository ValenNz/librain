@extends('layouts.app')
@section('title', 'Pengembalian - LIBRAIN')
@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<h1 class="text-3xl font-bold mb-6">Pengembalian Buku</h1>

<a href="{{ route('pengembalian.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6 inline-block">
    Add Pengembalian
</a>

<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pinjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan Kondisi</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($pengembalians as $pengembalian)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $pengembalian->peminjaman_id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $pengembalian->tanggal_kembali ?? '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ Str::limit($pengembalian->catatan_kondisi, 50, '...') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @if ($pengembalian->denda > 0)
                        Rp{{ number_format($pengembalian->denda, 2) }}
                    @else
                        - (Tidak Ada Denda)
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                    <a href="{{ route('pengembalian.edit', $pengembalian->id) }}"
                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('pengembalian.destroy', $pengembalian->id) }}" method="POST" class="inline">
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
        {{ $pengembalians->links() }}
    </div>
</div>

@endsection
