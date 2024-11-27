<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">{{ $apartment->apartment_name }}</h2>

            {{-- Carousel for all uploaded images --}}
            <div class="relative overflow-hidden mb-6">
                {{-- Carousel container --}}
                <div class="carousel-images flex transition-transform duration-700 ease-in-out" data-interval="3000">
                    @foreach ($apartment->apartment_images as $image)
                        <div class="w-full flex-shrink-0">
                            <img src="{{ asset('storage/images/apartments/' . $image) }}" class="w-full h-96 object-contain rounded-lg" alt="Apartment Image">
                        </div>
                    @endforeach
                </div>

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
            const offset = -idx * 100; // Calculate translateX offset
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            index = (index + 1) % totalSlides; // Cycle to next
            showSlide(index);
        }

        function prevSlide() {
            index = (index - 1 + totalSlides) % totalSlides; // Cycle to previous
            showSlide(index);
        }

        // Event listeners for buttons
        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);

        // Auto slide
        let autoSlide = setInterval(nextSlide, intervalTime);

        // Pause auto-slide on hover
        carousel.addEventListener('mouseenter', () => clearInterval(autoSlide));
        carousel.addEventListener('mouseleave', () => autoSlide = setInterval(nextSlide, intervalTime));
    </script>
</x-app-layout>
