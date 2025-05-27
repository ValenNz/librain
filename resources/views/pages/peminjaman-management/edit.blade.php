@extends('layouts.app')
@section('title', 'Edit Peminjaman - LIBRAIN')
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

<h1 class="text-3xl font-bold mb-6">Edit Peminjaman</h1>

<form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST"
    class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="anggota_id" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
        <select name="anggota_id" id="anggota_id" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @foreach ($anggotas as $anggota)
            <option value="{{ $anggota->id }}" {{ $peminjaman->anggota_id == $anggota->id ? 'selected' : '' }}>
                {{ $anggota->nama }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="buku_id" class="block text-sm font-medium text-gray-700">Judul Buku</label>
        <select name="buku_id" id="buku_id" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @foreach ($bukus as $buku)
            <option value="{{ $buku->id }}" {{ $peminjaman->buku_id == $buku->id ? 'selected' : '' }}>
                {{ $buku->judul }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-6">
        <label for="tanggal_tempo" class="block text-sm font-medium text-gray-700">Tanggal Tempo</label>
        <input type="date" name="tanggal_tempo" id="tanggal_tempo" value="{{ old('tanggal_tempo', $peminjaman->tanggal_tempo) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Update
        </button>
        <a href="{{ route('peminjaman.index') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
            Batal
        </a>
    </div>
</form>

@endsection
