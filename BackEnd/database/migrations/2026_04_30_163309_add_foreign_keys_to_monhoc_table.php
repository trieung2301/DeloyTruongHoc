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
        Schema::table('monhoc', function (Blueprint $table) {
            $table->foreign(['KhoaID'], 'monhoc_ibfk_1')->references(['KhoaID'])->on('khoa')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monhoc', function (Blueprint $table) {
            $table->dropForeign('monhoc_ibfk_1');
        });
    }
};
