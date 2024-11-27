<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Landlord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function overview() {
        return view('admin.auth.overview');
    }

    public function userManagement() {
        // Fetch all landlords
        $landlords = Landlord::select('id', 'name', 'email', 'created_at')->get();

        return view('admin.auth.user-management', compact('landlords'));
    }

    public function edit($id)
    {
        $user = Landlord::findOrFail($id);
        return view('admin.auth.edit-user', compact('user'));
    }

    public function destroy($id)
    {
        $user = Landlord::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user_management')->with('success', 'User deleted successfully.');
    }

}
