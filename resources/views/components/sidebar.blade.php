<!-- resources/views/components/sidebar.blade.php -->
<div class="w-64 bg-white p-6 shadow-md h-screen fixed left-0 top-0 overflow-y-auto">
    <h2 class="text-2xl font-bold text-blue-600 mb-8">LIBRAIN</h2>
    <nav>
        <ul>
            <li class="mb-2">
                <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
                    <i class="bi bi-house mr-3"></i> Dashboard
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('anggota.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
                    <i class="bi bi-person mr-3"></i> User Management
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('buku.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
                    <i class="bi bi-book mr-3"></i> Book Management
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('peminjaman.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
                    <i class="bi bi-journal mr-3"></i> Book Borrowing
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('pengembalian.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
                    <i class="bi bi-box-arrow-in-left mr-3"></i> Book Return
                </a>
            </li>
            <li class="mb-2">
                    <a href="{{ route('denda.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
                    <i class="bi bi-clock mr-3"></i> Late Charge
                </a>
            </li>
        </ul>
    </nav>

    <form action="/logout" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200">
            Logout
        </button>
    </form>
</div>
