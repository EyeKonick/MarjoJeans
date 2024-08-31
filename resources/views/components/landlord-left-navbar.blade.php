<!-- resources/views/components/landlord-left-navbar.blade.php -->
<aside class="w-64 h-full shadow-md bg-gray-500">
    <nav class="grid grid-cols-1 gap-4 py-6 px-4 bg-gray-500 text-xl">
        <a href="{{ route('landlord.add_apartment') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            Add Apartment
        </a>
        <a href="{{ route('landlord.list_uploads') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            List of Uploads
        </a>
        <a href="{{ route('landlord.list_pending') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            List of Pending
        </a>
        <a href="{{ route('landlord.update_apartment') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            Update Apartment
        </a>
    </nav>
</aside>
