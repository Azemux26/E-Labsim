<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LabSimulator; // Pastikan import modelnya
use Illuminate\Support\Facades\DB;

class DataLabSimulatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('lab_simulators')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $labSimulators = [
            [
                'name' => 'Bridge Simulator',
                'type' => 'simulator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engine Simulator', 
                'type' => 'simulator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Echdis Simulator',
                'type' => 'simulator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GMDSS Simulator',
                'type' => 'simulator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Radar Arpa Simulator',
                'type' => 'simulator', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LCHS Simulator',
                'type' => 'simulator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab. Elektro',
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab. CBT',
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab. CBA',
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab. Bahari',
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab. Menjangka Peta',
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab. Fisika',
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data baru
        LabSimulator::insert($labSimulators);
    }
}