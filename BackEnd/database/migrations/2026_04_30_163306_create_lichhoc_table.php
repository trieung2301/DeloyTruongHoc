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
        Schema::create('lichhoc', function (Blueprint $table) {
            $table->integer('LichHocID', true);
            $table->integer('LopHocPhanID')->index('lophocphanid');
            $table->date('NgayHoc');
            $table->string('BuoiHoc', 30);
            $table->tinyInteger('TietBatDau');
            $table->tinyInteger('SoTiet')->default(3);
            $table->string('PhongHoc', 50)->nullable();
            $table->string('GhiChu')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();

            $table->index(['NgayHoc', 'BuoiHoc'], 'idx_ngay_buoi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichhoc');
    }
};
