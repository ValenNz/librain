{{-- Sidebar responsive with toggle --}}

<div>
  {{-- Hamburger button, visible on mobile --}}
  <button
    id="sidebarToggle"
    class="sm:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-white shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
    aria-label="Toggle sidebar"
  >
    <!-- Hamburger icon -->
    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
      <line x1="3" y1="12" x2="21" y2="12" />
      <line x1="3" y1="6" x2="21" y2="6" />
      <line x1="3" y1="18" x2="21" y2="18" />
    </svg>
  </button>

  {{-- Sidebar --}}
  <aside
    id="sidebar"
    class="fixed top-0 left-0 h-full w-64 bg-white p-6 shadow-md overflow-y-auto
           transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease-in-out z-40"
  >
    <h2 class="text-2xl font-bold text-blue-600 mb-8">LIBRAIN</h2>
    <nav>
      <ul>
        <li class="mb-2">
          <a href="{{ route('dashboard') }}"
             class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
            <i class="bi bi-house mr-3"></i> Dashboard
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('anggota.index') }}"
             class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
            <i class="bi bi-person mr-3"></i> User Management
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('buku.index') }}"
             class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
            <i class="bi bi-book mr-3"></i> Book Management
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('peminjaman.index') }}"
             class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
            <i class="bi bi-journal mr-3"></i> Book Borrowing
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('pengembalian.index') }}"
             class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
            <i class="bi bi-box-arrow-in-left mr-3"></i> Book Return
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('denda.index') }}"
             class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-3 rounded-lg">
            <i class="bi bi-clock mr-3"></i> Late Charge
          </a>
        </li>
      </ul>
    </nav>

    <form action="/logout" method="POST" class="mt-6">
      @csrf
      <button type="submit"
              class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200">
        Logout
      </button>
    </form>
  </aside>
</div>

{{-- Script untuk toggle sidebar --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', function() {
      if (sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.remove('-translate-x-full');
      } else {
        sidebar.classList.add('-translate-x-full');
      }
    });
  });
</script>
