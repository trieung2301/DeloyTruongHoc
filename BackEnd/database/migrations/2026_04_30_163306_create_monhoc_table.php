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
        Schema::create('monhoc', function (Blueprint $table) {
            $table->integer('MonHocID', true);
            $table->string('MaMon', 20)->unique('mamon');
            $table->string('TenMon', 100);
            $table->integer('SoTinChi');
            $table->integer('TietLyThuyet')->nullable();
            $table->integer('TietThucHanh')->nullable();
            $table->integer('KhoaID')->index('khoaid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monhoc');
    }
};
