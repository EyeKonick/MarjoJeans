@extends('landlord.dashboard')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Update Apartment</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-6" action="{{ route('landlord.apartments.update', $apartment->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Existing data should be populated -->
            <div>
                <label for="landlord_name" class="block text-gray-700 font-medium">Landlord Name:</label>
                <input type="text" id="landlord_name" name="landlord_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('landlord_name', $apartment->landlord_name) }}" required>
            </div>

            <div>
                <label for="address" class="block text-gray-700 font-medium">Address:</label>
                <input type="text" id="address" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('address', $apartment->address) }}" required>
            </div>

            <div>
                <label for="contact_no" class="block text-gray-700 font-medium">Contact No.:</label>
                <input type="text" id="contact_no" name="contact_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('contact_no', $apartment->contact_no) }}" required>
            </div>

            <div>
                <label for="facebook" class="block text-gray-700 font-medium">Facebook:</label>
                <input type="text" id="facebook" name="facebook" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('facebook', $apartment->facebook) }}">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Email:</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email', $apartment->email) }}" required>
            </div>

            <div>
                <label for="apartment_name" class="block text-gray-700 font-medium">Apartment Name:</label>
                <input type="text" id="apartment_name" name="apartment_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('apartment_name', $apartment->apartment_name) }}" required>
            </div>

            <div>
                <label for="location" class="block text-gray-700 font-medium">Location:</label>
                <input type="text" id="location" name="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('location', $apartment->location) }}" placeholder="Pinpoint location on Google Maps" required>
            </div>

            <div>
                <label for="rooms_available" class="block text-gray-700 font-medium">Rooms Available:</label>
                <input type="number" id="rooms_available" name="rooms_available" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('rooms_available', $apartment->rooms_available) }}" required>
            </div>

            <div>
                <label for="room_rate" class="block text-gray-700 font-medium">Room Rate:</label>
                <input type="text" id="room_rate" name="room_rate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('room_rate', $apartment->room_rate) }}" required>
            </div>

            <div>
                <label for="apartment_image" class="block text-gray-700 font-medium">Attach Apartment Image:</label>
                <input type="file" id="apartment_image" name="apartment_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <!-- Display current image if exists -->
                @if($apartment->apartment_image)
                    <img src="{{ asset('storage/images/apartments/' . $apartment->apartment_image) }}" alt="Current Image" class="mt-2 max-w-xs">
                @endif
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium">Other Description:</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $apartment->description) }}</textarea>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Update</button>
        </div>
    </form>
</div>
@endsection
