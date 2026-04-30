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
        DB::statement("CREATE VIEW `v_bangdiem_lop_hoc_phan` AS select `lh`.`LopHocPhanID` AS `LopHocPhanID`,`lh`.`MaLopHP` AS `MaLopHP`,`mh`.`TenMon` AS `TenMon`,`h`.`TenHocKy` AS `TenHocKy`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`ds`.`DiemChuyenCan` AS `DiemChuyenCan`,`ds`.`DiemGiuaKy` AS `DiemGiuaKy`,`ds`.`DiemThi` AS `DiemThi`,`ds`.`DiemTongKet` AS `DiemTongKet`,case when `ds`.`DiemTongKet` >= 8.0 then 'A' when `ds`.`DiemTongKet` >= 7.0 then 'B+' when `ds`.`DiemTongKet` >= 6.5 then 'B' when `ds`.`DiemTongKet` >= 5.5 then 'C+' when `ds`.`DiemTongKet` >= 5.0 then 'C' when `ds`.`DiemTongKet` >= 4.0 then 'D' else 'F' end AS `DiemChu` from (((((`truonghoc`.`lophocphan` `lh` join `truonghoc`.`monhoc` `mh` on(`lh`.`MonHocID` = `mh`.`MonHocID`)) join `truonghoc`.`hocky` `h` on(`lh`.`HocKyID` = `h`.`HocKyID`)) join `truonghoc`.`dangkyhocphan` `dk` on(`lh`.`LopHocPhanID` = `dk`.`LopHocPhanID`)) join `truonghoc`.`sinhvien` `sv` on(`dk`.`SinhVienID` = `sv`.`SinhVienID`)) left join `truonghoc`.`diemso` `ds` on(`dk`.`DangKyID` = `ds`.`DangKyID`)) where `dk`.`TrangThai` = 'ThanhCong' order by `lh`.`MaLopHP`,`sv`.`MaSV`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_bangdiem_lop_hoc_phan`");
    }
};
