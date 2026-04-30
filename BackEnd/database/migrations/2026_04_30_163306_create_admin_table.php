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
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('AdminID', true);
            $table->integer('UserID')->nullable()->unique('userid');
            $table->string('HoTen', 100);
            $table->string('Email')->nullable()->unique('email');
            $table->string('SoDienThoai', 15)->nullable()->unique('sodienthoai');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
