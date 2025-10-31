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
            // 1. Hapus kolom yang mau dipindahkan
            $table->dropColumn(['role', 'no_whatsapp']);
        });

        Schema::table('users', function (Blueprint $table) {
            // 2. Tambahkan kembali dengan urutan yang benar
            $table->enum('role', ['admin', 'pengajar', 'ka.lab'])
                  ->default('pengajar')
                  ->nullable(false)
                  ->after('password');  // ← SETELAH password
            
            $table->string('no_whatsapp')
                  ->nullable()
                  ->after('role');      // ← SETELAH role
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'no_whatsapp']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke urutan semula (jika rollback)
            $table->enum('role', ['admin', 'pengajar', 'ka.lab'])
                  ->default('pengajar')
                  ->nullable(false)
                  ->after('email');
            
            $table->string('no_whatsapp')
                  ->nullable()
                  ->after('role');
        });
    }
};
