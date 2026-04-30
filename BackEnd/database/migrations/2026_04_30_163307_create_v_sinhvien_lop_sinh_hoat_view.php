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
        DB::statement("CREATE VIEW `v_sinhvien_lop_sinh_hoat` AS select `lsh`.`LopSinhHoatID` AS `LopSinhHoatID`,`lsh`.`MaLop` AS `MaLop`,`lsh`.`TenLop` AS `TenLop`,`lsh`.`NamNhapHoc` AS `NamNhapHoc`,`k`.`TenKhoa` AS `TenKhoa`,`gv`.`HoTen` AS `TenCoVan`,`gv`.`email` AS `EmailCoVan`,`sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`sv`.`NgaySinh` AS `NgaySinh`,`sv`.`email` AS `Email`,`sv`.`sodienthoai` AS `SoDienThoai` from (((`truonghoc`.`lopsinhhoat` `lsh` join `truonghoc`.`khoa` `k` on(`lsh`.`KhoaID` = `k`.`KhoaID`)) left join `truonghoc`.`giangvien` `gv` on(`lsh`.`GiangVienID` = `gv`.`GiangVienID`)) left join `truonghoc`.`sinhvien` `sv` on(`lsh`.`LopSinhHoatID` = `sv`.`LopSinhHoatID`)) order by `lsh`.`MaLop`,`sv`.`MaSV`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_sinhvien_lop_sinh_hoat`");
    }
};
