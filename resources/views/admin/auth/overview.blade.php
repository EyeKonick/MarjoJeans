@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Overview</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Total Listings</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalListings }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Pending Approvals</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $pendingApprovals }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Active Listings</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $activeListings }}</p>
        </div>
    </div>

    <!-- Two-Column Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Chart Section -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Listings Overview (Graphical)</h3>
            <canvas id="overviewChart" class="w-full"></canvas>
        </div>

        <!-- Recent Activity -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
            <ul class="space-y-4">
                @forelse ($recentActivities as $activity)
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 4a1 1 0 011 1v2a1 1 0 01-2 0V5a1 1 0 011-1zm-1 6a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1zm-3 2a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1zm10-6a1 1 0 011 1v2a1 1 0 01-2 0V5a1 1 0 011-1zm-3 6a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1z" fill-rule="evenodd" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-gray-900">
                                {{ $activity->status === 'pending' ? 'Pending approval' : ($activity->status === 'approved' ? 'Active listing' : 'Listing removed') }}:
                                {{ $activity->apartment_name }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </li>
                @empty
                    <p class="text-sm text-gray-500">No recent activities found.</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('overviewChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Use 'doughnut', 'line', etc., for other chart types
        data: {
            labels: ['Total Listings', 'Pending Approvals', 'Active Listings'],
            datasets: [{
                label: 'Apartment Data',
                data: [{{ $totalListings }}, {{ $pendingApprovals }}, {{ $activeListings }}],
                backgroundColor: ['#4A90E2', '#E94E77', '#3DBE29'],
                borderColor: ['#357ABD', '#D43F57', '#2A9223'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false // Hide the legend if not needed
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
