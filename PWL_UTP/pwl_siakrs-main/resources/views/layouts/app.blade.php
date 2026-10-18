<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Sistem KRS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;1,300&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
            
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-dvh overflow-hidden">
        @if(request()->is('login'))
             <main class="h-dvh flex">
                 @yield('content')
            </main>
        @else
            <main class="h-dvh grid grid-cols-1 lg:grid-cols-[300px_1fr]">
                @include('layouts.sidebar')
                <section class="overflow-x-hidden">
                    @include('layouts.header')
                    <div class="p-6">
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </section>
            </main>
        @endif

    </body>
</html>
