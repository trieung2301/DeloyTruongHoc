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
        DB::statement("CREATE VIEW `v_diem_hoc_ky_sinhvien` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`hk`.`HocKyID` AS `HocKyID`,`hk`.`TenHocKy` AS `TenHocKy`,`nh`.`NamHocID` AS `NamHocID`,`mh`.`MaMon` AS `MaMon`,`mh`.`TenMon` AS `TenMon`,`mh`.`SoTinChi` AS `SoTinChi`,`ds`.`DiemChuyenCan` AS `DiemChuyenCan`,`ds`.`DiemGiuaKy` AS `DiemGiuaKy`,`ds`.`DiemThi` AS `DiemThi`,`ds`.`DiemTongKet` AS `DiemTongKet`,`dkhp`.`ThoiGianDangKy` AS `ThoiGianDangKy` from ((((((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`dangkyhocphan` `dkhp` on(`sv`.`SinhVienID` = `dkhp`.`SinhVienID`)) join `truonghoc`.`lophocphan` `lhp` on(`dkhp`.`LopHocPhanID` = `lhp`.`LopHocPhanID`)) join `truonghoc`.`hocky` `hk` on(`lhp`.`HocKyID` = `hk`.`HocKyID`)) join `truonghoc`.`namhoc` `nh` on(`hk`.`NamHocID` = `nh`.`NamHocID`)) join `truonghoc`.`monhoc` `mh` on(`lhp`.`MonHocID` = `mh`.`MonHocID`)) left join `truonghoc`.`diemso` `ds` on(`dkhp`.`DangKyID` = `ds`.`DangKyID`)) order by `sv`.`SinhVienID`,`hk`.`HocKyID`,`mh`.`MaMon`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_diem_hoc_ky_sinhvien`");
    }
};
