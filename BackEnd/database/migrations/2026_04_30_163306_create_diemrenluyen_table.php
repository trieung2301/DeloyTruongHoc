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
        Schema::create('diemrenluyen', function (Blueprint $table) {
            $table->integer('DiemRenLuyenID', true);
            $table->integer('SinhVienID');
            $table->integer('HocKyID')->index('hockyid');
            $table->integer('TongDiem')->nullable();
            $table->string('XepLoai', 50)->nullable();
            $table->date('NgayDanhGia')->nullable();

            $table->unique(['SinhVienID', 'HocKyID'], 'sinhvienid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diemrenluyen');
    }
};
