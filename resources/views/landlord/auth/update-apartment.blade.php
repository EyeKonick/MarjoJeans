@extends('landlord.dashboard')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Update Apartment</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" class="space-y-6" action="{{ route('landlord.apartments.update', $apartment->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="landlord_name" class="block text-gray-700 font-medium">Landlord Name:</label>
                <input type="text" id="landlord_name" name="landlord_name" class="w-full border border-gray-300 p-2 rounded-lg bg-gray-100" value="{{ $apartment->landlord_name }}" readonly>
            </div>

            <div>
                <label for="address" class="block text-gray-700 font-medium">Address:</label>
                <input type="text" id="address" name="address" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->address }}">
            </div>

            <div>
                <label for="contact_no" class="block text-gray-700 font-medium">Contact No.:</label>
                <input type="text" id="contact_no" name="contact_no" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->contact_no }}">
            </div>

            <div>
                <label for="facebook" class="block text-gray-700 font-medium">Facebook:</label>
                <input type="text" id="facebook" name="facebook" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->facebook }}">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Email:</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->email }}">
            </div>

            <div>
                <label for="apartment_name" class="block text-gray-700 font-medium">Apartment Name:</label>
                <input type="text" id="apartment_name" name="apartment_name" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->apartment_name }}">
            </div>

            <div>
                <label for="rooms_available" class="block text-gray-700 font-medium">Rooms Available:</label>
                <input type="number" id="rooms_available" name="rooms_available" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->rooms_available }}">
            </div>

            <div>
                <label for="room_rate" class="block text-gray-700 font-medium">Room Rate:</label>
                <input type="text" id="room_rate" name="room_rate" class="w-full border border-gray-300 p-2 rounded-lg" value="{{ $apartment->room_rate }}">
            </div>

            <div class="col-span-2">
                <label for="apartment_images" class="block text-gray-700 font-medium">Apartment Images:</label>
                @if($apartment->apartment_images)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mt-2" id="image-previews">
                        @foreach(json_decode($apartment->apartment_images, true) as $image)
                            <div class="relative text-center">
                                <img src="{{ asset('storage/images/apartments/' . $image) }}" alt="Current Image" class="w-full h-24 object-cover mb-2 cursor-pointer" onclick="openImageModal('{{ asset('storage/images/apartments/' . $image) }}')">
                                <button type="button" class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded-full text-xs hover:bg-red-600" onclick="deleteImage('{{ $image }}')">×</button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <input type="file" id="apartment_images" name="apartment_images[]" class="w-full border border-gray-300 p-2 rounded-lg mt-2" multiple>
            </div>

            <input type="hidden" id="deleted_images" name="deleted_images" value="">

            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 font-medium">Other Description:</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 p-2 rounded-lg">{{ $apartment->description }}</textarea>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Update Apartment
            </button>
        </div>
    </form>
</div>

<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4">
    <div class="bg-white p-4 rounded-lg max-w-3xl max-h-full overflow-auto">
        <img id="modalImage" src="" alt="Enlarged Image" class="w-full h-auto">
        <button type="button" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="closeImageModal()">Close</button>
    </div>
</div>

<script>
    function openImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    function deleteImage(imageName) {
        if (confirm('Are you sure you want to delete this image?')) {
            const deletedImagesInput = document.getElementById('deleted_images');
            let deletedImages = deletedImagesInput.value ? deletedImagesInput.value.split(',') : [];
            deletedImages.push(imageName);
            deletedImagesInput.value = deletedImages.join(',');
            document.querySelector(`img[src*='${imageName}']`).closest('.relative').remove();
        }
    }
</script>
@endsection
