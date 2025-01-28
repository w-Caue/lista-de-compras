<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Compras</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">

    <tallstackui:script />

    <style>
        body {
            font-family: "Nunito", sans-serif;
            background-image: url({{ asset('img/comercio.png') }});
            /* Nunito */
        }
    </style>

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div>
        <section class="content-block">
            <div class="flex items-center min-h-screen p-6 ">
                <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-gray-50 rounded-xl shadow-xl">
                    <div class="flex flex-col overflow-y-auto md:flex-row">
                        <div class="flex justify-center mt-2 sm:mt-0">
                            <img class="rounded-full h-56 sm:h-auto sm:rounded-xl"
                                src="{{ asset('img/logo lista.png') }}" alt="logo">
                        </div>
                        <div class="flex items-center justify-center p-3 sm:p-12 md:w-1/2">
                            <div class="w-full">
                                <div
                                    class="text-4xl font-black text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-500 hidden sm:block">
                                    My List
                                </div>

                                <h1
                                    class="sm:mb-4 text-lg text-center tracking-widest uppercase font-bold text-gray-400">
                                    Conecte-se
                                </h1>
                                <div>
                                    @livewire('auth.login')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
</body>

</html>
