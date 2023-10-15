<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cars Project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

        <!-- Styles tailwind -->
        @vite('resources/css/app.css')
        @vite('resources/css/app.css')

        <!-- Scripts -->
        <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
    </head>
    <body class="antialiased">
        @include('includes.header')
        <div class="grid lg:grid-cols-4 lg:gap-2">
            <div class="lg:col-span-1">
                @include('admin.sidebar')
            </div>
            <div class="lg:col-span-3">
                @yield('content')
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('script')
</html>
