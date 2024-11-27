<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Search Bar -->
            <form action="#" method="GET" class="mb-6">
                <div class="relative">
                    <input type="text" id="search-input"
                        class="w-full p-4 pl-10 text-gray-900 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Search for apartments..." />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.9 14.32a8 8 0 111.414-1.415l3.3 3.3a1 1 0 01-1.414 1.414l-3.3-3.3zM8 14a6 6 0 100-12 6 6 0 000 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </form>

            <!-- Apartments Display Section -->
            <div id="apartment-list" class="space-y-8">
                <!-- Apartments will be dynamically displayed here -->
                @foreach ($apartments as $apartment)
                    <a href="{{ route('apartments.show', $apartment->id) }}" class="block apartment-item">
                        <div
                            class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80 transition-transform duration-300 hover:scale-105">
                            <div class="w-full md:w-1/3 lg:w-1/4 relative flex">
                                <div class="w-full h-full">
                                    @php
                                        
                                        $image = '';
                                        if (is_string($apartment->apartment_images)) {
                                            $imagesArray = json_decode($apartment->apartment_images, true);
                                            if (is_array($imagesArray) && count($imagesArray) > 0) {
                                                $image = $imagesArray[0];
                                            }
                                        } elseif (is_array($apartment->apartment_images)) {

                                            $image = $apartment->apartment_images[0] ?? '';
                                        } else {
                                            
                                            $image = $apartment->apartment_images;
                                        }
                                    @endphp
                                    @if ($image)
                                        <img src="{{ asset('storage/images/apartments/' . $image) }}"
                                            class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg"
                                            alt="Apartment Thumbnail">
                                    @else
                                        <!-- Fallback image if no image is available -->
                                        <img src="{{ asset('storage/images/default-thumbnail.jpg') }}"
                                            class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg"
                                            alt="Default Apartment Thumbnail">
                                    @endif
                                </div>
                            </div>

                            <div
                                class="w-full md:w-2/3 lg:w-2/4 p-6 flex flex-col justify-between bg-gradient-to-r from-gray-800 to-gray-900 rounded-lg md:rounded-none">
                                <div>
                                    <h2 class="text-3xl font-extrabold text-white mb-4">{{ $apartment->apartment_name }}
                                    </h2>
                                    <p class="text-lg text-gray-300 mb-2">💲 <span
                                            class="font-semibold">{{ $apartment->room_rate }}</span></p>
                                    <p class="text-lg text-gray-300 mb-2">🏘️ Rooms: <span
                                            class="font-semibold">{{ $apartment->rooms_available }}</span></p>
                                    <p class="text-lg text-gray-300 mb-2">📍 Location: <span
                                            class="font-semibold">{{ $apartment->location }}</span></p>
                                    <p class="text-lg text-gray-300 mb-2">👤 Landlord: <span
                                            class="font-semibold">{{ $apartment->landlord_name }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>

            <!-- No Match Found Message -->
            <div id="no-match-message" class="text-center text-red-600 text-lg hidden">
                No match found
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            let searchQuery = this.value;
            let apartmentList = document.getElementById('apartment-list');
            let noMatchMessage = document.getElementById('no-match-message');

            // Make an AJAX request to search apartments
            fetch(`{{ route('search.apartments') }}?search=` + searchQuery)
                .then(response => response.json())
                .then(apartments => {
                    // Clear existing apartments
                    apartmentList.innerHTML = '';

                    // Check if any apartments were found
                    if (apartments.length > 0) {
                        noMatchMessage.classList.add('hidden'); // Hide the "No match found" message

                        // Iterate through the apartments and append them to the list
                        apartments.forEach(apartment => {
                            let apartmentHtml = `
                              <a href="{{ route('apartments.show', $apartment->id) }}" class="block apartment-item">
                                    <div class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80 transition-transform duration-300 hover:scale-105">
                                        <div class="w-full md:w-1/3 lg:w-1/4 relative flex">
                                            <div class="w-full h-full">
                                                <img src="/storage/images/apartments/${apartment.apartment_image}" class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg" alt="Apartment Image">
                                            </div>
                                        </div>

                                        <div class="w-full md:w-2/3 lg:w-2/4 p-6 flex flex-col justify-between bg-gradient-to-r from-gray-800 to-gray-900 rounded-lg md:rounded-none">
                                            <div>
                                                <h2 class="text-3xl font-extrabold text-white mb-4">${apartment.apartment_name}</h2>
                                                <p class="text-lg text-gray-300 mb-2">💲 <span class="font-semibold">${apartment.room_rate}</span></p>
                                                <p class="text-lg text-gray-300 mb-2">🏘️ Rooms: <span class="font-semibold">${apartment.rooms_available}</span></p>
                                                <p class="text-lg text-gray-300 mb-2">📍 Location: <span class="font-semibold">${apartment.location}</span></p>
                                                <p class="text-lg text-gray-300 mb-2">👤 Landlord: <span class="font-semibold">${apartment.landlord_name}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            `;

                            apartmentList.insertAdjacentHTML('beforeend', apartmentHtml);
                        });
                    } else {
                        // Show the "No match found" message if no apartments match
                        noMatchMessage.classList.remove('hidden');
                    }
                });
        });
    </script>
</x-app-layout>
