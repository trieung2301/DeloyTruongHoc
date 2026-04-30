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
        Schema::table('hocphi', function (Blueprint $table) {
            $table->foreign(['SinhVienID'], 'hocphi_ibfk_1')->references(['SinhVienID'])->on('sinhvien')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['HocKyID'], 'hocphi_ibfk_2')->references(['HocKyID'])->on('hocky')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hocphi', function (Blueprint $table) {
            $table->dropForeign('hocphi_ibfk_1');
            $table->dropForeign('hocphi_ibfk_2');
        });
    }
};
