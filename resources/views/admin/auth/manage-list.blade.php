@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Manage Listings</h2>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Apartment Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Owner Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase  tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($manage as $listing)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['apartment_name'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['address'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['landlord_name'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['room_rate'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- Edit Link -->
                            <a href="{{ route('admin.edit_apartment', $listing->id) }}" class="text-white rounded px-4 py-1 bg-blue-600 hover:bg-blue-500">Edit</a>
                            <!-- Delete Link -->
                            <form action="{{ route('admin.delete_apartment', $listing->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white rounded px-4 py-1 bg-red-600 hover:bg-red-500">Delete</button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $manage->links() }}
    </div>
</div>
@endsection
