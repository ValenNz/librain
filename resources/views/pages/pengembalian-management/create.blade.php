<!-- resources/views/pages/pengembalian-management/create.blade.php -->

@extends('layouts.app')
@section('title', 'Tambah Pengembalian - LIBRAIN')
@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-100 text-red-700 p-4 rounded mb-6">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="text-3xl font-bold mb-6">Tambah Pengembalian</h1>

<form action="{{ route('pengembalian.store') }}" method="POST"
    class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf

    <!-- Dropdown Peminjaman -->
    <div class="mb-4">
        <label for="peminjaman_id" class="block text-sm font-medium text-gray-700">Peminjaman</label>
        <select name="peminjaman_id" id="peminjaman_id" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Pilih Peminjaman --</option>
            @foreach ($peminjamans as $p)
                <option value="{{ $p->id }}">
                    {{ $p->buku->judul ?? '-' }} - {{ optional($p->anggota)->nama ?? 'Tidak Ada' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" id="tanggal_kembali" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-6">
        <label for="catatan_kondisi" class="block text-sm font-medium text-gray-700">Catatan Kondisi</label>
        <textarea name="catatan_kondisi" id="catatan_kondisi" rows="3"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>

    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Simpan
        </button>
        <a href="{{ route('pengembalian.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200 self-center no-underline">
            Batal
        </a>
    </div>
</form>

@endsection
