<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <header class="top-0 mx-5 flex h-20 max-w-screen-xl items-center justify-between w-full">
        <nav>
            <h2 class="text-3xl font-bold">Compensation calculator</h2>
        </nav>
    </header>
    <x-flash-message />
    <main class="m-5 max-w-screen-xl items-center justify-between">
        {{ $slot }}
    </main>
</body>

</html>
