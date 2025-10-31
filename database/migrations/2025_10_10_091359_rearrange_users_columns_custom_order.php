<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom yang mau dipindahkan
            $table->dropColumn(['password', 'no_whatsapp', 'role']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali dengan urutan custom
            $table->string('password')
                  ->after('name');  // ← SETELAH name
            
            $table->string('no_whatsapp')
                  ->nullable()
                  ->after('password');  // ← SETELAH password
                  
            $table->enum('role', ['admin', 'pengajar', 'ka.lab'])
                  ->default('pengajar')
                  ->nullable(false)
                  ->after('no_whatsapp');  // ← SETELAH no_whatsapp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['password', 'no_whatsapp', 'role']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke urutan default Laravel
            $table->string('password')
                  ->after('email');
                  
            $table->string('no_whatsapp')
                  ->nullable()
                  ->after('email_verified_at');
                  
            $table->enum('role', ['admin', 'pengajar', 'ka.lab'])
                  ->default('pengajar')
                  ->nullable(false)
                  ->after('updated_at');
        });
    }
};
