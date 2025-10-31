<?php
// app/Livewire/Auth/Register.php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $no_whatsapp = '';
    public ?int $role_id = null;

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'no_whatsapp' => 'required|string|max:15',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // ✅ BUAT USER TANPA AUTO LOGIN
        $user = User::create($validated);
        event(new Registered($user));

        // ✅ SWEETALERT SUCCESS + AUTO REDIRECT
        $this->js("
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil! 🎉',
                text: 'Akun Anda telah dibuat. Mengarahkan ke halaman login...',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                willClose: () => {
                    window.location.href = '" . route('login') . "';
                }
            });
        ");
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'roles' => Role::where('name', '!=', 'admin')->get()
        ]);
    }
}