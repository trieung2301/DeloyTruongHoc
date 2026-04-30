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
        Schema::create('giangvien', function (Blueprint $table) {
            $table->integer('GiangVienID', true);
            $table->integer('UserID')->nullable()->unique('userid');
            $table->string('HoTen', 100);
            $table->string('HocVi', 100)->nullable();
            $table->string('ChuyenMon', 100)->nullable();
            $table->integer('KhoaID')->index('khoaid');
            $table->string('email')->nullable()->unique('email');
            $table->string('sodienthoai', 15)->nullable()->unique('sodienthoai');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giangvien');
    }
};
