<x-admin-app-layout>

    <div class="flex h-screen">
        <!-- Left Navbar -->
        <x-admin-left-navbar class="h-full" />

        <!-- Main Content -->
        <div class="flex-grow mx-12 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <!-- This is where dynamic content will be displayed -->
                @yield('content') <!-- This will be replaced by the content of other admin pages -->
            </div>
        </div>
    </div>
</x-admin-app-layout>
