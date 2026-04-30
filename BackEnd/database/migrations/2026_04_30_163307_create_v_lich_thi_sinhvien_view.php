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
        DB::statement("CREATE VIEW `v_lich_thi_sinhvien` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`lt`.`LichThiID` AS `LichThiID`,`lt`.`LopHocPhanID` AS `LopHocPhanID`,`lt`.`NgayThi` AS `NgayThi`,`lt`.`GioBatDau` AS `GioBatDau`,`lt`.`GioKetThuc` AS `GioKetThuc`,`lt`.`PhongThi` AS `PhongThi`,`lt`.`HinhThucThi` AS `HinhThucThi`,`lt`.`GhiChu` AS `GhiChu`,`mh`.`TenMon` AS `TenMon`,`lhp`.`MaLopHP` AS `MaLopHP`,`gv`.`HoTen` AS `TenGiangVien`,`hk`.`HocKyID` AS `HocKyID`,`hk`.`TenHocKy` AS `TenHocKy`,`nh`.`NamHocID` AS `NamHocID`,`nh`.`TenNamHoc` AS `TenNamHoc`,`lhp`.`NgayBatDau` AS `NgayBatDauLop`,`lhp`.`NgayKetThuc` AS `NgayKetThucLop`,`hk`.`NgayBatDau` AS `NgayBatDauHocKy`,`hk`.`NgayKetThuc` AS `NgayKetThucHocKy` from (((((((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`dangkyhocphan` `dk` on(`sv`.`SinhVienID` = `dk`.`SinhVienID`)) join `truonghoc`.`lichthi` `lt` on(`dk`.`LopHocPhanID` = `lt`.`LopHocPhanID`)) join `truonghoc`.`lophocphan` `lhp` on(`lt`.`LopHocPhanID` = `lhp`.`LopHocPhanID`)) join `truonghoc`.`monhoc` `mh` on(`lhp`.`MonHocID` = `mh`.`MonHocID`)) left join `truonghoc`.`giangvien` `gv` on(`lhp`.`GiangVienID` = `gv`.`GiangVienID`)) join `truonghoc`.`hocky` `hk` on(`lhp`.`HocKyID` = `hk`.`HocKyID`)) join `truonghoc`.`namhoc` `nh` on(`hk`.`NamHocID` = `nh`.`NamHocID`))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_lich_thi_sinhvien`");
    }
};
