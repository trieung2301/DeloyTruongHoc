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
        DB::statement("CREATE VIEW `v_gpa_hoc_ky` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`hk`.`HocKyID` AS `HocKyID`,`hk`.`TenHocKy` AS `TenHocKy`,`nh`.`NamHocID` AS `NamHocID`,count(distinct `mh`.`MonHocID`) AS `SoMon`,sum(`mh`.`SoTinChi`) AS `TongTinChi`,round(avg(`ds`.`DiemTongKet`),2) AS `GPA_HocKy_TamTinh` from ((((((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`dangkyhocphan` `dkhp` on(`sv`.`SinhVienID` = `dkhp`.`SinhVienID`)) join `truonghoc`.`lophocphan` `lhp` on(`dkhp`.`LopHocPhanID` = `lhp`.`LopHocPhanID`)) join `truonghoc`.`hocky` `hk` on(`lhp`.`HocKyID` = `hk`.`HocKyID`)) left join `truonghoc`.`namhoc` `nh` on(`hk`.`NamHocID` = `nh`.`NamHocID`)) join `truonghoc`.`monhoc` `mh` on(`lhp`.`MonHocID` = `mh`.`MonHocID`)) left join `truonghoc`.`diemso` `ds` on(`dkhp`.`DangKyID` = `ds`.`DangKyID`)) group by `sv`.`SinhVienID`,`sv`.`MaSV`,`sv`.`HoTen`,`hk`.`HocKyID`,`hk`.`TenHocKy`,`nh`.`NamHocID`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_gpa_hoc_ky`");
    }
};
