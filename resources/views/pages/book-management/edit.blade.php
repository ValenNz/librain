@extends('layouts.app')
@section('title', 'Edit Buku - LIBRAIN')
@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6 mx-auto max-w-screen-md">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-100 text-red-700 p-4 rounded mb-6 mx-auto max-w-screen-md">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="w-full max-w-screen-md mx-auto mt-12 bg-white p-6 sm:p-8 rounded-2xl shadow-lg">
    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-8 text-center">Edit Buku</h2>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
            <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Sampul Saat Ini</label>
            @if($buku->foto_sampul)
                <img src="{{ asset('storage/buku/'.$buku->foto_sampul) }}" alt="Foto Sampul"
                    class="h-24 w-auto object-cover rounded mb-2">
            @else
                <p class="text-sm text-gray-500 mb-2">Tidak ada foto</p>
            @endif
            <input type="file" name="foto_sampul" id="foto_sampul"
                accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                Update
            </button>
            <a href="{{ route('buku.index') }}"
                class="w-full text-center bg-gray-500 text-white py-3 rounded-lg hover:bg-gray-600 transition duration-200">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
