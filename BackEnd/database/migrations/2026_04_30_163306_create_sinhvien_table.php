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
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->integer('SinhVienID', true);
            $table->integer('UserID')->unique('userid');
            $table->string('MaSV', 20)->unique('masv');
            $table->string('khoahoc', 50)->nullable()->index('idx_khoahoc');
            $table->string('HoTen', 100);
            $table->date('NgaySinh')->nullable();
            $table->integer('KhoaID')->index('khoaid');
            $table->integer('NganhID')->index('nganhid');
            $table->enum('TinhTrang', ['DangHoc', 'BaoLuu', 'TotNghiep'])->nullable()->default('DangHoc');
            $table->integer('LopSinhHoatID')->nullable()->index('lopsinhhoatid');
            $table->tinyInteger('gioitinh')->nullable();
            $table->string('email')->nullable();
            $table->string('sodienthoai', 10)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinhvien');
    }
};
