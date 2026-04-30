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
        Schema::create('dangkyhocphan', function (Blueprint $table) {
            $table->integer('DangKyID', true);
            $table->integer('SinhVienID')->nullable();
            $table->integer('LopHocPhanID')->nullable()->index('lophocphanid');
            $table->dateTime('ThoiGianDangKy')->nullable()->useCurrent();
            $table->string('TrangThai', 50)->nullable();

            $table->unique(['SinhVienID', 'LopHocPhanID'], 'sinhvienid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dangkyhocphan');
    }
};
