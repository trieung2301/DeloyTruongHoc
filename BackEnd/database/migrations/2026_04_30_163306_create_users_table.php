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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('UserID', true);
            $table->string('Username', 50)->unique('username');
            $table->string('PasswordHash');
            $table->string('Email', 100)->nullable()->unique('email');
            $table->integer('RoleID')->index('roleid');
            $table->boolean('is_active')->default(false);
            $table->dateTime('CreatedAt')->nullable()->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
