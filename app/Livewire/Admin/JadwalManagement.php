<?php

namespace App\Livewire\Admin;

use App\Models\LabSchedule;
use App\Models\User;
use App\Services\WablasServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class JadwalManagement extends Component
{
    use WithPagination;

    public function mount()
    {
        if (!Auth::check()) {
            abort(403, 'Please login to access this page.');
        }

        $user = User::with('role')->find(Auth::id());

        if (!$user || !$user->role || $user->role->name !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }
    }

    public function approve($scheduleId)
    {
        $schedule = LabSchedule::find($scheduleId);
        if (!$schedule) return;

        $schedule->update(['status_verifikasi' => 'Disetujui']);

        $wablas = new WablasServices();

        // Ambil nama pengajar atau ka.lab sesuai kebutuhan
        $namaPengajar = $schedule->pengajar ? $schedule->pengajar->name : 'Pengajar';
        $namaKalab   = $schedule->kalab ? $schedule->kalab->name : 'Ka.Lab';

        $pesan = "📢 *Notifikasi e-LABSIM*\n\n" .
            "Jadwal pada tanggal *" . $schedule->tanggal->format('d/m/Y') . "* " .
            "di *" . ($schedule->labSimulator->name ?? 'Lab/Simulator') . "* telah *disetujui* oleh Admin.\n\n" .
            "Pengajar / Ka.Lab: " . $namaPengajar . "\n" .
            "Jenis kegiatan: " . $schedule->jenis_kegiatan . "\n" .
            "Waktu: " . $schedule->jam_mulai . " - " . $schedule->jam_selesai;

        // Gabungkan nomor WA unik supaya tidak double
        $uniqueUsers = collect([$schedule->pengajar, $schedule->kalab])
            ->unique('id')
            ->filter(); // buang null

        foreach ($uniqueUsers as $user) {
            $this->sendNotification($user, $pesan, $wablas);
        }

        $this->js("
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Jadwal berhasil disetujui dan notifikasi dikirim.',
            timer: 2000,
            showConfirmButton: false
        });
    ");
    }
    public function reject($scheduleId)
    {
        $schedule = LabSchedule::find($scheduleId);
        if (!$schedule) return;

        $schedule->update(['status_verifikasi' => 'Belum Disetujui']);

        $wablas = new WablasServices();

        // Ambil nama pengajar atau ka.lab sesuai kebutuhan
        $namaPengajar = $schedule->pengajar ? $schedule->pengajar->name : 'Pengajar';
        $namaKalab   = $schedule->kalab ? $schedule->kalab->name : 'Ka.Lab';

        $pesan = "📢 *Notifikasi e-LABSIM*\n\n" .
            "Jadwal pada tanggal *" . $schedule->tanggal->format('d/m/Y') . "* " .
            "telah *ditolak* oleh Admin.\n\n" .
            "Pengajar / Ka.Lab: " . $namaPengajar . "\n" .
            "Silakan lakukan revisi jadwal jika diperlukan.";

        // Gabungkan nomor WA unik supaya tidak double
        $uniqueUsers = collect([$schedule->pengajar, $schedule->kalab])
            ->unique('id')
            ->filter(); // buang null

        foreach ($uniqueUsers as $user) {
            $this->sendNotification($user, $pesan, $wablas);
        }

        $this->js("
        Swal.fire({
            icon: 'info',
            title: 'Status Diubah!',
            text: 'Jadwal ditolak dan notifikasi dikirim.',
            timer: 2000,
            showConfirmButton: false
        });
    ");
    }


    /**
     * Helper kirim WA tanpa simpan ke database
     */
    private function sendNotification($user, $message, WablasServices $wablas)
    {
        if (!$user || !$user->no_whatsapp) return;

        // Pastikan nomor WA format internasional
        $phone = preg_replace('/^0/', '62', $user->no_whatsapp);

        // Kirim pesan
        $wablas->sendMessage($phone, $message);
    }

    public function render()
    {
        $schedules = LabSchedule::with(['labSimulator', 'pengajar', 'kalab'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.jadwal-management', compact('schedules'));
    }
}
