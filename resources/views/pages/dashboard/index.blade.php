@extends('layouts.app')
@section('title', 'Dashboard - LIBRAIN')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-bold">Dashboard</h2>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Anggota -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500 transition hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $totalAnggota }}</h2>
                <p class="text-gray-600">Total Anggota</p>
            </div>
        </div>
        <a href="{{ route('anggota.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline text-sm">Lihat detail →</a>
    </div>

    <!-- Buku Dipinjam -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500 transition hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                <i class="fas fa-book-open fa-2x"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $bukuDipinjam }}</h2>
                <p class="text-gray-600">Buku Dipinjam</p>
            </div>
        </div>
        <a href="{{ route('peminjaman.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline text-sm">Lihat detail →</a>
    </div>

    <!-- Buku Dikembalikan -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500 transition hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-book-reader fa-2x"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $bukuDikembalikan }}</h2>
                <p class="text-gray-600">Buku Dikembalikan</p>
            </div>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline text-sm">Lihat detail →</a>
    </div>
</div>

<!-- Recent Activity Table -->
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
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
                        Tanggal Pinjam
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Buku
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($aktivitas as $item)
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ optional($item->anggota)->nama ?? 'Sistem' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <i class="fas fa-book-open text-yellow-500"></i> Meminjam Buku
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ optional($item->buku)->judul ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada aktivitas terbaru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Optional: Info Tambahan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Jumlah Denda Belum Lunas -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500 transition hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                <i class="fas fa-money-bill-wave fa-2x"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $jumlahDenda ?? 0 }}</h2>
                <p class="text-gray-600">Jumlah Denda Belum Lunas</p>
            </div>
        </div>
        <a href="{{ route('denda.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline text-sm">Kelola denda →</a>
    </div>

    <!-- Buku Populer -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500 transition hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-star fa-2x"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $bukuPopuler->judul ?? '-' }}</h2>
                <p class="text-gray-600">Buku Paling Sering Dipinjam</p>
            </div>
        </div>
        <a href="{{ route('buku.index') }}" class="text-blue-600 hover:text-blue-800 mt-3 inline-block hover:underline text-sm">Lihat daftar buku →</a>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"  />
@endpush
