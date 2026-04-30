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
        Schema::create('hocphi', function (Blueprint $table) {
            $table->integer('HocPhiID', true);
            $table->integer('SinhVienID')->nullable()->index('sinhvienid');
            $table->integer('HocKyID')->nullable()->index('hockyid');
            $table->decimal('TongTien', 15)->nullable();
            $table->decimal('DaNop', 15)->nullable()->default(0);
            $table->date('HanNop')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hocphi');
    }
};
