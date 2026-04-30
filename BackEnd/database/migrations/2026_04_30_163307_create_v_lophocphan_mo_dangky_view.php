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
        DB::statement("CREATE VIEW `v_lophocphan_mo_dangky` AS select `lh`.`LopHocPhanID` AS `LopHocPhanID`,`lh`.`MaLopHP` AS `MaLopHP`,`mh`.`MaMon` AS `MaMon`,`mh`.`TenMon` AS `TenMon`,`mh`.`SoTinChi` AS `SoTinChi`,`gv`.`HoTen` AS `TenGiangVien`,`h`.`TenHocKy` AS `TenHocKy`,`dd`.`TenDot` AS `TenDot`,`dd`.`NgayBatDau` AS `NgayBatDau`,`dd`.`NgayKetThuc` AS `NgayKetThuc`,`dd`.`TrangThai` AS `TrangThaiDot`,`lh`.`SoLuongToiDa` AS `SoLuongToiDa`,(select count(0) from `truonghoc`.`dangkyhocphan` `dk` where `dk`.`LopHocPhanID` = `lh`.`LopHocPhanID` and `dk`.`TrangThai` = 'ThanhCong') AS `SoLuongDaDangKy` from ((((`truonghoc`.`lophocphan` `lh` join `truonghoc`.`monhoc` `mh` on(`lh`.`MonHocID` = `mh`.`MonHocID`)) join `truonghoc`.`hocky` `h` on(`lh`.`HocKyID` = `h`.`HocKyID`)) left join `truonghoc`.`giangvien` `gv` on(`lh`.`GiangVienID` = `gv`.`GiangVienID`)) join `truonghoc`.`dotdangky` `dd` on(`h`.`HocKyID` = `dd`.`HocKyID`)) where `dd`.`TrangThai` = 'Mo' and current_timestamp() between `dd`.`NgayBatDau` and `dd`.`NgayKetThuc` order by `dd`.`NgayBatDau` desc,`lh`.`MaLopHP`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_lophocphan_mo_dangky`");
    }
};
