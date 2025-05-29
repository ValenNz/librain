@extends('layouts.app')
@section('title', 'Tambah Anggota - LIBRAIN')

@section('content')

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
    <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Tambah Anggota</h2>

    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required placeholder="username"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="email@example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" pattern="^[0-9+\-\s]+$" maxlength="15" minlength="10" placeholder="+6281234567890" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
            <img id="preview-foto" src="#" alt="Preview Foto"
                class="h-16 w-16 max-w-[64px] object-cover rounded-full mb-2 hidden block" />
            <input type="file" name="foto" id="foto" accept="image/png, image/jpeg"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
        </div>



        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                <option value="">-- Pilih Status --</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 text-lg">
                Simpan Anggota
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function(event){
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('preview-foto');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
</script>


@endsection



