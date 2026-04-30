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
        Schema::table('chuongtrinhdaotao', function (Blueprint $table) {
            $table->foreign(['NganhID'], 'chuongtrinhdaotao_ibfk_1')->references(['NganhID'])->on('nganhdaotao')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['MonHocID'], 'chuongtrinhdaotao_ibfk_2')->references(['MonHocID'])->on('monhoc')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chuongtrinhdaotao', function (Blueprint $table) {
            $table->dropForeign('chuongtrinhdaotao_ibfk_1');
            $table->dropForeign('chuongtrinhdaotao_ibfk_2');
        });
    }
};
