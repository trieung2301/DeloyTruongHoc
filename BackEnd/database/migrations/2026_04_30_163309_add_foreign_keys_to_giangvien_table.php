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
        Schema::table('giangvien', function (Blueprint $table) {
            $table->foreign(['UserID'], 'giangvien_ibfk_1')->references(['UserID'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['KhoaID'], 'giangvien_ibfk_2')->references(['KhoaID'])->on('khoa')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('giangvien', function (Blueprint $table) {
            $table->dropForeign('giangvien_ibfk_1');
            $table->dropForeign('giangvien_ibfk_2');
        });
    }
};
