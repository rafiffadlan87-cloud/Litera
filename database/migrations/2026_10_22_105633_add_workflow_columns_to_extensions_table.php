<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('extensions', function (Blueprint $table) {
            if (!Schema::hasColumn('extensions', 'additional_days')) {
                $table->integer('additional_days')->default(7);
            }
            if (!Schema::hasColumn('extensions', 'status')) {
                $table->string('status')->default('menunggu');
            }
            if (!Schema::hasColumn('extensions', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('extensions', function (Blueprint $table) {
            $table->dropColumn(['additional_days', 'status', 'approved_by']);
        });
    }
};
