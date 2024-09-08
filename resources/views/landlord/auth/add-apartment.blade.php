@extends('landlord.dashboard') <!-- Use the dashboard layout -->

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Add Apartment</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('landlord.add_apartment_item') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Automatically display landlord's name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Landlord Name</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-3">{{ Auth::user()->name }}</p>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-gray-700 font-semibold mb-2">Address <span class="text-red-500">*</span></label>
                <input type="text" id="address" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror" placeholder="Enter full address" value="{{ old('address') }}">
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact No. -->
            <div>
                <label for="contact_no" class="block text-gray-700 font-semibold mb-2">Contact Number <span class="text-red-500">*</span></label>
                <input type="text" id="contact_no" name="contact_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('contact_no') border-red-500 @enderror" placeholder="Enter contact number" value="{{ old('contact_no') }}">
                @error('contact_no')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Facebook -->
            <div>
                <label for="facebook" class="block text-gray-700 font-semibold mb-2">Facebook</label>
                <input type="text" id="facebook" name="facebook" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('facebook') border-red-500 @enderror" placeholder="Enter Facebook link" value="{{ old('facebook') }}">
                @error('facebook')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" placeholder="Enter email address" value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Apartment Name -->
            <div>
                <label for="apartment_name" class="block text-gray-700 font-semibold mb-2">Apartment Name <span class="text-red-500">*</span></label>
                <input type="text" id="apartment_name" name="apartment_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('apartment_name') border-red-500 @enderror" placeholder="Enter apartment name" value="{{ old('apartment_name') }}">
                @error('apartment_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-gray-700 font-semibold mb-2">Location <span class="text-red-500">*</span></label>
                <input type="text" id="location" name="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-500 @enderror" placeholder="Enter location" value="{{ old('location') }}">
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Rooms Available -->
            <div>
                <label for="rooms_available" class="block text-gray-700 font-semibold mb-2">Rooms Available <span class="text-red-500">*</span></label>
                <input type="number" id="rooms_available" name="rooms_available" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('rooms_available') border-red-500 @enderror" placeholder="Enter number of rooms" value="{{ old('rooms_available') }}">
                @error('rooms_available')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Room Rate -->
            <div>
                <label for="room_rate" class="block text-gray-700 font-semibold mb-2">Room Rate <span class="text-red-500">*</span></label>
                <input type="text" id="room_rate" name="room_rate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('room_rate') border-red-500 @enderror" placeholder="Enter room rate" value="{{ old('room_rate') }}">
                @error('room_rate')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Apartment Image -->
            <div>
                <label for="apartment_image" class="block text-gray-700 font-semibold mb-2">Apartment Image</label>
                <input type="file" id="apartment_image" name="apartment_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('apartment_image') border-red-500 @enderror">
                @error('apartment_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Other Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror" placeholder="Enter additional details">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="w-full md:w-1/3 bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">Submit</button>
        </div>
    </form>

</div>
@endsection
