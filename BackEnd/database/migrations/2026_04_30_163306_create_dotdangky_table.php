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
        Schema::create('dotdangky', function (Blueprint $table) {
            $table->integer('DotDangKyID', true);
            $table->integer('HocKyID')->index('hockyid');
            $table->string('TenDot', 100);
            $table->dateTime('NgayBatDau');
            $table->dateTime('NgayKetThuc');
            $table->tinyInteger('TrangThai')->nullable()->default(1);
            $table->string('DoiTuong')->nullable();
            $table->text('GhiChu')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dotdangky');
    }
};
