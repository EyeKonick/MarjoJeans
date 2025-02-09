@extends('landlord.dashboard')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Update Apartment</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form for Updating Apartment -->
    <form method="POST" enctype="multipart/form-data" class="space-y-6" action="{{ route('landlord.apartments.update', $apartment->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Landlord Name -->
            <div>
                <label for="landlord_name" class="block text-gray-700 font-medium">Landlord Name:</label>
                <input type="text" id="landlord_name" name="landlord_name" class="w-full border border-gray-300 p-2 rounded-lg bg-gray-100" value="{{ $apartment->landlord_name }}" readonly>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-gray-700 font-medium">Address:</label>
                <input type="text" id="address" name="address" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->address }}">
            </div>

            <!-- Contact No. -->
            <div>
                <label for="contact_no" class="block text-gray-700 font-medium">Contact No.:</label>
                <input type="text" id="contact_no" name="contact_no" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->contact_no }}">
            </div>

            <!-- Facebook -->
            <div>
                <label for="facebook" class="block text-gray-700 font-medium">Facebook:</label>
                <input type="text" id="facebook" name="facebook" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->facebook }}">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email:</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->email }}">
            </div>

            <!-- Apartment Name -->
            <div>
                <label for="apartment_name" class="block text-gray-700 font-medium">Apartment Name:</label>
                <input type="text" id="apartment_name" name="apartment_name" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->apartment_name }}">
            </div>

            <!-- Rooms Available -->
            <div>
                <label for="rooms_available" class="block text-gray-700 font-medium">Rooms Available:</label>
                <input type="number" id="rooms_available" name="rooms_available" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->rooms_available }}">
            </div>

            <!-- Room Rate -->
            <div>
                <label for="room_rate" class="block text-gray-700 font-medium">Room Rate:</label>
                <input type="text" id="room_rate" name="room_rate" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->room_rate }}">
            </div>

            <!-- Apartment Images -->
            <div class="col-span-2">
                <label for="apartment_images" class="block text-gray-700 font-medium">Apartment Images:</label>
                @if($apartment->apartment_images)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mt-2" id="image-previews">
                        @foreach(json_decode($apartment->apartment_images, true) as $image)
                            <div class="relative text-center">
                                <!-- Image with Click-to-Enlarge Functionality -->
                                <img src="{{ asset('storage/images/apartments/' . $image) }}" alt="Current Image" class="w-full h-24 object-cover mb-2 cursor-pointer" onclick="openImageModal('{{ asset('storage/images/apartments/' . $image) }}')">
                                <!-- Delete Button -->
                                <button type="button" class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded-full text-xs hover:bg-red-600" onclick="deleteImage('{{ $image }}')">×</button>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- File Input for New Images -->
                <input type="file" id="apartment_images" name="apartment_images[]" class="w-full border border-gray-300 p-2 rounded-lg mt-2" multiple>
            </div>

            <!-- Hidden Field for Deleted Images -->
            <input type="hidden" id="deleted_images" name="deleted_images" value="">

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 font-medium">Other Description:</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 p-2 rounded-lg">{{ $apartment->description }}</textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Update Apartment
            </button>
        </div>
    </form>
</div>

<!-- Image Modal for Enlarged View -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4">
    <div class="bg-white p-4 rounded-lg max-w-3xl max-h-full overflow-auto">
        <img id="modalImage" src="" alt="Enlarged Image" class="w-full h-auto">
        <button type="button" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="closeImageModal()">Close</button>
    </div>
</div>

<!-- JavaScript for Image Modal and Deletion -->
<script>
    // Function to open the image modal
    function openImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    // Function to close the image modal
    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Function to delete an image
    function deleteImage(imageName) {
        if (confirm('Are you sure you want to delete this image?')) {
            // Add the image name to the deleted_images hidden input
            const deletedImagesInput = document.getElementById('deleted_images');
            let deletedImages = deletedImagesInput.value ? deletedImagesInput.value.split(',') : [];
            deletedImages.push(imageName);
            deletedImagesInput.value = deletedImages.join(',');

            // Remove the image preview from the page
            document.querySelector(`img[src*='${imageName}']`).closest('.relative').remove();
        }
    }
</script>

@endsection
