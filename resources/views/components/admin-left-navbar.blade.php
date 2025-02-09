<aside class="h-full shadow-md bg-gray-500">
    <nav class="grid grid-cols-1 gap-4 py-6 px-4 bg-gray-500 text-xl">
        <a href="{{ route('admin.overview') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            Overview
        </a>
        <a href="{{ route('admin.pending_list') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            Pending Listing
        </a>
        <a href="{{ route('admin.manage_list') }}"  class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            Manage Listing
        </a>
        <a href="{{ route('admin.user_management') }}" class="block text-white hover:bg-white hover:text-gray-900 py-3 px-4 rounded-lg transition duration-150 ease-in-out">
            User Management
        </a>
    </nav>
</aside>
