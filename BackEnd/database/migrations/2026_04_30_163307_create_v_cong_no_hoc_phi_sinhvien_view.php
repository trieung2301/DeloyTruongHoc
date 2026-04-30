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
        DB::statement("CREATE VIEW `v_cong_no_hoc_phi_sinhvien` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`h`.`TenHocKy` AS `TenHocKy`,`hp`.`HocPhiID` AS `HocPhiID`,`hp`.`TongTien` AS `TongTien`,`hp`.`DaNop` AS `DaNop`,`hp`.`TongTien` - `hp`.`DaNop` AS `ConNo`,`hp`.`HanNop` AS `HanNop`,case when `hp`.`TongTien` - `hp`.`DaNop` <= 0 then 'DaHoanThanh' when `hp`.`HanNop` < curdate() then 'QuaHan' else 'ChuaHoanThanh' end AS `TrangThaiNo`,coalesce((select sum(`tt`.`SoTien`) from `truonghoc`.`thanhtoanhocphi` `tt` where `tt`.`HocPhiID` = `hp`.`HocPhiID`),0) AS `TongDaThanhToanChiTiet` from ((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`hocphi` `hp` on(`sv`.`SinhVienID` = `hp`.`SinhVienID`)) join `truonghoc`.`hocky` `h` on(`hp`.`HocKyID` = `h`.`HocKyID`)) order by `sv`.`MaSV`,`hp`.`HanNop` desc");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_cong_no_hoc_phi_sinhvien`");
    }
};
