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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tinh_gpa_hoc_ky`(IN `p_SinhVienID` INT, IN `p_HocKyID` INT, OUT `p_GPA` DECIMAL(4,2), OUT `p_TongTinChi` INT)
BEGIN
    SELECT 
        ROUND(
            SUM(CASE 
                WHEN ds.DiemTongKet >= 8.0 THEN 4.0
                WHEN ds.DiemTongKet >= 7.0 THEN 3.5
                WHEN ds.DiemTongKet >= 6.0 THEN 3.0
                WHEN ds.DiemTongKet >= 5.0 THEN 2.0
                ELSE 0
            END * mh.SoTinChi) / SUM(mh.SoTinChi),
            2
        ),
        SUM(mh.SoTinChi)
    INTO p_GPA, p_TongTinChi
    FROM dangkyhocphan dk
    INNER JOIN lophocphan lh ON dk.LopHocPhanID = lh.LopHocPhanID
    INNER JOIN monhoc mh ON lh.MonHocID = mh.MonHocID
    LEFT JOIN diemso ds ON dk.DangKyID = ds.DangKyID
    WHERE dk.SinhVienID = p_SinhVienID
      AND lh.HocKyID = p_HocKyID
      AND dk.TrangThai = 'ThanhCong'
      AND ds.DiemTongKet IS NOT NULL;
      
    IF p_TongTinChi IS NULL THEN
        SET p_GPA = 0.00;
        SET p_TongTinChi = 0;
    END IF;
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_tinh_gpa_hoc_ky");
    }
};
