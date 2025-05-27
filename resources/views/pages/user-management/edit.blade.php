@extends('layouts.app')
@section('title', 'Edit Anggota - LIBRAIN')
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

<h1 class="text-3xl font-bold mb-6">Edit Anggota</h1>

<form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Nama -->
    <div class="mb-4">
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $anggota->nama) }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email"
            value="{{ old('email', $anggota->email) }}" required
            readonly
            class="mt-1 block w-full border-gray-300 bg-gray-100 rounded-md shadow-sm">
        <input type="hidden" name="email" value="{{ $anggota->email }}">
    </div>

    <!-- Telepon -->
    <div class="mb-4">
        <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
        <input type="text" name="telepon" id="telepon"
            value="{{ old('telepon', $anggota->telepon ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Status -->
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="active" {{ old('status', $anggota->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $anggota->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <!-- Foto Saat Ini -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Foto Saat Ini</label>
        @if($anggota->foto)
            <img src="{{ asset('storage/'.$anggota->foto) }}" alt="Foto Anggota" class="h-16 w-16 object-cover rounded-full mb-2">
        @else
            <p class="text-sm text-gray-500">Tidak ada foto</p>
        @endif
        <input type="file" name="foto" id="foto"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Tombol Submit -->
    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Update
        </button>
        <a href="{{ route('anggota.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 self-center inline-block no-underline">
            Batal
        </a>
    </div>
</form>

@endsection
