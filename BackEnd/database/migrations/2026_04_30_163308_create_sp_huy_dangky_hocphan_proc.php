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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_huy_dangky_hocphan`(IN `p_DangKyID` INT, IN `p_UserID` INT, OUT `p_KetQua` VARCHAR(255), OUT `p_ThanhCong` TINYINT)
BEGIN
    DECLARE v_SinhVienID INT;
    DECLARE v_LopHocPhanID INT;
    
    SELECT SinhVienID, LopHocPhanID INTO v_SinhVienID, v_LopHocPhanID
    FROM dangkyhocphan
    WHERE DangKyID = p_DangKyID AND TrangThai = 'ThanhCong';
    
    IF v_SinhVienID IS NULL THEN
        SET p_KetQua = 'Không tìm thấy đăng ký hợp lệ hoặc đã hủy';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    -- Kiểm tra thời gian hủy (ví dụ: chỉ cho hủy trong 7 ngày đầu đợt)
    -- Có thể thêm điều kiện ở đây
    
    UPDATE dangkyhocphan 
    SET TrangThai = 'Huy',
        ThoiGianDangKy = CURRENT_TIMESTAMP   -- có thể thêm trường ThoiGianHuy riêng
    WHERE DangKyID = p_DangKyID;
    
    INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi)
    VALUES (p_UserID, 'HuyHocPhan', CONCAT('Hủy đăng ký ID ', p_DangKyID), 'dangkyhocphan', p_DangKyID, CURRENT_TIMESTAMP);
    
    SET p_KetQua = 'Hủy đăng ký thành công';
    SET p_ThanhCong = 1;
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_huy_dangky_hocphan");
    }
};
