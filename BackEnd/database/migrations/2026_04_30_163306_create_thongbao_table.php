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
        Schema::create('thongbao', function (Blueprint $table) {
            $table->integer('ThongBaoID', true);
            $table->string('TieuDe');
            $table->text('NoiDung');
            $table->string('LoaiThongBao')->nullable();
            $table->integer('NguoiGuiID')->nullable()->index('nguoiguiid');
            $table->string('DoiTuong', 100)->nullable()->default('TatCa');
            $table->date('NgayBatDauHienThi')->nullable();
            $table->date('NgayKetThucHienThi')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thongbao');
    }
};
