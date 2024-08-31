<!-- resources/views/admin/auth/pending-list.blade.php -->
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pending as $listing)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['apartment_name'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['address'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['owner_name'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $listing['price'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-green-600 hover:text-green-900">Approve</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">Reject</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
