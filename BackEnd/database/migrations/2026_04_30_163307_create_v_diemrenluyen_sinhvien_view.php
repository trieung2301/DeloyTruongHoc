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
        DB::statement("CREATE VIEW `v_diemrenluyen_sinhvien` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`drl`.`HocKyID` AS `HocKyID`,`h`.`TenHocKy` AS `TenHocKy`,`drl`.`TongDiem` AS `TongDiem`,`drl`.`XepLoai` AS `XepLoai`,`drl`.`NgayDanhGia` AS `NgayDanhGia` from ((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`diemrenluyen` `drl` on(`sv`.`SinhVienID` = `drl`.`SinhVienID`)) join `truonghoc`.`hocky` `h` on(`drl`.`HocKyID` = `h`.`HocKyID`)) order by `sv`.`SinhVienID`,`drl`.`HocKyID` desc");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_diemrenluyen_sinhvien`");
    }
};
