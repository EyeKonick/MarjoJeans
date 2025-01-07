@extends('landlord.dashboard')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Update Apartment</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-6" action="{{ route('landlord.apartments.update', $apartment->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Display data instead of input fields -->
            <div>
                <label for="landlord_name" class="block text-gray-700 font-medium">Landlord Name:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->landlord_name }}</p>
            </div>

            <div>
                <label for="address" class="block text-gray-700 font-medium">Address:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->address }}</p>
            </div>

            <div>
                <label for="contact_no" class="block text-gray-700 font-medium">Contact No.:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->contact_no }}</p>
            </div>

            <div>
                <label for="facebook" class="block text-gray-700 font-medium">Facebook:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->facebook }}</p>
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Email:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->email }}</p>
            </div>

            <div>
                <label for="apartment_name" class="block text-gray-700 font-medium">Apartment Name:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->apartment_name }}</p>
            </div>

            <div>
                <label for="location" class="block text-gray-700 font-medium">Location:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->location }}</p>
            </div>

            <div>
                <label for="rooms_available" class="block text-gray-700 font-medium">Rooms Available:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->rooms_available }}</p>
            </div>

            <div>
                <label for="room_rate" class="block text-gray-700 font-medium">Room Rate:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->room_rate }}</p>
            </div>

            <div>
                <label for="apartment_image" class="block text-gray-700 font-medium">Attach Apartment Image:</label>
                <!-- Display current image if exists -->
                @if($apartment->apartment_image)
                    <img src="{{ asset('storage/images/apartments/' . $apartment->apartment_image) }}" alt="Current Image" class="mt-2 max-w-xs">
                @else
                    <p class="mt-1 text-gray-900">No image available</p>
                @endif
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium">Other Description:</label>
                <p class="mt-1 text-gray-900">{{ $apartment->description }}</p>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Update</button>
        </div>
    </form>
</div>
@endsection
