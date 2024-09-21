<aside class="w-full md:w-64 h-full shadow-md bg-gray-500 fixed md:relative top-0 left-0 md:top-0 md:left-0 md:bottom-0 md:overflow-auto">
    <nav class="grid grid-cols-1 gap-4 py-6 px-4 bg-gray-500 text-xl">
        <a href="{{ route('landlord.add_apartment') }}"
           class="block py-3 px-4 rounded-lg transition duration-150 ease-in-out
                  {{ request()->routeIs('landlord.add_apartment') ? 'bg-white text-gray-900' : 'text-white hover:bg-white hover:text-gray-900' }}">
            Add Apartment
        </a>
        <a href="{{ route('landlord.list_uploads') }}"
           class="block py-3 px-4 rounded-lg transition duration-150 ease-in-out
                  {{ request()->routeIs('landlord.list_uploads') ? 'bg-white text-gray-900' : 'text-white hover:bg-white hover:text-gray-900' }}">
            List of Uploads
        </a>
        <a href="{{ route('landlord.list_pending') }}"
           class="block py-3 px-4 rounded-lg transition duration-150 ease-in-out
                  {{ request()->routeIs('landlord.list_pending') ? 'bg-white text-gray-900' : 'text-white hover:bg-white hover:text-gray-900' }}">
            List of Pending
        </a>
    </nav>
</aside>
