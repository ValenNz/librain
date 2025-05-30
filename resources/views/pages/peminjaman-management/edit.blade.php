@extends('layouts.app')
@section('title', 'Edit Peminjaman - LIBRAIN')
@section('content')

@php
    $today = date('Y-m-d');
@endphp

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 max-w-xl mx-auto">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-6 max-w-xl mx-auto">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-semibold text-gray-800 mb-10 text-center">Edit Peminjaman</h2>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label for="anggota_id" class="block mb-2 text-sm font-medium text-gray-700">Nama Anggota</label>
            <select name="anggota_id" id="anggota_id" required
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                <option value="{{ $peminjaman->anggota->id }}" selected>{{ $peminjaman->anggota->nama }}</option>
            </select>
        </div>

        <div>
            <label for="buku_id" class="block mb-2 text-sm font-medium text-gray-700">Judul Buku</label>
            <select name="buku_id" id="buku_id" required
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                <option value="{{ $peminjaman->buku->id }}" selected>{{ $peminjaman->buku->judul }}</option>
            </select>
        </div>
        
        <div>
            <label for="tanggal_pinjam" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required
                value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                min="{{ $today }}"
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 px-3 py-2">
        </div>

        <div class="mt-4">
            <label for="tanggal_tempo" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Tempo</label>
            <input type="date" name="tanggal_tempo" id="tanggal_tempo" required
                value="{{ old('tanggal_tempo', $peminjaman->tanggal_tempo) }}"
                min="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 px-3 py-2">
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="flex-1 bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition duration-200">
                Update
            </button>
            <a href="{{ route('peminjaman.index') }}"
                class="flex-1 text-center bg-gray-500 text-white font-semibold py-3 rounded-md hover:bg-gray-600 transition duration-200">
                Batal
            </a>
        </div>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .select2-container--default .select2-selection--single {
        height: 40px;
        padding: 8px 12px;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        box-shadow: none;
        font-size: 1rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
        right: 10px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#anggota_id').select2({
            placeholder: '-- Pilih Anggota --',
            ajax: {
                url: '{{ route("anggota.search") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { q: params.term };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return { id: item.id, text: item.nama };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 2,
            theme: "default"
        });

        $('#buku_id').select2({
            placeholder: '-- Pilih Buku --',
            ajax: {
                url: '{{ route("buku.search") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { q: params.term };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return { id: item.id, text: item.judul };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 2,
            theme: "default"
        });
    });

    const tanggalPinjam = document.getElementById('tanggal_pinjam');
    const tanggalTempo = document.getElementById('tanggal_tempo');

    tanggalPinjam.addEventListener('change', function () {
        tanggalTempo.min = this.value;
        if (tanggalTempo.value < this.value) {
            tanggalTempo.value = this.value;
        }
    });
</script>

@endsection
