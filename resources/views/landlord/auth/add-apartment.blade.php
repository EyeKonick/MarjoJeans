@extends('landlord.dashboard') <!-- Use the dashboard layout -->

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Add Apartment</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form id="addApartment" enctype="multipart/form-data" method="POST" action="{{ route('landlord.add_apartment_item') }}" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <input type="hidden" name="landlord_name" value="{{ Auth::user()->name }}">

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
                <label for="location" class="block text-gray-700 font-semibold mb-2">
                    Location <span class="text-red-500">*</span>
                </label>
                
                <!-- Leaflet Map -->
                <div id="map" style="width: 100%; height: 300px; border: 1px solid #ddd;"></div>
                
                <!-- Latitude and Longitude Inputs -->
                <div class="mt-4">
                    <input 
                        type="hidden" 
                        id="latitude" 
                        name="latitude" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Latitude" 
                        readonly>
                </div>
                
                <div class="mt-4">
                    <input 
                        type="hidden" 
                        id="longitude" 
                        name="longitude" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Longitude" 
                        readonly>
                </div>
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

            <!-- Apartment Images -->
            <div>
                <label for="apartment_images" class="block text-gray-700 font-semibold mb-2">
                    Apartment Images<span class="text-red-500">*</span>
                </label>
                <div class="flex items-center gap-4">
                    <input
                        type="file"
                        id="apartment_image_input"
                        class="hidden"
                        name="apartment_images[]"
                        multiple
                        accept="image/*"
                        onchange="addImages(event)">
                    <button
                        type="button"
                        onclick="document.getElementById('apartment_image_input').click()"
                        class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                        Add Images
                    </button>
                </div>
                <small class="text-gray-500 mt-2 block">You can  (must upload atleast 1 image) <br> Allowed formats: jpeg, png, jpg, gif.</small>
                @error('apartment_images')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <!-- Preview Container -->
                <div id="preview-container" class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4"></div>
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
<script>
let selectedFiles = [];

function addImages(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('preview-container');

    // Loop through selected files
    Array.from(files).forEach((file) => {
        // Only accept image files
        if (file.type.startsWith('image/') && !selectedFiles.some(f => f.name === file.name)) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Create an image element to display the preview
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;
                img.className = 'w-full h-32 object-cover rounded shadow-md';

                const wrapper = document.createElement('div');
                wrapper.className = 'relative group';

                const deleteIcon = document.createElement('div');
                deleteIcon.className = 'absolute top-0 right-0 m-1 p-1 bg-red-600 text-white rounded-full cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300';
                deleteIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';

                deleteIcon.onclick = function () {
                    wrapper.remove();
                    selectedFiles = selectedFiles.filter((f) => f.name !== file.name);
                    updateFileList();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(deleteIcon);
                previewContainer.appendChild(wrapper);

                selectedFiles.push(file);
            };

            reader.readAsDataURL(file);
        }
    });

    event.target.value = '';
    updateFileList();
}

function updateFileList() {
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach((file) => dataTransfer.items.add(file));

    const fileInput = document.getElementById('apartment_image_input');
    fileInput.files = dataTransfer.files;

}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('addApartment').addEventListener('submit', function (event) {
        const fileInput = document.getElementById('apartment_image_input');

        if (selectedFiles.length === 0) {
            event.preventDefault();
            alert("Please select images to upload.");
            return;
        }

        const dataTransfer = new DataTransfer();
        selectedFiles.forEach((file) => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;

    });
});




</script>


<link 
    rel="stylesheet" 
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script 
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer>
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map');
    let marker = null;

    function setMarker(lat, lng) {
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);

            marker.on('dragend', function () {
                const position = marker.getLatLng();
                updateInputs(position.lat, position.lng);
            });
        }
        map.setView([lat, lng], 14);
        updateInputs(lat, lng);
    }

    function updateInputs(lat, lng) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '&copy; <a href="https://www.esri.com">Esri</a> contributors',
        maxZoom: 19
    });

    const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    });

    satelliteLayer.addTo(map);

    const baseLayers = {
        "Satellite": satelliteLayer,
        "Street": streetLayer
    };

    L.control.layers(baseLayers).addTo(map);

    
    map.on('click', function (e) {
        const { lat, lng } = e.latlng;
        setMarker(lat, lng);
        updateInputs(lat, lng);
    });

    setMarker(11.429917430404114, 122.59678557515146);
});
</script>
