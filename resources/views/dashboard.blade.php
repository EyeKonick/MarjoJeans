<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @foreach ($apartments as $apartment)
                <div class="bg-gray-800 text-white overflow-hidden shadow-lg sm:rounded-lg flex flex-col md:flex-row mb-6 h-80">
                    <!-- Apartment Image -->
                    <div class="w-full md:w-1/3 lg:w-1/4 relative flex">
                        <div class="w-full h-full">
                            <img src="{{ $apartment->image_url }}" alt="{{ $apartment->name }}" class="w-full h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg">
                        </div>
                    </div>

                    <!-- Apartment Details -->
                    <div class="w-full md:w-2/3 lg:w-2/4 p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white">{{ $apartment->name }}</h2>
                            <p class="mt-2 text-lg text-gray-300">Price: <span class="font-medium">{{ $apartment->price }}</span></p>
                            <p class="mt-1 text-lg text-gray-300">Rooms: <span class="font-medium">{{ $apartment->rooms }}</span></p>
                            <p class="mt-1 text-lg text-gray-300">Location: <span class="font-medium">{{ $apartment->location }}</span></p>
                            <p class="mt-1 text-lg text-gray-300">Landlord: <span class="font-medium">{{ $apartment->landlord_name }}</span></p>
                        </div>
                    </div>

                    <!-- Google Maps Pinpoint -->
                    <div class="w-full md:w-1/3 lg:w-1/4 p-6">
                        <div id="map-{{ $apartment->id }}" class="w-full h-48 rounded-b-lg md:rounded-b-none md:rounded-r-lg"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Include Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script>
        function initMap() {
            @foreach ($apartments as $apartment)
                var map = new google.maps.Map(document.getElementById('map-{{ $apartment->id }}'), {
                    center: { lat: {{ $apartment->latitude }}, lng: {{ $apartment->longitude }} },
                    zoom: 15
                });
                new google.maps.Marker({
                    position: { lat: {{ $apartment->latitude }}, lng: {{ $apartment->longitude }} },
                    map: map
                });
            @endforeach
        }
        window.onload = initMap;
    </script>
</x-app-layout>
