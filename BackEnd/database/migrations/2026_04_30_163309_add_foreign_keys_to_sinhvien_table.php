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
        Schema::table('sinhvien', function (Blueprint $table) {
            $table->foreign(['UserID'], 'sinhvien_ibfk_1')->references(['UserID'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['KhoaID'], 'sinhvien_ibfk_2')->references(['KhoaID'])->on('khoa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['NganhID'], 'sinhvien_ibfk_3')->references(['NganhID'])->on('nganhdaotao')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['LopSinhHoatID'], 'sinhvien_ibfk_4')->references(['LopSinhHoatID'])->on('lopsinhhoat')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sinhvien', function (Blueprint $table) {
            $table->dropForeign('sinhvien_ibfk_1');
            $table->dropForeign('sinhvien_ibfk_2');
            $table->dropForeign('sinhvien_ibfk_3');
            $table->dropForeign('sinhvien_ibfk_4');
        });
    }
};
