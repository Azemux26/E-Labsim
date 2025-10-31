<?php

namespace App\Livewire\Jadwal;

use App\Models\LabSchedule;
use App\Models\LabSimulator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
class CreateJadwal extends Component
{
    // ==================== FORM FIELDS ====================
    #[Validate('required|exists:lab_simulators,id')]
    public $lab_simulator_id;

    #[Validate('required|date|after_or_equal:today')]
    public $tanggal;

    #[Validate('required|date_format:H:i')]
    public $jam_mulai;

    #[Validate('required|date_format:H:i|after:jam_mulai')]
    public $jam_selesai;

    #[Validate('nullable|exists:users,id')]
    public $pengajar_id;

    #[Validate('nullable|string|max:255')]
    public $nama_pengajar;

    #[Validate('required|string|max:255')]
    public $jenis_kegiatan;

    #[Validate('required|string')]
    public $detail_materi;

    #[Validate('required|integer|min:1')]
    public $jumlah_peserta;

    #[Validate('required|string')]
    public $no_whatsapp;

    // ==================== DATA TAMBAHAN ====================
    public $labSimulators = [];
    public $pengajarList = [];

    public function mount()
    {
        // Cek siapa yang login
        $user = Auth::user();
        if (!in_array($user->role->name, ['ka.lab', 'pengajar'])) {
            abort(403, 'Unauthorized access. Ka.Lab or Pengajar only.');
        }

        // Data dropdown Lab/Simulator
        $this->labSimulators = LabSimulator::all();

        // Ambil list pengajar (kalau dibutuhkan)
        $pengajarRole = Role::where('name', 'pengajar')->first();
        if ($pengajarRole) {
            $this->pengajarList = User::where('role_id', $pengajarRole->id)->get();
        }

        // Default nilai no_whatsapp
        $this->no_whatsapp = $user->no_whatsapp ?? '';

        // Kalau login sebagai pengajar, set otomatis
        if ($user->role->name === 'pengajar') {
            $this->pengajar_id = $user->id;
            $this->nama_pengajar = $user->name;
        }
    }

    public function save()
    {
        $this->validate();

        // Cek bentrok jadwal
        if ($this->checkScheduleConflict()) {
            $this->js("
            Swal.fire({
                icon: 'error',
                title: 'Jadwal Bentrok!',
                text: 'Lab/simulator ini sudah dipakai pada tanggal dan jam yang sama.',
                confirmButtonText: 'OK'
            });
        ");
            return;
        }

        try {
            DB::transaction(function () {
                $user = Auth::user();

                // Tentukan siapa Ka.Lab dan Pengajar
                $kalab_id = null;
                $pengajar_id = null;

                if ($user->role && $user->role->name === 'ka.lab') {
                    $kalab_id = $user->id;
                    $pengajar_id = $this->pengajar_id ?? $user->id; // kalau dia pilih dirinya sendiri
                } elseif ($user->role && $user->role->name === 'pengajar') {
                    $pengajar_id = $user->id;
                    $kalab_id = $this->kalab_id ?? null;
                }

                // Validasi data wajib
                if (empty($this->lab_simulator_id) || empty($this->tanggal) || empty($this->jam_mulai) || empty($this->jam_selesai)) {
                    throw new \Exception('Beberapa data wajib belum diisi.');
                }

                // Simpan jadwal
                LabSchedule::create([
                    'lab_simulator_id' => $this->lab_simulator_id,
                    'kalab_id' => $kalab_id,
                    'pengajar_id' => $pengajar_id,
                    'tanggal' => $this->tanggal,
                    'jam_mulai' => $this->jam_mulai,
                    'jam_selesai' => $this->jam_selesai,
                    'jenis_kegiatan' => $this->jenis_kegiatan ?? '-',
                    'detail_materi' => $this->detail_materi ?? '-',
                    'jumlah_peserta' => $this->jumlah_peserta ?? 0,
                    'status_verifikasi' => 'Belum Disetujui',
                    'created_by' => $user->id,
                ]);

                // Update WA jika berubah
                if (!empty($this->no_whatsapp) && $user->no_whatsapp !== $this->no_whatsapp) {
                    $user->update(['no_whatsapp' => $this->no_whatsapp]);
                }
            });

            // ✅ Tampilkan SweetAlert sukses langsung
            $this->js("
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil! 🎉',
                    text: 'Jadwal berhasil diajukan! Menunggu verifikasi admin.',
                    timer: 2500,
                    showConfirmButton: false
                });
            ");
        } catch (\Exception $e) {
                // ❌ SweetAlert error langsung
               $this->js("
               swall.fire({
               icon: 'error',
               title: 'Terjadi Kesalahan!,
               text: '" . addslashes($e->getMessage()) . "',
               confirmButtonText: 'OK'})");
            }
    }

    private function checkScheduleConflict()
    {
        return LabSchedule::where('lab_simulator_id', $this->lab_simulator_id)
            ->where('tanggal', $this->tanggal)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('jam_mulai', '<=', $this->jam_mulai)
                        ->where('jam_selesai', '>', $this->jam_mulai);
                })->orWhere(function ($q) {
                    $q->where('jam_mulai', '<', $this->jam_selesai)
                        ->where('jam_selesai', '>=', $this->jam_selesai);
                })->orWhere(function ($q) {
                    $q->where('jam_mulai', '>=', $this->jam_mulai)
                        ->where('jam_selesai', '<=', $this->jam_selesai);
                });
            })
            ->exists();
    }

    public function render()
    {
        return view('livewire.jadwal.create-jadwal');
    }
}
