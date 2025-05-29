@extends('layouts.app')
@section('title', 'Peminjaman Buku - LIBRAIN')
@section('content')

<h1 class="text-3xl font-bold mb-6">Peminjaman Buku</h1>

<div class="mb-6 flex justify-between">
    <input type="text" placeholder="Search" class="px-4 py-2 border rounded w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    <a href="{{ route('peminjaman.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-4">
        Tambah Peminjaman
    </a>
</div>

<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anggota</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tempo</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($peminjamans as $peminjaman)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->anggota->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->buku->judul }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->tanggal_pinjam }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->tanggal_tempo }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                    <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" class="inline-block">
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
        {{ $peminjamans->links() }}
    </div>
</div>

@endsection
