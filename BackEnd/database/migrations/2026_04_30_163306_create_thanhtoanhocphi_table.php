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
        Schema::create('thanhtoanhocphi', function (Blueprint $table) {
            $table->integer('ThanhToanID', true);
            $table->integer('HocPhiID')->nullable()->index('hocphiid');
            $table->decimal('SoTien', 15)->nullable();
            $table->dateTime('NgayThanhToan')->nullable()->useCurrent();
            $table->enum('HinhThuc', ['TienMat', 'ChuyenKhoan', 'Online'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thanhtoanhocphi');
    }
};
