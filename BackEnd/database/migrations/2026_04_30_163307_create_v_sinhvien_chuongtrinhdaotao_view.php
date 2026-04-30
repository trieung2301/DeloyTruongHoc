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
        DB::statement("CREATE VIEW `v_sinhvien_chuongtrinhdaotao` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`n`.`MaNganh` AS `MaNganh`,`n`.`TenNganh` AS `TenNganh`,`mh`.`MaMon` AS `MaMon`,`mh`.`TenMon` AS `TenMon`,`mh`.`SoTinChi` AS `SoTinChi`,`ctdt`.`HocKyGoiY` AS `HocKyGoiY`,`ctdt`.`BatBuoc` AS `BatBuoc`,`mh`.`KhoaID` AS `KhoaID` from (((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`nganhdaotao` `n` on(`sv`.`NganhID` = `n`.`NganhID`)) join `truonghoc`.`chuongtrinhdaotao` `ctdt` on(`n`.`NganhID` = `ctdt`.`NganhID`)) join `truonghoc`.`monhoc` `mh` on(`ctdt`.`MonHocID` = `mh`.`MonHocID`)) order by `sv`.`SinhVienID`,`ctdt`.`HocKyGoiY`,`mh`.`MaMon`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_sinhvien_chuongtrinhdaotao`");
    }
};
