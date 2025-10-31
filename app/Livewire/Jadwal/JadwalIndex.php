<?php

namespace App\Livewire\Jadwal;

use App\Models\LabSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class JadwalIndex extends Component
{
    use WithPagination;

    public function mount()
    {
        $user = Auth::user();
        if (!in_array($user->role->name, ['ka.lab', 'pengajar'])) {
            abort(403, 'Unauthorized access. Ka.Lab or Pengajar only.');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $roleName = $user->role->name;

        // Gunakan relasi yang sudah ada di Model User
        if ($roleName === 'ka.lab') {
            $schedules = $user->labschedulesAsKalab()
                ->with(['labSimulator', 'pengajar'])
                ->latest()
                ->paginate(10);
        } else {
            $schedules = $user->labschedulesAsPengajar()
                ->with(['labSimulator', 'kalab'])
                ->latest()
                ->paginate(10);
        }

        return view('livewire.jadwal.jadwal-index', compact('schedules', 'roleName'));
    }
}