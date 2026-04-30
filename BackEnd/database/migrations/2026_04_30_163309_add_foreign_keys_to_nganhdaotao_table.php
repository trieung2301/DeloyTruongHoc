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
        Schema::table('nganhdaotao', function (Blueprint $table) {
            $table->foreign(['KhoaID'], 'nganhdaotao_ibfk_1')->references(['KhoaID'])->on('khoa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nganhdaotao', function (Blueprint $table) {
            $table->dropForeign('nganhdaotao_ibfk_1');
        });
    }
};
