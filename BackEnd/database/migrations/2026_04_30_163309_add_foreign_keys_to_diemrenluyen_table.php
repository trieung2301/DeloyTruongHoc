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
        Schema::table('diemrenluyen', function (Blueprint $table) {
            $table->foreign(['SinhVienID'], 'diemrenluyen_ibfk_1')->references(['SinhVienID'])->on('sinhvien')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['HocKyID'], 'diemrenluyen_ibfk_2')->references(['HocKyID'])->on('hocky')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diemrenluyen', function (Blueprint $table) {
            $table->dropForeign('diemrenluyen_ibfk_1');
            $table->dropForeign('diemrenluyen_ibfk_2');
        });
    }
};
