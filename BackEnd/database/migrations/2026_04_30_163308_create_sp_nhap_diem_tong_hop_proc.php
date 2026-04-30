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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_nhap_diem_tong_hop`(IN `p_DangKyID` INT, IN `p_DiemChuyenCan` FLOAT, IN `p_DiemGiuaKy` FLOAT, IN `p_DiemThi` FLOAT, IN `p_UserID` INT, OUT `p_KetQua` VARCHAR(255))
BEGIN
    -- Kiểm tra bản ghi diemso đã tồn tại chưa
    IF NOT EXISTS (SELECT 1 FROM diemso WHERE DangKyID = p_DangKyID) THEN
        INSERT INTO diemso (DangKyID) VALUES (p_DangKyID);
    END IF;

    -- Cập nhật điểm: Dùng COALESCE để nếu tham số truyền vào là NULL thì giữ nguyên giá trị cũ
    UPDATE diemso
    SET 
        DiemChuyenCan = COALESCE(p_DiemChuyenCan, DiemChuyenCan),
        DiemGiuaKy    = COALESCE(p_DiemGiuaKy, DiemGiuaKy),
        DiemThi       = COALESCE(p_DiemThi, DiemThi)
    WHERE DangKyID = p_DangKyID;

    -- Ghi Log (Lựa chọn B: Đã bỏ CURRENT_TIMESTAMP dư thừa)
    INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi)
    VALUES (
        p_UserID, 
        'NhapDiem', 
        CONCAT('Cập nhật điểm cho bản ghi đăng ký ID: ', p_DangKyID), 
        'diemso', 
        p_DangKyID
    );

    SET p_KetQua = 'Cập nhật điểm thành công';
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_nhap_diem_tong_hop");
    }
};
