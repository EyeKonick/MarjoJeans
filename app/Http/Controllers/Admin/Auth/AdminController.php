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
        $landlord = Landlord::findOrFail($id);
        return view('admin.auth.edit-user', compact('landlord'));
    }

    public function destroy($id)
    {
        $user = Landlord::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user_management')->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $landlord = Landlord::findOrFail($id);


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:landlords,email,' . $id,
            'contact' => 'nullable|string|max:15',
        ]);


        $landlord->update($validatedData);
        return redirect()->route('admin.user_management')->with('success', 'Landlord updated successfully!');
    }


}
