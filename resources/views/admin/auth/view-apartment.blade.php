@extends('admin.dashboard')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Apartment Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-gray-700 font-medium">Landlord Name:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->landlord_name }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Address:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->address }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Contact No.:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->contact_no }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Facebook:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->facebook ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Email:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->email }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Apartment Name:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->apartment_name }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Location:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->location }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Rooms Available:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->rooms_available }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Room Rate:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->room_rate }}</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Apartment Image:</label>
            @if($apartment->apartment_image)
                <img src="{{ asset('storage/images/apartments/' . $apartment->apartment_image) }}" alt="Apartment Image" class="mt-2 max-w-xs rounded-md border">
            @else
                <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">No Image Available</p>
            @endif
        </div>

        <div class="col-span-2">
            <label class="block text-gray-700 font-medium">Other Description:</label>
            <p class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $apartment->description ?? 'No Description' }}</p>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('admin.manage_list') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection
