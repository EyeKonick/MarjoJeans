@extends('admin.dashboard')

@section('content')
    <div class="max-w-full mx-auto bg-gray-100 p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-800">User Management List</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-md mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Flexbox for two tables side by side --}}
        <div class="flex flex-wrap gap-6">
            {{-- Left Side - Landlords --}}
            <div class="w-full bg-white p-4 rounded-lg shadow-md">
                {{-- Landlords Header with Search Bar --}}
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-md font-semibold text-gray-700">Landlords</h3>
                    <form action="{{ route('admin.user_management') }}" method="GET" class="flex items-center">
                        <input type="text" name="landlords_search" placeholder="Search landlords..."
                               class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                               value="{{ request()->input('landlords_search') }}">
                        <button type="submit" class="ml-2 bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600">
                            Search
                        </button>
                    </form>
                </div>

                {{-- Landlords Table --}}
                <div class="overflow-hidden rounded-lg">
                    <table class="w-full border-collapse border border-gray-300 bg-white">
                        <thead class="bg-gray-200 text-sm text-gray-700 uppercase">
                            <tr class="text-left">
                                <th class="px-4 py-2 border w-1/4">Name</th>
                                <th class="px-4 py-2 border w-1/4">Email</th>
                                <th class="px-4 py-2 border w-1/4">Created</th>
                                <th class="px-4 py-2 border w-1/4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm bg-white">
                            @foreach ($paginatedLandlords as $landlord)
                                <tr class="border-b-2 border-black hover:bg-gray-100">
                                    <td class="px-4 py-2 w-1/4">{{ $landlord->name }}</td>
                                    <td class="px-4 py-2 w-1/4">{{ $landlord->email }}</td>
                                    <td class="px-4 py-2 w-1/4">{{ $landlord->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 flex space-x-2 justify-center">
                                        <a href="{{ route('admin.edit.user', ['id' => $landlord->id, 'type' => 'landlord']) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded-md text-xs hover:bg-yellow-600">Edit</a>

                                        <form action="{{ route('admin.delete.user', ['id' => $landlord->id, 'type' => 'landlord']) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Pagination for Landlords --}}
                <div class="mt-4 text-xs text-gray-600">
                    {{ $paginatedLandlords->appends(['users_page' => request()->input('users_page')])->links() }}
                </div>
            </div>

            {{-- Right Side - Users --}}
            <div class="w-full bg-white p-4 rounded-lg shadow-md">
                {{-- Users Header with Search Bar --}}
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-md font-semibold text-gray-700">Users</h3>
                    <form action="{{ route('admin.user_management') }}" method="GET" class="flex items-center">
                        <input type="text" name="users_search" placeholder="Search users..."
                               class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                               value="{{ request()->input('users_search') }}">
                        <button type="submit" class="ml-2 bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600">
                            Search
                        </button>
                    </form>
                </div>

                {{-- Users Table --}}
                <div class="overflow-hidden rounded-lg">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200 text-sm text-gray-700 uppercase">
                            <tr class="text-left">
                                <th class="px-4 py-2 border w-1/4">Name</th>
                                <th class="px-4 py-2 border w-1/4">Email</th>
                                <th class="px-4 py-2 border w-1/4">Created</th>
                                <th class="px-4 py-2 border w-1/4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm bg-white">
                            @foreach ($paginatedUsers as $user)
                                <tr class="border-b-2 border-black hover:bg-gray-100">
                                    <td class="px-4 py-2 w-1/4">{{ $user->name }}</td>
                                    <td class="px-4 py-2 w-1/4">{{ $user->email }}</td>
                                    <td class="px-4 py-2 w-1/4">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 flex space-x-2 justify-center">
                                        <a href="{{ route('admin.edit.user', ['id' => $user->id, 'type' => 'user']) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded-md text-xs hover:bg-yellow-600">Edit</a>

                                        <form action="{{ route('admin.delete.user', ['id' => $user->id, 'type' => 'user']) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Pagination for Users --}}
                <div class="mt-4 text-xs text-gray-600">
                    {{ $paginatedUsers->appends(['landlords_page' => request()->input('landlords_page')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
