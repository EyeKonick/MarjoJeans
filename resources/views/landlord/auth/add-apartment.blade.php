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
    let selectedFiles = []; // Store the selected files

    function addImages(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-container');

        Array.from(files).forEach((file) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Create image element
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = file.name;
                    img.className = 'w-full h-32 object-cover rounded shadow-md';

                    // Wrapper div
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative group';

                    // Delete icon
                    const deleteIcon = document.createElement('div');
                    deleteIcon.className =
                        'absolute top-0 right-0 m-1 p-1 bg-red-600 text-white rounded-full cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300';
                    deleteIcon.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';

                    // Delete logic
                    deleteIcon.onclick = function () {
                        wrapper.remove(); // Remove the preview
                        selectedFiles = selectedFiles.filter((f) => f.name !== file.name); // Remove from the selectedFiles array
                        updateFileList();
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(deleteIcon);
                    previewContainer.appendChild(wrapper);

                    // Add file to selectedFiles array
                    selectedFiles.push(file);
                };

                reader.readAsDataURL(file);
            }
        });

        // Reset the file input to allow selecting the same file again
        event.target.value = '';
        updateFileList();
    }

    function updateFileList() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach((file) => dataTransfer.items.add(file));
        document.getElementById('apartment_image_input').files = dataTransfer.files;
    }
</script>

