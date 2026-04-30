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
        Schema::create('hethong_log', function (Blueprint $table) {
            $table->bigInteger('LogID', true);
            $table->integer('UserID')->nullable();
            $table->string('HanhDong', 100);
            $table->text('MoTa')->nullable();
            $table->string('BangLienQuan', 50)->nullable();
            $table->integer('IDBanGhi')->nullable();
            $table->string('IP', 45)->nullable();
            $table->string('UserAgent')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();

            $table->index(['UserID', 'HanhDong', 'created_at'], 'idx_user_hanhdong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hethong_log');
    }
};
