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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_dong_dot_dangky`(IN `p_DotDangKyID` INT, IN `p_UserID` INT, OUT `p_KetQua` VARCHAR(255))
BEGIN
    UPDATE dot_dangky
    SET TrangThai = 'Dong',
        updated_at = CURRENT_TIMESTAMP
    WHERE DotDangKyID = p_DotDangKyID;
    
    IF ROW_COUNT() = 0 THEN
        SET p_KetQua = 'Không tìm thấy đợt đăng ký';
    ELSE
        SET p_KetQua = 'Đóng đợt đăng ký thành công';
        
        INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi)
        VALUES (p_UserID, 'DongDotDangKy', CONCAT('Đóng đợt ID ', p_DotDangKyID), 'dot_dangky', p_DotDangKyID, CURRENT_TIMESTAMP);
    END IF;
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_dong_dot_dangky");
    }
};
