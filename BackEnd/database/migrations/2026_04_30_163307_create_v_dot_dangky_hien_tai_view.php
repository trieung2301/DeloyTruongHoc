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
        DB::statement("CREATE VIEW `v_dot_dangky_hien_tai` AS select `dd`.`DotDangKyID` AS `DotDangKyID`,`dd`.`TenDot` AS `TenDot`,`h`.`TenHocKy` AS `TenHocKy`,`h`.`LoaiHocKy` AS `LoaiHocKy`,`dd`.`NgayBatDau` AS `NgayBatDau`,`dd`.`NgayKetThuc` AS `NgayKetThuc`,`dd`.`TrangThai` AS `TrangThai`,`dd`.`DoiTuong` AS `DoiTuong`,`dd`.`GhiChu` AS `GhiChu`,current_timestamp() AS `ThoiGianHienTai`,case when current_timestamp() between `dd`.`NgayBatDau` and `dd`.`NgayKetThuc` then 'DangMo' when current_timestamp() < `dd`.`NgayBatDau` then 'ChuaMo' else 'DaDong' end AS `TrangThaiThucTe` from (`truonghoc`.`dotdangky` `dd` join `truonghoc`.`hocky` `h` on(`dd`.`HocKyID` = `h`.`HocKyID`)) where `dd`.`TrangThai` = 'Mo' and current_timestamp() <= `dd`.`NgayKetThuc` order by `dd`.`NgayBatDau` desc limit 0,3");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_dot_dangky_hien_tai`");
    }
};
