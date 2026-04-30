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
        Schema::table('dotdangky', function (Blueprint $table) {
            $table->foreign(['HocKyID'], 'dotdangky_ibfk_1')->references(['HocKyID'])->on('hocky')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dotdangky', function (Blueprint $table) {
            $table->dropForeign('dotdangky_ibfk_1');
        });
    }
};
