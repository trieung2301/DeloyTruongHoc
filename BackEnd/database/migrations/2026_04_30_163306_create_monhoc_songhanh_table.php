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
        Schema::create('monhoc_songhanh', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('MonHocID');
            $table->integer('MonSongHanhID')->index('monsonghanhid');
            $table->string('GhiChu')->nullable();

            $table->unique(['MonHocID', 'MonSongHanhID'], 'unique_pair');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monhoc_songhanh');
    }
};
