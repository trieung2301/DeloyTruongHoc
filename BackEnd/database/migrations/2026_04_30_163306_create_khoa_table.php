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
        Schema::create('khoa', function (Blueprint $table) {
            $table->integer('KhoaID', true);
            $table->string('MaKhoa', 20)->unique('makhoa');
            $table->string('TenKhoa', 100);
            $table->string('DienThoai', 20)->nullable();
            $table->string('Email', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khoa');
    }
};
