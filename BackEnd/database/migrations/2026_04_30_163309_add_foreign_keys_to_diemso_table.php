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
        Schema::table('diemso', function (Blueprint $table) {
            $table->foreign(['DangKyID'], 'diemso_ibfk_1')->references(['DangKyID'])->on('dangkyhocphan')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diemso', function (Blueprint $table) {
            $table->dropForeign('diemso_ibfk_1');
        });
    }
};
