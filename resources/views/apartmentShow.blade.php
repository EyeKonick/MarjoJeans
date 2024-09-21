<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">{{ $apartment->apartment_name }}</h2>

            <div class="mb-4">
                <img src="{{ asset('storage/images/apartments/' . $apartment->apartment_image) }}" class="w-full h-64 object-cover rounded-lg" alt="Apartment Image">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <p class="text-lg text-gray-700"><strong>Price:</strong> 💲 {{ $apartment->room_rate }}</p>
                <p class="text-lg text-gray-700"><strong>Rooms Available:</strong> 🏘️ {{ $apartment->rooms_available }}</p>
                <p class="text-lg text-gray-700"><strong>Location:</strong> 📍 {{ $apartment->location }}</p>
                <p class="text-lg text-gray-700"><strong>Landlord:</strong> 👤 {{ $apartment->landlord_name }}</p>
                <p class="text-lg text-gray-700"><strong>Description:</strong> {{ $apartment->description }}</p>
                <p class="text-lg text-gray-700"><strong>Contact Number:</strong> {{ $apartment->contact_no }}</p>
                <p class="text-lg text-gray-700"><strong>Email:</strong> {{ $apartment->email }}</p>
                <p class="text-lg text-gray-700"><strong>Facebook:</strong> {{ $apartment->facebook }}</p>
                <p class="text-lg text-gray-700"><strong>Address:</strong> {{ $apartment->address }}</p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    &larr; Back to Listings
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
