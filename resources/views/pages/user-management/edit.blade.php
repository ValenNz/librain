@extends('layouts.app')
@section('title', 'Edit Anggota - LIBRAIN')
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
    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-8 text-center">Edit Anggota</h2>

    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $anggota->nama) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email"
            value="{{ old('email', $anggota->email) }}" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
            <input type="tel" name="telepon" id="telepon"
            value="{{ old('telepon', $anggota->telepon ?? '') }}"
            pattern="^[0-9+\-\s]+$" minlength="10" maxlength="15"
            placeholder="+6281234567890"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
            @if($anggota->foto)
                <img src="{{ asset('storage/anggota/'.$anggota->foto) }}" alt="Foto Anggota"
                    class="h-16 w-16 object-cover rounded-full mb-2">
            @else
                <p class="text-sm text-gray-500 mb-2">Tidak ada foto</p>
            @endif
            <input type="file" name="foto" id="foto"
                accept="image/png, image/jpeg, image/jpg, image/gif"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                <option value="">-- Pilih Status --</option>
                <option value="active" {{ old('status', $anggota->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $anggota->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                Update
            </button>
            <a href="{{ route('anggota.index') }}"
                class="w-full text-center bg-gray-500 text-white py-3 rounded-lg hover:bg-gray-600 transition duration-200">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
