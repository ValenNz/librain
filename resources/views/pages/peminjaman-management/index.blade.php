@extends('layouts.app')
@section('title', 'Peminjaman Buku - LIBRAIN')
@section('content')

<h1 class="text-3xl font-bold mb-6">Peminjaman Buku</h1>

<div class="mb-6 flex justify-end">
    <a href="{{ route('peminjaman.create') }}"
       class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition duration-200 whitespace-nowrap text-center">
        Tambah peminjaman
    </a>
</div>

<div class="bg-white p-4 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anggota</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tempo</th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($peminjamans as $peminjaman)
            <tr>
                <td class="px-4 py-3 whitespace-nowrap text-gray-900">{{ $peminjaman->anggota->nama }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $peminjaman->buku->judul }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $peminjaman->tanggal_pinjam }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $peminjaman->tanggal_tempo }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-right min-w-[130px]">
                    <div class="flex justify-center items-center space-x-2">
                        <a href="{{ route('peminjaman.edit', $peminjaman->id) }}"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-600 border border-indigo-600 rounded hover:bg-indigo-50 transition duration-150"
                        aria-label="Edit peminjaman {{ $peminjaman->anggota->nama }}">
                            Edit
                        </a>

                        {{-- <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 border border-red-600 rounded hover:bg-red-50 transition duration-150 focus:outline-none btn-delete"
                                data-nama="{{ $peminjaman->anggota->nama }}">
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
        {{ $peminjamans->links() }}
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const nama = this.getAttribute('data-nama');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Anggota bernama "${nama}" akan dihapus secara permanen.`,
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
