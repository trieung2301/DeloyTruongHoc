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
        Schema::create('lophocphan', function (Blueprint $table) {
            $table->integer('LopHocPhanID', true);
            $table->integer('MonHocID')->nullable()->index('monhocid');
            $table->integer('HocKyID')->nullable()->index('hockyid');
            $table->integer('GiangVienID')->nullable()->index('giangvienid');
            $table->string('MaLopHP', 50)->nullable()->unique('malophp');
            $table->integer('SoLuongToiDa')->nullable();
            $table->string('KhoahocAllowed')->nullable();
            $table->date('NgayBatDau')->nullable();
            $table->date('NgayKetThuc')->nullable();
            $table->tinyInteger('TrangThaiNhapDiem')->nullable()->default(0)->comment('0: Mo, 1: Khoa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lophocphan');
    }
};
