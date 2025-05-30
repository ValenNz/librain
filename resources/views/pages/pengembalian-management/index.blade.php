@extends('layouts.app')
@section('title', 'Pengembalian Buku - LIBRAIN')
@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<h1 class="text-3xl font-bold mb-6">Pengembalian Buku</h1>

<div class="mb-6 flex justify-end">
    <a href="{{ route('pengembalian.create') }}"
       class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition duration-200 whitespace-nowrap text-center">
        Tambah Pengembalian
    </a>
</div>

<div class="bg-white p-4 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pinjam</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Peminjaman</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tempo</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan Kondisi</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                <th class="px-4 py-3 tex    t-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($pengembalians as $pengembalian)
            <tr>
                <td class="px-4 py-3 whitespace-nowrap text-gray-900">{{ $pengembalian->peminjaman_id }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $pengembalian->peminjaman->tanggal_pinjam ?? '-' }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $pengembalian->peminjaman->tanggal_tempo ?? '-' }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $pengembalian->tanggal_kembali ?? '-' }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                    {{ Str::limit($pengembalian->catatan_kondisi, 50, '...') }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">
    @if ($pengembalian->denda)
        Rp{{ number_format($pengembalian->denda->jumlah, 2) }}
    @else
        - (Tidak Ada Denda)
    @endif
</td>
                <td class="px-4 py-3 whitespace-nowrap text-right min-w-[130px]">
                    <div class="flex justify-center items-center space-x-2">
                        <a href="{{ route('pengembalian.edit', $pengembalian->id) }}"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-600 border border-indigo-600 rounded hover:bg-indigo-50 transition duration-150"
                        aria-label="Edit pengembalian ID {{ $pengembalian->peminjaman_id }}">
                            Edit
                        </a>

                        {{-- <form action="{{ route('pengembalian.destroy', $pengembalian->id) }}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 border border-red-600 rounded hover:bg-red-50 transition duration-150 focus:outline-none btn-delete"
                                data-id="{{ $pengembalian->peminjaman_id }}">
                                Delete
                            </button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $pengembalians->links() }}
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Pengembalian dengan ID pinjam "${id}" akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
