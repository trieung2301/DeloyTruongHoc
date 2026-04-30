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
        Schema::create('dieukienmonhoc', function (Blueprint $table) {
            $table->integer('DieuKienID', true);
            $table->integer('MonHocID')->index('monhocid');
            $table->integer('MonTienQuyetID')->index('montienquyetid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dieukienmonhoc');
    }
};
