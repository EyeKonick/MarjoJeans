<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">{{ $apartment->apartment_name }}</h2>

            {{-- Carousel for all uploaded images --}}
            <div class="relative overflow-hidden mb-6">
                {{-- Carousel container --}}
                @php
                    if (is_string($apartment->apartment_images)) {
                        $images = json_decode($apartment->apartment_images, true);
                    } elseif (is_array($apartment->apartment_images)) {
                        $images = $apartment->apartment_images;
                    } else {
                        $images = [];
                    }
                @endphp

                @if(count($images) > 0)
                    <div class="carousel-images flex transition-transform duration-700 ease-in-out" data-interval="3000">
                        @foreach ($images as $image)
                            <div class="w-full flex-shrink-0">
                                <img src="{{ asset('storage/images/apartments/' . $image) }}" class="w-full h-96 object-contain rounded-lg" alt="Apartment Image">
                            </div>
                        @endforeach
                    </div>
                @endif



                {{-- Previous and Next Buttons --}}
                <button id="prevBtn" class="absolute top-1/2 -translate-y-1/2 left-4 bg-gray-800 text-white rounded-full p-2 focus:outline-none">
                    &larr;
                </button>
                <button id="nextBtn" class="absolute top-1/2 -translate-y-1/2 right-4 bg-gray-800 text-white rounded-full p-2 focus:outline-none">
                    &rarr;
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <p class="text-lg text-gray-700"><strong>Price:</strong> 💲 {{ $apartment->room_rate }}</p>
                <p class="text-lg text-gray-700"><strong>Rooms Available:</strong> 🏘️ {{ $apartment->rooms_available }}</p>
                <p class="text-lg text-gray-700"><strong>Landlord:</strong> 👤 {{ $apartment->landlord_name }}</p>
                <p class="text-lg text-gray-700"><strong>Description:</strong> {{ $apartment->description }}</p>
                <p class="text-lg text-gray-700"><strong>Contact Number:</strong> {{ $apartment->contact_no }}</p>
                <p class="text-lg text-gray-700"><strong>Email:</strong> {{ $apartment->email }}</p>
                <p class="text-lg text-gray-700"><strong>Facebook:</strong> {{ $apartment->facebook }}</p>
                <p class="text-lg text-gray-700"><strong>Address:</strong> {{ $apartment->address }}</p>
            </div>

            <div class="py-2"> 
                <p class="text-lg text-gray-700">
                    <strong>Location:</strong> 📍
                    <br>
                    <div id="map" style="width: 100%; height: 400px; border: 1px solid #ddd;"></div>
                </p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    &larr; Back to Listings
                </a>
            </div>
        </div>
    </div>

    {{-- Carousel JavaScript --}}
    <script>
        const carousel = document.querySelector('.carousel-images');
        const slides = carousel.children;
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        let index = 0;
        const totalSlides = slides.length;
        const intervalTime = parseInt(carousel.dataset.interval);

        function showSlide(idx) {
            const offset = -idx * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            index = (index + 1) % totalSlides;
            showSlide(index);
        }

        function prevSlide() {
            index = (index - 1 + totalSlides) % totalSlides;
            showSlide(index);
        }

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);


        let autoSlide = setInterval(nextSlide, intervalTime);

        carousel.addEventListener('mouseenter', () => clearInterval(autoSlide));
        carousel.addEventListener('mouseleave', () => autoSlide = setInterval(nextSlide, intervalTime));
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script 
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer>
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const latitude = {{ $apartment->latitude }};
            const longitude = {{ $apartment->longitude }};
            
            // Initialize map with default view (satellite view)
            const map = L.map("map", {
                center: [latitude, longitude],
                zoom: 15
            });
    
            
            const streetViewLayer = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 22,
            });
    
      
            const satelliteViewLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 22,
                attribution: 'Tiles &copy; Esri'
            });
    
      
            streetViewLayer.addTo(map);
    

            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup("<b>Apartment Location</b>").openPopup();
    
           
            map.setView([latitude, longitude], 19);
    
    
            L.control.layers({
                "Satellite View": satelliteViewLayer,
                "Street View": streetViewLayer
            }).addTo(map);
        });
    </script>
</x-app-layout>