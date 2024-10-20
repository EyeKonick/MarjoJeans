@extends('landlord.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">List of Uploads</h2>

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

    <!-- Status Filter Dropdown -->
    <form action="{{ route('landlord.list_uploads') }}" method="GET" class="mb-4" id="statusFilterForm">
        <label for="status" class="block text-sm font-medium text-gray-700">Filter by Status:</label>
        <select id="status" name="status" onchange="this.form.submit()" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            <option value="" @if(!request('status')) selected @endif>All Uploads</option>
            <option value="approved" @if(request('status') == 'approved') selected @endif>Approved</option>
            <option value="rejected" @if(request('status') == 'rejected') selected @endif>Rejected</option>
        </select>
    </form>

    <!-- Table -->
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
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($uploads as $upload)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $upload->apartment_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $upload->address }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $upload->room_rate }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="@if($upload->status == 'approved') text-green-500 @elseif($upload->status == 'rejected') text-red-500 @else text-gray-500 @endif font-medium">
                            {{ ucfirst($upload->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <!-- Conditionally render the Edit Link -->
                        @if($upload->status == 'approved')
                            <a href="{{ route('landlord.apartments.edit', ['id' => $upload->id, 'redirect' => 'uploads']) }}" class="text-white rounded px-4 py-1 bg-blue-600 hover:bg-blue-500">Edit</a>
                        @else
                            <span class="text-gray-500"></span>
                        @endif

                        <form action="{{ route('landlord.apartments.delete', $upload->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white rounded ml-2 px-4 py-1 bg-red-600 hover:bg-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $uploads->links() }}
    </div>
</div>
@endsection
