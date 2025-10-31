<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class UserManagement extends Component
{
    use WithPagination;

    public function mount()
    {
        // ✅ APPROACH YANG LEBIH AMAN
        if (!Auth::check()) {
            abort(403, 'Please login to access this page.');
        }

        // Load user dengan role dari database
        $user = User::with('role')->find(Auth::id());
        
        if (!$user || !$user->role) {
            abort(403, 'User role not found.');
        }

        if ($user->role->name !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }
    }

    public function render()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('livewire.admin.user-management', compact('users'));
    }
}