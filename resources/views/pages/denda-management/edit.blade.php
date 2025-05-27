@extends('layouts.app')
@section('title', 'Edit Status Denda - LIBRAIN')
@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<h1 class="text-3xl font-bold mb-6">Edit Status Denda</h1>

<form action="{{ route('denda.update', $denda->id) }}" method="POST"
    class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Peminjaman ID</label>
        <input type="text" disabled value="{{ $denda->pengembalian?->peminjaman_id ?? '-' }}"
            class="mt-1 block w-full border-gray-300 bg-gray-100 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Ubah Status</label>
        <select name="status" id="status" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="Paid" {{ $denda->status == 'Paid' ? 'selected' : '' }}>Paid</option>
            <option value="Non Paid" {{ $denda->status == 'Non Paid' ? 'selected' : '' }}>Non Paid</option>
        </select>
    </div>

    <div class="flex space-x-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition duration-200">
            Update
        </button>
        <a href="{{ route('denda.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200 self-center no-underline">
            Batal
        </a>
    </div>
</form>

@endsection
