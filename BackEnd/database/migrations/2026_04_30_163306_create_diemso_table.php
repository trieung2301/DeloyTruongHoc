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
        Schema::create('diemso', function (Blueprint $table) {
            $table->integer('DiemID', true);
            $table->integer('DangKyID')->nullable()->unique('dangkyid');
            $table->decimal('DiemChuyenCan', 4)->nullable();
            $table->decimal('DiemGiuaKy', 4)->nullable();
            $table->decimal('DiemThi', 4)->nullable();
            $table->decimal('DiemTongKet', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diemso');
    }
};
