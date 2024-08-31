<!-- resources/views/admin/auth/overview.blade.php -->
@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Overview</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Listings -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Total Listings</h3>
            <p class="text-3xl font-bold text-gray-900">120</p>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Pending Approvals</h3>
            <p class="text-3xl font-bold text-gray-900">15</p>
        </div>

        <!-- Active Listings -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Active Listings</h3>
            <p class="text-3xl font-bold text-gray-900">105</p>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
        <ul class="space-y-4">
            <li class="flex items-start">
                <svg class="h-6 w-6 text-green-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 4a1 1 0 011 1v2a1 1 0 01-2 0V5a1 1 0 011-1zm-1 6a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1zm-3 2a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1zm10-6a1 1 0 011 1v2a1 1 0 01-2 0V5a1 1 0 011-1zm-3 6a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                <div>
                    <p class="text-gray-900">New listing added: Sunny Villa</p>
                    <p class="text-sm text-gray-500">2 hours ago</p>
                </div>
            </li>
            <li class="flex items-start">
                <svg class="h-6 w-6 text-blue-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.9 6.4L8 2l4.1 4.4L8 10.8 3.9 6.4zM11 8.6l1.6-1.6L17.4 10l-4.8 4.8L11 8.6zm6.4 0l1.6-1.6L19.4 10l-1.6 1.6L17.4 10zM2 11l4.1-4.1L10 8.6 2 16.6 2 11z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                <div>
                    <p class="text-gray-900">Pending approval for: Cozy Cottage</p>
                    <p class="text-sm text-gray-500">5 hours ago</p>
                </div>
            </li>
            <li class="flex items-start">
                <svg class="h-6 w-6 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14 4a2 2 0 00-2 2v12a2 2 0 004 0V6a2 2 0 00-2-2zm-4 0a2 2 0 00-2 2v12a2 2 0 004 0V6a2 2 0 00-2-2zM2 4a2 2 0 00-2 2v12a2 2 0 004 0V6a2 2 0 00-2-2z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                <div>
                    <p class="text-gray-900">Listing removed: Old Townhouse</p>
                    <p class="text-sm text-gray-500">1 day ago</p>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
