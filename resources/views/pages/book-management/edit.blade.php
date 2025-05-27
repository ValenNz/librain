@extends('layouts.app')
@section('title', 'Edit Buku - LIBRAIN')
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

<h1 class="text-3xl font-bold mb-6">Edit Buku</h1>

<form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data"
    class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
        <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
        <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit"
            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required
            min="1800" max="{{ date('Y') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="foto_sampul" class="block text-sm font-medium text-gray-700">Foto Saat Ini</label>
        @if($buku->foto_sampul)
            <img src="{{ asset('storage/'.$buku->foto_sampul) }}" alt="Sampul"
                class="h-16 w-16 object-cover rounded mb-2">
        @else
            <p class="text-sm text-gray-500">Tidak ada foto</p>
        @endif
        <input type="file" name="foto_sampul" id="foto_sampul"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Update
        </button>
        <a href="{{ route('buku.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
           Batal
        </a>
    </div>
</form>

@endsection
