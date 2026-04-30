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
        Schema::create('lopsinhhoat', function (Blueprint $table) {
            $table->integer('LopSinhHoatID', true);
            $table->string('MaLop', 20)->unique('malop');
            $table->string('TenLop', 100)->nullable();
            $table->integer('KhoaID')->index('khoaid');
            $table->integer('GiangVienID')->nullable();
            $table->integer('NamNhapHoc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lopsinhhoat');
    }
};
