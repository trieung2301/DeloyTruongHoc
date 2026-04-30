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
        Schema::table('chitietdiemrenluyen', function (Blueprint $table) {
            $table->foreign(['DiemRenLuyenID'], 'chitietdiemrenluyen_ibfk_1')->references(['DiemRenLuyenID'])->on('diemrenluyen')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['TieuChiID'], 'chitietdiemrenluyen_ibfk_2')->references(['TieuChiID'])->on('tieuchirenluyen')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chitietdiemrenluyen', function (Blueprint $table) {
            $table->dropForeign('chitietdiemrenluyen_ibfk_1');
            $table->dropForeign('chitietdiemrenluyen_ibfk_2');
        });
    }
};
