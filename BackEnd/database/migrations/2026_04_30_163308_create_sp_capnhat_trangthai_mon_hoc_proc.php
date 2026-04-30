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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_capnhat_trangthai_mon_hoc`(IN `p_SinhVienID` INT, IN `p_MonHocID` INT, IN `p_HocKyID` INT, IN `p_DiemTongKet` DECIMAL(4,2), IN `p_UserID` INT)
BEGIN
    DECLARE v_TrangThai ENUM('DaHoanThanh','Rot','HocLai','Mien') DEFAULT 'Rot';
    
    IF p_DiemTongKet >= 5.0 THEN
        SET v_TrangThai = 'DaHoanThanh';
    ELSEIF p_DiemTongKet >= 4.0 THEN
        SET v_TrangThai = 'HocLai';
    END IF;
    
    INSERT INTO trangthai_monhoc_sinhvien (
        SinhVienID, MonHocID, HocKyHoanThanh, TrangThai, DiemTongKet, LanThi
    )
    VALUES (p_SinhVienID, p_MonHocID, p_HocKyID, v_TrangThai, p_DiemTongKet, 1)
    ON DUPLICATE KEY UPDATE
        HocKyHoanThanh = p_HocKyID,
        TrangThai = v_TrangThai,
        DiemTongKet = p_DiemTongKet,
        LanThi = LanThi + 1;
    
    INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi)
    VALUES (p_UserID, 'CapNhatTrangThaiMon', CONCAT('Cập nhật trạng thái môn ', p_MonHocID, ' cho SV ', p_SinhVienID), 'trangthai_monhoc_sinhvien', p_SinhVienID, CURRENT_TIMESTAMP);
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_capnhat_trangthai_mon_hoc");
    }
};
