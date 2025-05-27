@extends('layouts.app')
@section('title', 'Book Management - LIBRAIN')

@section('content')

<h1 class="text-3xl font-bold mb-6">Book Management</h1>

<div class="mb-6 flex justify-between">
    <input type="text" placeholder="Search" class="px-4 py-2 border rounded w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    <a href="{{ route('buku.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-4">
        Add Buku
    </a>
</div>

<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Terbit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto Sampul</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($bukus as $buku)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->judul }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->penulis }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->penerbit }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->tahun_terbit }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($buku->foto_sampul)
                        <img src="{{ asset('storage/'.$buku->foto_sampul) }}" alt="Sampul"
                            class="h-10 w-10 object-cover rounded">
                    @else
                        <span class="text-gray-400">Tidak Ada</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                    <a href="{{ route('buku.edit', $buku->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="inline-block">
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
        {{ $bukus->links() }}
    </div>
</div>

@endsection
