<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - LIBRAIN')</title>

    <script src="https://cdn.tailwindcss.com "></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons @1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex">

    @unless(request()->is('login'))

        @include('components.sidebar')

    @endunless

    <div class="ml-64 flex-1 p-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
