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
        Schema::create('hocky', function (Blueprint $table) {
            $table->integer('HocKyID', true);
            $table->integer('NamHocID')->nullable()->index('namhocid');
            $table->string('TenHocKy', 50)->nullable();
            $table->enum('LoaiHocKy', ['HK1', 'HK2', 'He'])->nullable();
            $table->date('NgayBatDau')->nullable();
            $table->date('NgayKetThuc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hocky');
    }
};
