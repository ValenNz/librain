@extends('layouts.app')
@section('title', 'User Management - LIBRAIN')
@section('content')

<h1 class="text-3xl font-bold mb-6">User Management</h1>

<div class="mb-6 flex justify-between">
    <input type="text" placeholder="Search" class="px-4 py-2 border rounded w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    <a href="{{ route('anggota.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-4">
        Add Anggota
    </a>
</div>

<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($anggotas as $anggota)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->telepon ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($anggota->foto)
                        <img src="{{ asset('storage/'.$anggota->foto) }}" alt="Foto" class="h-10 w-10 object-cover rounded-full">
                    @else
                        <span class="text-gray-400">Tidak Ada</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                        {{ $anggota->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($anggota->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                    <a href="{{ route('anggota.edit', $anggota->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" class="inline-block">
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
        {{ $anggotas->links() }}
    </div>
</div>

@endsection
