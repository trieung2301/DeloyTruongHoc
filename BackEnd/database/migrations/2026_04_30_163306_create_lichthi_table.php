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
        Schema::create('lichthi', function (Blueprint $table) {
            $table->integer('LichThiID', true);
            $table->integer('LopHocPhanID')->index('lophocphanid');
            $table->date('NgayThi');
            $table->time('GioBatDau');
            $table->time('GioKetThuc');
            $table->string('PhongThi', 50)->nullable();
            $table->enum('HinhThucThi', ['TracNghiem', 'TuLuan', 'ThucHanh', 'TongHop'])->nullable()->default('TracNghiem');
            $table->string('GhiChu')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichthi');
    }
};
