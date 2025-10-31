<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Livewire\Admin\JadwalManagement;
use App\Livewire\Admin\LabManagement;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Jadwal\CreateJadwal;
use App\Livewire\Jadwal\JadwalIndex;
use App\Livewire\Admin\ScheduleManager;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

        // ✅ ADMIN ROUTES - SEKARANG SUDAH PAKAI AUTH + VERIFIED
    Route::get('admin/users', UserManagement::class)->name('admin.users');
    Route::get('admin/jadwal', JadwalManagement::class)->name('admin.jadwal');
    Route::get('admin/labs', LabManagement::class)->name('admin.labs');
    Route::get('admin/export-data', ScheduleManager::class)->name('admin.export-data');
    
    // ✅ JADWAL ROUTES
    Route::get('jadwal/create', CreateJadwal::class)->name('jadwal.create');
    Route::get('jadwal', JadwalIndex::class)->name('jadwal.index');
        
});

require __DIR__.'/auth.php';
