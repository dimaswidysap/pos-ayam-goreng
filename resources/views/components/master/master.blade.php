<!doctype html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
</head>

<body>
    <main class="w-full max-w-7xl m-auto font-montserrat relative ">
        @yield('konten')
    </main>
</body>

</html>
