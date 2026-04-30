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
        Schema::table('lophocphan', function (Blueprint $table) {
            $table->foreign(['MonHocID'], 'lophocphan_ibfk_1')->references(['MonHocID'])->on('monhoc')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['HocKyID'], 'lophocphan_ibfk_2')->references(['HocKyID'])->on('hocky')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['GiangVienID'], 'lophocphan_ibfk_3')->references(['GiangVienID'])->on('giangvien')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lophocphan', function (Blueprint $table) {
            $table->dropForeign('lophocphan_ibfk_1');
            $table->dropForeign('lophocphan_ibfk_2');
            $table->dropForeign('lophocphan_ibfk_3');
        });
    }
};
