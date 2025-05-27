@extends('layouts.app')
@section('title', 'Tambah Anggota - LIBRAIN')

@section('content')

<!-- Alert Sukses/Error -->
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

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow-md">
    <h2 class="text-2xl font-bold mb-6">Tambah Anggota</h2>

    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto" id="foto"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Status --</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                    class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection
