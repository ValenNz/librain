@extends('layouts.app')
@section('title', 'User Management - LIBRAIN')
@section('content')

<h1 class="text-3xl font-bold mb-6">User Management</h1>

<div class="mb-6 flex justify-end">
    <a href="{{ route('anggota.create') }}"
       class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition duration-200 whitespace-nowrap text-center">
        Add Anggota
    </a>
</div>


<div class="bg-white p-4 rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Telepon</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($anggotas as $anggota)
            <tr>
                <td class="px-4 py-3 whitespace-nowrap text-gray-900">{{ $anggota->nama }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $anggota->email }}</td>
                <td class="px-4 py-3 whitespace-nowrap text-gray-700 hidden sm:table-cell">{{ $anggota->telepon ?? '-' }}</td>
                <td class="px-4 py-3 whitespace-nowrap">
                    @if($anggota->foto)
                        <img src="{{ asset('storage/anggota/'.$anggota->foto) }}" alt="Foto {{ $anggota->nama }}"
                             class="h-10 w-10 object-cover rounded-full border border-gray-200">
                    @else
                        <span class="text-gray-400 italic">Tidak Ada</span>
                    @endif
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                        {{ $anggota->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($anggota->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-right min-w-[130px]">
                    <div class="flex justify-center items-center space-x-2">
                        <a href="{{ route('anggota.edit', $anggota->id) }}"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-600 border border-indigo-600 rounded hover:bg-indigo-50 transition duration-150"
                        aria-label="Edit anggota {{ $anggota->nama }}">
                            Edit
                        </a>

                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 border border-red-600 rounded hover:bg-red-50 transition duration-150 focus:outline-none btn-delete"
                                data-nama="{{ $anggota->nama }}">
                                Delete
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Data anggota tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $anggotas->links('pagination::tailwind') }}
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
