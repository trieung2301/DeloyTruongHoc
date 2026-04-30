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
        Schema::table('thanhtoanhocphi', function (Blueprint $table) {
            $table->foreign(['HocPhiID'], 'thanhtoanhocphi_ibfk_1')->references(['HocPhiID'])->on('hocphi')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thanhtoanhocphi', function (Blueprint $table) {
            $table->dropForeign('thanhtoanhocphi_ibfk_1');
        });
    }
};
