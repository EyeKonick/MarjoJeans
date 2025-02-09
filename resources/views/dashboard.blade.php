<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <input type="text" name="search" id="search-input"
                        class="w-full p-4 pl-10 text-gray-900 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Search for apartments..." />
                    <button id="search-button" class="absolute inset-y-0 right-0 px-4 flex items-center bg-indigo-500 text-white rounded-r-lg hover:bg-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.415l3.3 3.3a1 1 0 01-1.414 1.414l-3.3-3.3zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Apartments Display Section -->
            <div id="apartment-list" class="space-y-8">
                @foreach ($apartments as $apartment)
                    <a href="{{ route('apartments.show', $apartment->id) }}" class="block apartment-item">
                        <div class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80 transition-transform duration-300 hover:scale-105">
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
                                            $image = '';
                                        }
                                    @endphp
                                    <img src="{{ asset('storage/images/apartments/' . $image) }}"
                                        class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg"
                                        alt="Apartment Thumbnail">
                                </div>
                            </div>
                            <div class="w-full md:w-2/3 lg:w-2/4 p-6 flex flex-col justify-between bg-gradient-to-r from-gray-800 to-gray-900 rounded-lg md:rounded-none">
                                <div>
                                    <h2 class="text-3xl font-extrabold text-white mb-4">{{ $apartment->apartment_name }}</h2>
                                    <p class="text-lg text-gray-300 mb-2">💲 <span class="font-semibold">{{ $apartment->room_rate }}</span></p>
                                    <p class="text-lg text-gray-300 mb-2">🏘️ Rooms: <span class="font-semibold">{{ $apartment->rooms_available }}</span></p>
                                    <p class="text-lg text-gray-300 mb-2">📍 Address: <span class="font-semibold">{{ $apartment->address }}</span></p>
                                    <p class="text-lg text-gray-300 mb-2">👤 Landlord: <span class="font-semibold">{{ $apartment->landlord_name }}</span></p>
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
        document.addEventListener("DOMContentLoaded", function () {
            let searchInput = document.getElementById('search-input');
            let searchButton = document.getElementById('search-button');
            let apartmentList = document.getElementById('apartment-list');
            let noMatchMessage = document.getElementById('no-match-message');
            let searchRoute = "{{ route('search.apartments') }}";

            function performSearch() {
                let searchQuery = searchInput.value.trim();

                if (searchQuery.length === 0) {
                    // If search is empty, display all apartments
                    noMatchMessage.classList.add('hidden');
                    apartmentList.innerHTML = ''; // Clear current list
                    fetch(searchRoute)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(apartments => {
                            apartmentList.innerHTML = '';
                            if (apartments.length > 0) {
                                apartments.forEach(apartment => {
                                    let apartmentHtml = `
                                        <a href="/apartments/${apartment.id}" class="block apartment-item">
                                            <div class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80 transition-transform duration-300 hover:scale-105">
                                                <div class="w-full md:w-1/3 lg:w-1/4 relative flex">
                                                    <div class="w-full h-full">
                                                        <img src="${apartment.thumbnail}" class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg" alt="Apartment Image">
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
                                noMatchMessage.classList.remove('hidden');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching apartments:', error);
                            noMatchMessage.classList.remove('hidden');
                            noMatchMessage.textContent = 'An error occurred while searching.';
                        });
                } else {
                    // Perform search with query
                    fetch(searchRoute + '?search=' + encodeURIComponent(searchQuery))
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(apartments => {
                            apartmentList.innerHTML = '';

                            if (apartments.length > 0) {
                                noMatchMessage.classList.add('hidden');
                                apartments.forEach(apartment => {
                                    let apartmentHtml = `
                                        <a href="/apartments/${apartment.id}" class="block apartment-item">
                                            <div class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80 transition-transform duration-300 hover:scale-105">
                                                <div class="w-full md:w-1/3 lg:w-1/4 relative flex">
                                                    <div class="w-full h-full">
                                                        <img src="${apartment.thumbnail}" class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg" alt="Apartment Image">
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
                                noMatchMessage.classList.remove('hidden');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching apartments:', error);
                            noMatchMessage.classList.remove('hidden');
                            noMatchMessage.textContent = 'An error occurred while searching.';
                        });
                }
            }

            searchInput.addEventListener("input", performSearch);
            searchButton.addEventListener("click", performSearch);
        });
    </script>
</x-app-layout>
