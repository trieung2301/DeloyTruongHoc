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
        DB::statement("CREATE VIEW `v_danhsach_lop_giangvien` AS select `gv`.`GiangVienID` AS `GiangVienID`,`gv`.`HoTen` AS `TenGiangVien`,`gv`.`HocVi` AS `HocVi`,`gv`.`ChuyenMon` AS `ChuyenMon`,`gv`.`KhoaID` AS `KhoaID`,`gv`.`email` AS `email`,`gv`.`sodienthoai` AS `sodienthoai`,`lhp`.`LopHocPhanID` AS `LopHocPhanID`,`lhp`.`MaLopHP` AS `MaLopHP`,`mh`.`MaMon` AS `MaMon`,`mh`.`TenMon` AS `TenMon`,`mh`.`SoTinChi` AS `SoTinChi`,`nh`.`TenNamHoc` AS `NamHoc`,`hk`.`TenHocKy` AS `TenHocKy`,`hk`.`LoaiHocKy` AS `LoaiHocKy`,`lhp`.`SoLuongToiDa` AS `SoLuongToiDa`,coalesce(count(`dkhp`.`DangKyID`),0) AS `SoSinhVien` from (((((`truonghoc`.`giangvien` `gv` join `truonghoc`.`lophocphan` `lhp` on(`gv`.`GiangVienID` = `lhp`.`GiangVienID`)) left join `truonghoc`.`monhoc` `mh` on(`lhp`.`MonHocID` = `mh`.`MonHocID`)) join `truonghoc`.`hocky` `hk` on(`lhp`.`HocKyID` = `hk`.`HocKyID`)) join `truonghoc`.`namhoc` `nh` on(`hk`.`NamHocID` = `nh`.`NamHocID`)) left join `truonghoc`.`dangkyhocphan` `dkhp` on(`lhp`.`LopHocPhanID` = `dkhp`.`LopHocPhanID`)) group by `gv`.`GiangVienID`,`gv`.`HoTen`,`gv`.`HocVi`,`gv`.`ChuyenMon`,`gv`.`KhoaID`,`gv`.`email`,`gv`.`sodienthoai`,`lhp`.`LopHocPhanID`,`lhp`.`MaLopHP`,`mh`.`MaMon`,`mh`.`TenMon`,`mh`.`SoTinChi`,`nh`.`TenNamHoc`,`hk`.`TenHocKy`,`hk`.`LoaiHocKy`,`lhp`.`SoLuongToiDa`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_danhsach_lop_giangvien`");
    }
};
