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
        Schema::create('chitietdiemrenluyen', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('DiemRenLuyenID');
            $table->integer('TieuChiID')->index('tieuchiid');
            $table->integer('DiemDatDuoc')->nullable();

            $table->unique(['DiemRenLuyenID', 'TieuChiID'], 'diemrenluyenid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdiemrenluyen');
    }
};
