@extends('admin.dashboard')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md overflow-hidden">
    <h2 class="text-xl font-bold mb-4">Manage Listings</h2>

    <!-- Table Container -->
    <div class="w-full overflow-hidden">
        <table class="table-auto w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-50 text-xs text-gray-600">
                <tr>
                    <th class="px-3 py-2 text-left font-medium uppercase border border-gray-300">
                        Apartment Name
                    </th>
                    <th class="px-3 py-2 text-left font-medium uppercase border border-gray-300">
                        Address
                    </th>
                    <th class="px-3 py-2 text-center font-medium uppercase border border-gray-300">
                        Owner Name
                    </th>
                    <th class="px-3 py-2 text-center font-medium uppercase border border-gray-300">
                        Price
                    </th>
                    <th class="px-3 py-2 text-center font-medium uppercase border border-gray-300">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white text-sm">
                @foreach($manage as $listing)
                <tr class="border border-gray-300">
                    <td class="px-3 py-2 border border-gray-300">
                        {{ $listing['apartment_name'] }}
                    </td>
                    <td class="px-3 py-2 border border-gray-300">
                        {{ $listing['address'] }}
                    </td>
                    <td class="px-3 py-2 text-center border border-gray-300">
                        {{ $listing['landlord_name'] }}
                    </td>
                    <td class="px-3 py-2 text-center border border-gray-300">
                        {{ $listing['room_rate'] }}
                    </td>
                    <td class="px-3 py-2 text-center border border-gray-300">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.view_apartment', $listing->id) }}" class="text-white rounded px-3 py-1 bg-blue-600 hover:bg-blue-500 text-xs">View</a>
                            <form action="{{ route('admin.delete_apartment', $listing->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white rounded px-3 py-1 bg-red-600 hover:bg-red-500 text-xs">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 text-sm">
        {{ $manage->links() }}
    </div>
</div>
@endsection
