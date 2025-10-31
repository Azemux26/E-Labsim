<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LabSimulator;
use App\Models\LabSchedule;
use App\Models\Role;
use App\Models\LabNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Creating ALL test data for e-LABSIM...');

        // ==================== LABS/SIMULATORS ====================
        $this->command->info('1. Creating labs & simulators...');
        
        $labs = [
            ['name' => 'Lab Komputer 1', 'type' => 'lab'],
            ['name' => 'Lab Komputer 2', 'type' => 'lab'],
            ['name' => 'Lab Jaringan', 'type' => 'lab'],
            ['name' => 'Lab Multimedia', 'type' => 'lab'],
            ['name' => 'Simulator Pesawat', 'type' => 'simulator'],
            ['name' => 'Simulator Kapal', 'type' => 'simulator'],
            ['name' => 'Simulator Kendaraan', 'type' => 'simulator'],
        ];

        foreach ($labs as $lab) {
            LabSimulator::create($lab);
        }
        $this->command->info('   ✅ 7 Labs & simulators created');

        // ==================== USERS ====================
        $this->command->info('2. Creating users...');

        $adminRole = Role::where('name', 'admin')->first();
        $pengajarRole = Role::where('name', 'pengajar')->first();
        $kalabRole = Role::where('name', 'ka.lab')->first();


        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@elabsim.com',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
            'no_whatsapp' => '081234567890'
        ]);

        $pengajar1 = User::create([
            'name' => 'Dr. Budi Santoso, M.Kom',
            'email' => 'budi@elabsim.com',
            'password' => Hash::make('pengajar123'),
            'role_id' => $pengajarRole->id,
            'no_whatsapp' => '081234567891'
        ]);

        $pengajar2 = User::create([
            'name' => 'Dian Permata, S.T., M.T.',
            'email' => 'dian@elabsim.com',
            'password' => Hash::make('pengajar123'),
            'role_id' => $pengajarRole->id,
            'no_whatsapp' => '081234567892'
        ]);

        $kalab1 = User::create([
            'name' => 'Ir. Sari Indah, M.T.',
            'email' => 'sari@elabsim.com',
            'password' => Hash::make('kalab123'),
            'role_id' => $kalabRole->id,
            'no_whatsapp' => '081234567893'
        ]);

        $kalab2 = User::create([
            'name' => 'Ahmad Fauzi, S.Kom',
            'email' => 'ahmad@elabsim.com',
            'password' => Hash::make('kalab123'),
            'role_id' => $kalabRole->id,
            'no_whatsapp' => '081234567894'
        ]);

        $this->command->info('   ✅ Users created: 1 admin, 2 pengajar, 2 ka.lab');

        // ==================== SCHEDULES ====================
        $this->command->info('3. Creating schedules...');

        $schedule1 = LabSchedule::create([
            'lab_simulator_id' => 1, // Lab Komputer 1
            'pengajar_id' => $pengajar1->id,
            'tanggal' => now()->addDays(2)->format('Y-m-d'),
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'jenis_kegiatan' => 'Praktikum Pemrograman Web',
            'detail_materi' => 'Praktikum dasar-dasar PHP, HTML, CSS dan JavaScript untuk pembuatan website',
            'jumlah_peserta' => 25,
            'status_verifikasi' => 'Belum Disetujui',
            'created_by' => $pengajar1->id
        ]);

        $schedule2 = LabSchedule::create([
            'lab_simulator_id' => 2, // Lab Komputer 2
            'kalab_id' => $kalab1->id,
            'tanggal' => now()->addDays(3)->format('Y-m-d'),
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'jenis_kegiatan' => 'Workshop Jaringan Komputer',
            'detail_materi' => 'Workshop konfigurasi router, switch dan troubleshooting jaringan LAN',
            'jumlah_peserta' => 20,
            'status_verifikasi' => 'Disetujui',
            'created_by' => $kalab1->id
        ]);

        $schedule3 = LabSchedule::create([
            'lab_simulator_id' => 5, // Simulator Pesawat
            'pengajar_id' => $pengajar2->id,
            'tanggal' => now()->addDays(5)->format('Y-m-d'),
            'jam_mulai' => '09:00',
            'jam_selesai' => '12:00',
            'jenis_kegiatan' => 'Simulasi Penerbangan',
            'detail_materi' => 'Latihan simulasi take-off, cruising dan landing untuk mahasiswa penerbangan',
            'jumlah_peserta' => 15,
            'status_verifikasi' => 'Belum Disetujui',
            'created_by' => $pengajar2->id
        ]);

        $this->command->info('   ✅ Schedules created: 3 sample schedules');

        // ==================== NOTIFICATIONS ====================
        $this->command->info('4. Creating notifications...');

        LabNotification::create([
            'user_id' => $pengajar2->id,
            'schedule_id' => $schedule3->id,
            'message' => 'Jadwal Simulasi Penerbangan Anda sedang menunggu persetujuan admin',
            'status' => 'terkirim'
        ]);

        LabNotification::create([
            'user_id' => $kalab1->id,
            'schedule_id' => $schedule2->id,
            'message' => 'Jadwal Workshop Jaringan Komputer Anda telah disetujui',
            'status' => 'terkirim'
        ]);

        $this->command->info('   ✅ Notifications created: 2 sample notifications');

        $this->command->info('🎉 All test data created successfully!');
        $this->command->info('');
        $this->command->info('📋 LOGIN CREDENTIALS:');
        $this->command->info('   Admin: admin@elabsim.com / admin123');
        $this->command->info('   Pengajar: budi@elabsim.com / pengajar123'); 
        $this->command->info('   Ka.Lab: sari@elabsim.com / kalab123');
    }
}