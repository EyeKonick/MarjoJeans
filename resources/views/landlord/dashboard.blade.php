<!-- resources/views/landlord/dashboard.blade.php -->
<x-landlord-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('MARJOJEANS') }}
        </h2>
    </x-slot>

    <div class="flex h-screen">
        <!-- Left Navbar -->
        <x-landlord-left-navbar class="h-full" />

        <!-- Main Content -->
        <div class="flex-grow mx-12 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <!-- This is where dynamic content will be displayed -->
                @yield('content') <!-- This will be replaced by the content of add-apartment.blade.php -->
            </div>
        </div>
    </div>
</x-landlord-app-layout>
