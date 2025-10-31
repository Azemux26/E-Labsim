<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Administrator', 
                'description' => 'Full access ke semua fitur'
            ],
            [
                'name' => 'pengajar',
                'display_name' => 'Pengajar',
                'description' => 'Buat dan lihat jadwal sendiri'
            ],
            [
                'name' => 'ka.lab', 
                'display_name' => 'Kepala Laboratorium',
                'description' => 'Buat dan lihat jadwal sendiri'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
