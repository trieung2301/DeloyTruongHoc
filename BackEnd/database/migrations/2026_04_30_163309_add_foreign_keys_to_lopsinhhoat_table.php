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
        Schema::table('lopsinhhoat', function (Blueprint $table) {
            $table->foreign(['KhoaID'], 'lopsinhhoat_ibfk_1')->references(['KhoaID'])->on('khoa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lopsinhhoat', function (Blueprint $table) {
            $table->dropForeign('lopsinhhoat_ibfk_1');
        });
    }
};
