@extends('layouts.app')
@section('title', 'Dashboard - LIBRAIN')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-bold">Dashboard</h2>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-4xl font-bold text-gray-900">{{ $totalAnggota }}</h2>
        <p class="text-gray-600 mt-2">Total Anggota</p>
        <a href="{{ route('anggota.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline">More info</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-4xl font-bold text-gray-900">{{ $bukuDipinjam }}</h2>
        <p class="text-gray-600 mt-2">Buku Dipinjam</p>
        <a href="{{ route('peminjaman.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline">More info</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-4xl font-bold text-gray-900">{{ $bukuDikembalikan }}</h2>
        <p class="text-gray-600 mt-2">Buku Dikembalikan</p>
        <a href="{{ route('pengembalian.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline">More info</a>
    </div>
</div>

<!-- Recent Activity Table -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Aktivitas Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pengguna
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aktivitas
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Waktu
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($aktivitas as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ optional($item->anggota)->nama ?? 'System' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->deskripsi }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada aktivitas terbaru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
