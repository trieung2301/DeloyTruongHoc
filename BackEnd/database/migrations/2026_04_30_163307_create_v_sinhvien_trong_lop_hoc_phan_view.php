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
        DB::statement("CREATE VIEW `v_sinhvien_trong_lop_hoc_phan` AS select `lh`.`LopHocPhanID` AS `LopHocPhanID`,`lh`.`MaLopHP` AS `MaLopHP`,`mh`.`TenMon` AS `TenMon`,`h`.`TenHocKy` AS `TenHocKy`,`gv`.`HoTen` AS `GiangVienPhuTrach`,`sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTenSinhVien`,`sv`.`email` AS `Email`,`sv`.`sodienthoai` AS `SoDienThoai`,`dk`.`ThoiGianDangKy` AS `ThoiGianDangKy`,`dk`.`TrangThai` AS `TrangThai` from (((((`truonghoc`.`lophocphan` `lh` join `truonghoc`.`monhoc` `mh` on(`lh`.`MonHocID` = `mh`.`MonHocID`)) join `truonghoc`.`hocky` `h` on(`lh`.`HocKyID` = `h`.`HocKyID`)) left join `truonghoc`.`giangvien` `gv` on(`lh`.`GiangVienID` = `gv`.`GiangVienID`)) join `truonghoc`.`dangkyhocphan` `dk` on(`lh`.`LopHocPhanID` = `dk`.`LopHocPhanID`)) join `truonghoc`.`sinhvien` `sv` on(`dk`.`SinhVienID` = `sv`.`SinhVienID`)) where `dk`.`TrangThai` = 'ThanhCong' order by `lh`.`MaLopHP`,`sv`.`MaSV`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_sinhvien_trong_lop_hoc_phan`");
    }
};
