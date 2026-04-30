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
        Schema::table('lichhoc', function (Blueprint $table) {
            $table->foreign(['LopHocPhanID'], 'lichhoc_ibfk_1')->references(['LopHocPhanID'])->on('lophocphan')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lichhoc', function (Blueprint $table) {
            $table->dropForeign('lichhoc_ibfk_1');
        });
    }
};
