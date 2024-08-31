<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MarjoJeans</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-500 h-screen flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="text-center py-5 text-white flex-none">
        <h1 class="text-4xl font-bold">MarjoJeans</h1>
        <h2 class="text-2xl">Mambusao Apartment Browsing Site</h2>
    </header>

    <!-- Main Content -->
    <main class="flex-grow relative overflow-hidden">
        <img src="{{ asset('images/bg-image.png') }}" alt="" class="w-full h-full object-cover">

        <!-- Container for routes -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white bg-opacity-10 backdrop-blur-md py-6 px-12 rounded-lg shadow-lg text-center flex flex-col space-y-4 text-2xl">
                <h3 class="font-bold uppercase text-black">To Browse MarjoJeans:</h3>
                @if (Route::has('login'))
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 ring-1 ring-transparent transition text-black hover:text-black/70 hover:bg-gray-500 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                            Dashboard
                        </a>
                    @else
                            <a
                            href="{{ route('login') }}"
                            class="rounded-md w-full bg-gray-200 py-2 uppercase font-bold ring-1 ring-transparent transition-all duration-500 text-black hover:text-white hover:bg-gray-500 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                            Log in
                        </a>


                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md ring-1 ring-transparent transition text-black hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </main>
</body>
</html>
