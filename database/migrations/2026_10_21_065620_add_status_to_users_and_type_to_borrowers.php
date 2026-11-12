<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('aktif')->after('role');
            // nilai: 'aktif', 'pending', 'suspended'
        });

        Schema::table('borrowers', function (Blueprint $table) {
            // type sudah ada, pastikan punya default
            $table->string('type')->default('siswa')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
