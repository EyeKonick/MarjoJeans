@extends('landlord.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">List of Pending Requests</h2>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

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
                    Price
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($pending as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->apartment_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->address }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->room_rate }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $item->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($item->status) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <a href="{{ route('landlord.apartments.edit', ['id' => $item->id, 'redirect' => 'pending']) }}" class="hover:text-blue-900 mr-2 bg-green-500 text-white py-1 px-2 rounded-md">Update</a>

                        <form action="{{ route('landlord.apartments.delete', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white rounded ml-2 px-4 py-1 bg-red-600 hover:bg-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
