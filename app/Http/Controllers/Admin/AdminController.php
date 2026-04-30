<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_applications' => Application::count(),
            'pending_applications' => Application::where('status', 'submitted')->count(),
            'approved_applications' => Application::where('status', 'approved')->count(),
            'rejected_applications' => Application::where('status', 'rejected')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_admins' => User::whereIn('role', ['admin', 'superadmin'])->count(),
        ];

        $recentApplications = Application::latest('submission_date')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin,superadmin',
        ]);

        // Only superadmin can create superadmin
        if ($request->role === 'superadmin' && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'Only superadmin can create superadmin accounts.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Toggle user active status
     */
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'superadmin' && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You cannot modify superadmin accounts.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'User status updated successfully.');
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin,superadmin',
        ]);

        $user = User::findOrFail($id);

        // Only superadmin can create superadmin
        if ($request->role === 'superadmin' && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'Only superadmin can assign superadmin role.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'superadmin' && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You cannot delete superadmin accounts.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
