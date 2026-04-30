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
        Schema::table('monhoc_songhanh', function (Blueprint $table) {
            $table->foreign(['MonHocID'], 'monhoc_songhanh_ibfk_1')->references(['MonHocID'])->on('monhoc')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['MonSongHanhID'], 'monhoc_songhanh_ibfk_2')->references(['MonHocID'])->on('monhoc')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monhoc_songhanh', function (Blueprint $table) {
            $table->dropForeign('monhoc_songhanh_ibfk_1');
            $table->dropForeign('monhoc_songhanh_ibfk_2');
        });
    }
};
