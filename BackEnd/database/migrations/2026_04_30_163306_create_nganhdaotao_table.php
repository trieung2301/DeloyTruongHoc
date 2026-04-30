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
        Schema::create('nganhdaotao', function (Blueprint $table) {
            $table->integer('NganhID', true);
            $table->string('MaNganh', 20)->unique('manganh');
            $table->string('TenNganh', 100);
            $table->integer('KhoaID')->index('khoaid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nganhdaotao');
    }
};
