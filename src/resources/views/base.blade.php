<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    
    <!-- Enlazar estilos -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    
    @include('partials.header')  {{-- Incluir el menú de navegación --}}

    <main>
        @yield('content')  {{-- Aquí se insertará el contenido de cada página --}}
    </main>

    @include('partials.footer')  {{-- Incluir el pie de página --}}

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>