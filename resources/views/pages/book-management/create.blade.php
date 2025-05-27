@extends('layouts.app')
@section('title', 'Tambah Buku - LIBRAIN')
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

<h1 class="text-3xl font-bold mb-6">Tambah Buku</h1>

<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data"
    class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf

    <div class="mb-4">
        <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="judul" id="judul" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
        <input type="text" name="penulis" id="penulis" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
        <input type="text" name="penerbit" id="penerbit" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit" required min="1800" max="{{ date('Y') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="foto_sampul" class="block text-sm font-medium text-gray-700">Foto Sampul</label>
        <input type="file" name="foto_sampul" id="foto_sampul"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Simpan
        </button>
        <a href="{{ route('buku.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
           Batal
        </a>
    </div>
</form>

@endsection
