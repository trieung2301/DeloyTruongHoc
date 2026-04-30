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
        Schema::create('namhoc', function (Blueprint $table) {
            $table->integer('NamHocID', true);
            $table->string('TenNamHoc', 50)->nullable();
            $table->date('NgayBatDau')->nullable();
            $table->date('NgayKetThuc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('namhoc');
    }
};
