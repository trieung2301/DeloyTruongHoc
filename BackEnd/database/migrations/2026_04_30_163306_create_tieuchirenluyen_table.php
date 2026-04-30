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
        Schema::create('tieuchirenluyen', function (Blueprint $table) {
            $table->integer('TieuChiID', true);
            $table->string('TenTieuChi');
            $table->integer('DiemToiDa');
            $table->integer('ThuTu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tieuchirenluyen');
    }
};
