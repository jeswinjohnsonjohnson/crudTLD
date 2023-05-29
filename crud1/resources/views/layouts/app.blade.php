<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 
</head>
<body>
    <header>
        <!-- ... -->
    </header>

    <nav>
        <!-- ... -->
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- ... -->
    </footer>

    @yield('scripts')
</body>
</html>
