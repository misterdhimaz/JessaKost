<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->nullable();
            $table->string('campus')->nullable();
            $table->text('origin_address')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->timestamp('paid_at')->nullable()->after('status');
            $table->string('billing_period')->nullable()->after('amount'); // e.g., '2026-09'
        });

        Schema::table('guest_logs', function (Blueprint $table) {
            $table->string('id_card_photo_path', 2048)->nullable()->after('purpose');
            $table->boolean('is_overnight')->default(false)->after('id_card_photo_path');
        });
    }

    public function down(): void
    {
        Schema::table('guest_logs', function (Blueprint $table) {
            $table->dropColumn(['id_card_photo_path', 'is_overnight']);
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['paid_at', 'billing_period']);
        });

        Schema::dropIfExists('tenant_profiles');
    }
};
