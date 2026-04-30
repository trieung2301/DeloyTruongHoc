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
        Schema::create('chuongtrinhdaotao', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('NganhID');
            $table->integer('MonHocID')->index('monhocid');
            $table->integer('HocKyGoiY')->nullable();
            $table->boolean('BatBuoc')->nullable()->default(true);

            $table->unique(['NganhID', 'MonHocID'], 'nganhid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuongtrinhdaotao');
    }
};
