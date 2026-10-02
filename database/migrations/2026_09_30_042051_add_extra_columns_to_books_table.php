<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('isbn')->nullable()->after('author');
            $table->string('publisher')->nullable()->after('isbn');
            $table->string('rack')->nullable()->after('stock');
            $table->decimal('rating', 3, 2)->default(0)->after('rack');
            $table->integer('rating_count')->default(0)->after('rating');
            $table->text('description')->nullable()->after('rating_count');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['isbn', 'publisher', 'rack', 'rating', 'rating_count', 'description']);
        });
    }
};