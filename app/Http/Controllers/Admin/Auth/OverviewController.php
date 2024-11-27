<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OverviewController extends Controller
{
    public function index()
    {
        // Fetch counts
        $totalListings = Apartment::count();
        $pendingApprovals = Apartment::where('status', 'pending')->count();
        $activeListings = Apartment::where('status', 'approved')->count();

        // Fetch recent activities
        $recentActivities = Apartment::latest()->take(5)->get();

        return view('admin.auth.overview', compact(
            'totalListings',
            'pendingApprovals',
            'activeListings',
            'recentActivities'
        ));
    }
}

