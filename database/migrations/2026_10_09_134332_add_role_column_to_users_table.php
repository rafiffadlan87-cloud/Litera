<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Tambahkan kolom role HANYA jika belum ada (aman dijalankan kapan saja)
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('siswa');
            });

            // Perbaiki role akun bawaan seeder
            DB::table('users')->where('email', 'admin@litera.id')->update(['role' => 'admin']);
            DB::table('users')->where('email', 'petugas@litera.id')->update(['role' => 'petugas']);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
