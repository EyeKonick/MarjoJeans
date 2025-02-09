<x-admin-app-layout>

    <div class="flex h-screen">
        <!-- Left Navbar -->
        <x-admin-left-navbar/>

        <!-- Main Content -->
        <div class="flex-grow mx-12 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-screen">
                @yield('content')
            </div>
        </div>
    </div>
</x-admin-app-layout>
