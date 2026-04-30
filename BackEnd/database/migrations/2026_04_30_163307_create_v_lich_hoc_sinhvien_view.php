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
        DB::statement("CREATE VIEW `v_lich_hoc_sinhvien` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`lh`.`LichHocID` AS `LichHocID`,`lh`.`LopHocPhanID` AS `LopHocPhanID`,`lh`.`NgayHoc` AS `NgayHoc`,`lh`.`BuoiHoc` AS `BuoiHoc`,`lh`.`TietBatDau` AS `TietBatDau`,`lh`.`SoTiet` AS `SoTiet`,`lh`.`PhongHoc` AS `PhongHoc`,`lh`.`GhiChu` AS `GhiChu`,`mh`.`TenMon` AS `TenMon`,`lhp`.`MaLopHP` AS `MaLopHP`,`gv`.`HoTen` AS `TenGiangVien`,`hk`.`HocKyID` AS `HocKyID`,`hk`.`TenHocKy` AS `TenHocKy`,`nh`.`NamHocID` AS `NamHocID`,`nh`.`TenNamHoc` AS `TenNamHoc`,`lhp`.`NgayBatDau` AS `NgayBatDauLop`,`lhp`.`NgayKetThuc` AS `NgayKetThucLop`,`hk`.`NgayBatDau` AS `NgayBatDauHocKy`,`hk`.`NgayKetThuc` AS `NgayKetThucHocKy` from (((((((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`dangkyhocphan` `dk` on(`sv`.`SinhVienID` = `dk`.`SinhVienID`)) join `truonghoc`.`lichhoc` `lh` on(`dk`.`LopHocPhanID` = `lh`.`LopHocPhanID`)) join `truonghoc`.`lophocphan` `lhp` on(`lh`.`LopHocPhanID` = `lhp`.`LopHocPhanID`)) join `truonghoc`.`monhoc` `mh` on(`lhp`.`MonHocID` = `mh`.`MonHocID`)) left join `truonghoc`.`giangvien` `gv` on(`lhp`.`GiangVienID` = `gv`.`GiangVienID`)) join `truonghoc`.`hocky` `hk` on(`lhp`.`HocKyID` = `hk`.`HocKyID`)) join `truonghoc`.`namhoc` `nh` on(`hk`.`NamHocID` = `nh`.`NamHocID`))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_lich_hoc_sinhvien`");
    }
};
