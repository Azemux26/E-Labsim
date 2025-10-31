<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        
        User::create([
            'name' => 'Admin e-LABSIM',
            'email' => 'simulatorpolimarim@gmail.com',
            'password' => Hash::make('haloadminsimulator'),
            'no_whatsapp' => '',
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Admin user created successfully!');
    }
}
