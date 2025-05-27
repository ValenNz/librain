@extends('layouts.app')
@section('title', 'Edit Pengembalian - LIBRAIN')
@section('content')

<!-- Alert Sukses -->
@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<!-- Alert Error -->
@if($errors->any())
<div class="bg-red-100 text-red-700 p-4 rounded mb-6">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="text-3xl font-bold mb-6">Edit Pengembalian</h1>

<form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST"
    class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
    @csrf
    @method('PUT')

    <!-- Tampilkan Informasi Peminjaman -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Peminjaman ID</label>
        <input type="hidden" name="peminjaman_id" value="{{ $pengembalian->peminjaman_id }}">

        <div class="mt-1 block w-full border border-gray-300 rounded-md bg-gray-100 p-3">
            <p class="text-sm text-gray-800">
                <strong>ID:</strong> {{ $pengembalian->peminjaman_id }}<br>
                <strong>Buku:</strong> {{ optional(optional($pengembalian->peminjaman)->buku)->judul ?? 'Tidak Ada' }}<br>
                <strong>Anggota:</strong> {{ optional(optional($pengembalian->peminjaman)->anggota)->nama ?? 'Tidak Ada' }}<br>
                <strong>Tanggal Pinjam:</strong> {{ optional($pengembalian->peminjaman)->tanggal_pinjam ?? 'Tidak Ada' }}
            </p>
        </div>
    </div>

    <!-- Tanggal Kembali -->
    <div class="mb-4">
        <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
            value="{{ old('tanggal_kembali', $pengembalian->tanggal_kembali) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Catatan Kondisi -->
    <div class="mb-6">
        <label for="catatan_kondisi" class="block text-sm font-medium text-gray-700">Catatan Kondisi Buku Saat Dikembalikan</label>
        <textarea name="catatan_kondisi" id="catatan_kondisi" rows="3"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('catatan_kondisi', $pengembalian->catatan_kondisi) }}</textarea>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Update
        </button>
        <a href="{{ route('pengembalian.index') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200 text-center inline-block self-center no-underline">
            Batal
        </a>
    </div>
</form>

@endsection
