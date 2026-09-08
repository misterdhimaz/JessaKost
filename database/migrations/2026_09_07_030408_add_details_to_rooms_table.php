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
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('cover_image_path', 2048)->nullable()->after('status');
            $table->json('detail_image_paths')->nullable()->after('cover_image_path');
            $table->text('description')->nullable()->after('detail_image_paths');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['cover_image_path', 'detail_image_paths', 'description']);
        });
    }
};
