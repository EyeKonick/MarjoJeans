<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @foreach ($apartments as $apartment)
                <div class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80 transition-transform duration-300 hover:scale-105">
                    <!-- Apartment Image -->
                    <div class="w-full md:w-1/3 lg:w-1/4 relative flex">
                        <div class="w-full h-full">
                            <!-- Display the apartment image -->
                            <img src="{{ asset('storage/images/apartments/' . $apartment->apartment_image) }}" class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg" alt="Apartment Image">
                        </div>
                    </div>

                    <!-- Apartment Details -->
                    <div class="w-full md:w-2/3 lg:w-2/4 p-6 flex flex-col justify-between bg-gradient-to-r from-gray-800 to-gray-900 rounded-lg md:rounded-none">
                        <div>
                            <h2 class="text-3xl font-extrabold text-white mb-4">{{ $apartment->apartment_name }}</h2>
                            <p class="text-lg text-gray-300 mb-2">💲 <span class="font-semibold">{{ $apartment->room_rate }}</span></p>
                            <p class="text-lg text-gray-300 mb-2">🏘️ Rooms: <span class="font-semibold">{{ $apartment->rooms_available }}</span></p>
                            <p class="text-lg text-gray-300 mb-2">📍 Location: <span class="font-semibold">{{ $apartment->location }}</span></p>
                            <p class="text-lg text-gray-300 mb-2">👤 Landlord: <span class="font-semibold">{{ $apartment->landlord_name }}</span></p>
                        </div>
                    </div>

                    <!-- Google Maps Placeholder -->
                    <div class="w-full md:w-1/3 lg:w-1/4 p-6 flex justify-center items-center">
                        <!-- Placeholder square with enhanced design -->
                        <div class="w-full h-48 bg-gradient-to-r from-blue-500 to-purple-600 rounded-b-lg md:rounded-b-none md:rounded-r-lg flex justify-center items-center shadow-xl">
                            <span class="text-4xl text-white font-extrabold tracking-widest drop-shadow-lg">MAP</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
