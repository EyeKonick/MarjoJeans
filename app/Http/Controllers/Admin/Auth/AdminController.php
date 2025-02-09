<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Landlord;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function overview()
    {
        return view('admin.auth.overview');
    }

    public function userManagement()
    {
        $landlordsQuery = Landlord::select('id', 'name', 'email', 'created_at');
        if (request()->has('landlords_search')) {
            $search = request()->input('landlords_search');
            $landlordsQuery->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
        }
        $landlords = $landlordsQuery->get()->map(function ($landlord) {
            $landlord->role = 'Landlord';
            return $landlord;
        });

        $usersQuery = User::select('id', 'name', 'email', 'created_at');
        if (request()->has('users_search')) {
            $search = request()->input('users_search');
            $usersQuery->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
        }
        $users = $usersQuery->get()->map(function ($user) {
            $user->role = 'User';
            return $user;
        });

        $landlordPerPage = 5;
        $landlordCurrentPage = request()->input('landlords_page', 1);
        $landlordPagedData = $landlords->slice(($landlordCurrentPage - 1) * $landlordPerPage, $landlordPerPage)->values();
        $paginatedLandlords = new \Illuminate\Pagination\LengthAwarePaginator(
            $landlordPagedData,
            $landlords->count(),
            $landlordPerPage,
            $landlordCurrentPage,
            ['path' => request()->url(), 'pageName' => 'landlords_page']
        );

        $userPerPage = 5;
        $userCurrentPage = request()->input('users_page', 1);
        $userPagedData = $users->slice(($userCurrentPage - 1) * $userPerPage, $userPerPage)->values();
        $paginatedUsers = new \Illuminate\Pagination\LengthAwarePaginator(
            $userPagedData,
            $users->count(),
            $userPerPage,
            $userCurrentPage,
            ['path' => request()->url(), 'pageName' => 'users_page']
        );

        return view('admin.auth.user-management', compact('paginatedLandlords', 'paginatedUsers'));
    }

    public function edit($id, $type)
    {
        $user = $type === 'landlord' ? Landlord::findOrFail($id) : User::findOrFail($id);
        return view('admin.auth.edit-user', compact('user', 'type'));
    }

    public function update(Request $request, $id, $type)
    {
        $user = $type === 'landlord' ? Landlord::findOrFail($id) : User::findOrFail($id);
        $emailRule = 'unique:' . ($type === 'landlord' ? 'landlords' : 'users') . ',email,' . $id;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|' . $emailRule,
            'password' => 'nullable|string|min:8',
            'contact' => 'nullable|string|max:15',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);
        return redirect()->route('admin.user_management')->with('success', ucfirst($type) . ' updated successfully!');
    }

    public function destroy($id, $type)
    {
        $user = $type === 'landlord' ? Landlord::findOrFail($id) : User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user_management')->with('success', ucfirst($type) . ' deleted successfully.');
    }
}
