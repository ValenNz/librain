@extends('layouts.app')
@section('title', 'Tambah Pengembalian - LIBRAIN')

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
    <h2 class="text-3xl font-semibold text-gray-800 mb-10 text-center">Tambah Pengembalian</h2>

    <form action="{{ route('pengembalian.store') }}" method="POST" class="space-y-8">
        @csrf

        <div>
            <label for="peminjaman_id" class="block mb-2 text-sm font-medium text-gray-700">Pilih Peminjaman</label>
            <select name="peminjaman_id" id="peminjaman_id" required
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
            </select>
        </div>

        <div>
            <label for="tanggal_kembali" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Kembali</label>
            <input
                type="date"
                name="tanggal_kembali"
                id="tanggal_kembali"
                required
                value="{{ old('tanggal_kembali', $today) }}"
                min="{{ $today }}"
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 px-3 py-2"
            />
        </div>

        <div>
            <label for="catatan_kondisi" class="block mb-2 text-sm font-medium text-gray-700">Catatan Kondisi</label>
            <textarea
                name="catatan_kondisi"
                id="catatan_kondisi"
                rows="3"
                placeholder="Catatan kondisi barang saat dikembalikan"
                class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 px-3 py-2"
            >{{ old('catatan_kondisi') }}</textarea>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('pengembalian.index') }}"
                class="flex-1 text-center bg-gray-500 text-white font-semibold py-3 rounded-md hover:bg-gray-600 transition duration-200">
                Batal
            </a>
            <button type="submit"
                class="flex-1 bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#peminjaman_id').select2({
        placeholder: 'Cari judul buku atau nama anggota...',
        allowClear: true,
        ajax: {
            url: '{{ route("ajax.peminjamans") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { term: params.term };
            },
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.buku + ' - ' + item.anggota
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 2,
        theme: "default"
    });
});
</script>
@endpush
