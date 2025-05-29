@extends('layouts.app')
@section('title', 'Tambah Buku - LIBRAIN')
@section('content')

@php
    $currentYear = date('Y');
@endphp

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-xl mx-auto mt-12 bg-white p-8 px-4 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Tambah Buku</h2>

    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-6">
        @csrf

        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" id="judul" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div class="mb-4">
            <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
            <input type="text" name="penulis" id="penulis" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div class="mb-4">
            <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div class="mb-4">
    <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-2">
        Tahun Terbit
    </label>
    <select name="tahun_terbit" id="tahun_terbit" required
        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
        <option value="" disabled selected>Pilih tahun</option>
        @for ($year = $currentYear; $year >= 1800; $year--)
            <option value="{{ $year }}" {{ old('tahun_terbit', $buku->tahun_terbit ?? '') == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endfor
    </select>
    @error('tahun_terbit')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

        <div class="mb-4">
            <label for="foto_sampul" class="block text-sm font-medium text-gray-700 mb-1">Foto Sampul</label>
            <img id="preview-foto" src="#" alt="Preview Foto"
                class="h-16 w-16 max-w-[64px] object-cover rounded-full mb-2 hidden block" />
            <input type="file" name="foto_sampul" id="foto_sampul"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 text-lg">
                Simpan Buku
            </button>
        </div>
    </form>
</div>


<script>
    document.getElementById('foto_sampul').addEventListener('change', function(event){
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('preview-foto');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
</script>

@endsection
