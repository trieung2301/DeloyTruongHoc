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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tinh_diem_tong_ket`(IN `p_DangKyID` INT, IN `p_UserID` INT)
BEGIN
    DECLARE v_DiemTongKet DECIMAL(4,2);
    
    SELECT 
        ROUND(
            (COALESCE(DiemChuyenCan, 0) * 0.2) +
            (COALESCE(DiemGiuaKy, 0) * 0.3) +
            (COALESCE(DiemThi, 0) * 0.5),
            2
        ) INTO v_DiemTongKet
    FROM diemso
    WHERE DangKyID = p_DangKyID;
    
    UPDATE diemso
    SET DiemTongKet = v_DiemTongKet
    WHERE DangKyID = p_DangKyID;
    
    -- Ghi log
    INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi)
    VALUES (p_UserID, 'TinhDiemTongKet', CONCAT('Tính điểm tổng kết cho đăng ký ', p_DangKyID), 'diemso', p_DangKyID, CURRENT_TIMESTAMP);
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_tinh_diem_tong_ket");
    }
};
