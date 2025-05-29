<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen">

  @auth
    <div class="flex">
      @include('components.sidebar')

      <main id="mainContent" class="flex-1 p-8 sm:ml-64 transition-margin duration-300 ease-in-out">
        @yield('content')
      </main>
    </div>
  @endauth

  @guest
    <div class="w-full p-8">
      @yield('content')
    </div>
  @endguest

  @stack('scripts')
</body>
</html>
