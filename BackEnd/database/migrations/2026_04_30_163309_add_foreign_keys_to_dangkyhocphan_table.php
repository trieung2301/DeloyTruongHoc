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
        Schema::table('dangkyhocphan', function (Blueprint $table) {
            $table->foreign(['SinhVienID'], 'dangkyhocphan_ibfk_1')->references(['SinhVienID'])->on('sinhvien')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['LopHocPhanID'], 'dangkyhocphan_ibfk_2')->references(['LopHocPhanID'])->on('lophocphan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dangkyhocphan', function (Blueprint $table) {
            $table->dropForeign('dangkyhocphan_ibfk_1');
            $table->dropForeign('dangkyhocphan_ibfk_2');
        });
    }
};
