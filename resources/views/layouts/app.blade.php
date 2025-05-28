<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex">

    @auth
        @include('components.sidebar')
        <div class="ml-64 flex-1 p-8">
            @yield('content')
        </div>
    @endauth

    @guest
        <div class="w-full">
            @yield('content')
        </div>
    @endguest

    @stack('scripts')
</body>
</html>
