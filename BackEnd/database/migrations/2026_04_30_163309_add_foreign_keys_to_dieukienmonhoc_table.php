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
        Schema::table('dieukienmonhoc', function (Blueprint $table) {
            $table->foreign(['MonHocID'], 'dieukienmonhoc_ibfk_1')->references(['MonHocID'])->on('monhoc')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['MonTienQuyetID'], 'dieukienmonhoc_ibfk_2')->references(['MonHocID'])->on('monhoc')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dieukienmonhoc', function (Blueprint $table) {
            $table->dropForeign('dieukienmonhoc_ibfk_1');
            $table->dropForeign('dieukienmonhoc_ibfk_2');
        });
    }
};
