<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    @include('partials._header')
    <x-flash-message />
    <main class="m-5 max-w-screen-xl items-center justify-between">
        {{ $slot }}
    </main>
</body>

</html>
