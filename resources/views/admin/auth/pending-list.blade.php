@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Pending Listings</h2>

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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Owner Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pending as $listing)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing->apartment_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing->address }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing->landlord_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing->room_rate }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.approve_apartment', $listing->id) }}" class="text-white bg-green-500 py-1 px-2 rounded-md hover:text-green-900">Approve</a>
                        <a href="{{ route('admin.reject_apartment', $listing->id) }}" class="text-white bg-red-500 py-1 px-2 rounded-md hover:text-red-900 ml-2">Reject</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
