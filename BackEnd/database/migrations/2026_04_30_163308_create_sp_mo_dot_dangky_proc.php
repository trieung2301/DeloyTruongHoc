<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mo_dot_dangky`(IN `p_HocKyID` INT, IN `p_TenDot` VARCHAR(100), IN `p_NgayBatDau` DATETIME, IN `p_NgayKetThuc` DATETIME, IN `p_DoiTuong` VARCHAR(255), IN `p_GhiChu` TEXT, IN `p_UserID` INT, OUT `p_DotDangKyID` INT)
BEGIN
    INSERT INTO dot_dangky (
        HocKyID, TenDot, NgayBatDau, NgayKetThuc, TrangThai, DoiTuong, GhiChu
    )
    VALUES (
        p_HocKyID, p_TenDot, p_NgayBatDau, p_NgayKetThuc, 'Mo', p_DoiTuong, p_GhiChu
    );
    
    SET p_DotDangKyID = LAST_INSERT_ID();
    
    INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi)
    VALUES (p_UserID, 'MoDotDangKy', CONCAT('Mở đợt đăng ký: ', p_TenDot), 'dot_dangky', p_DotDangKyID, CURRENT_TIMESTAMP);
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_mo_dot_dangky");
    }
};
