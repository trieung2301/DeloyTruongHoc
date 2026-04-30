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
        DB::statement("CREATE VIEW `v_dangkyhocphan_hien_tai` AS select `sv`.`SinhVienID` AS `SinhVienID`,`sv`.`MaSV` AS `MaSV`,`sv`.`HoTen` AS `HoTen`,`dk`.`DangKyID` AS `DangKyID`,`dk`.`ThoiGianDangKy` AS `ThoiGianDangKy`,`lh`.`MaLopHP` AS `MaLopHP`,`mh`.`MaMon` AS `MaMon`,`mh`.`TenMon` AS `TenMon`,`mh`.`SoTinChi` AS `SoTinChi`,`gv`.`HoTen` AS `TenGiangVien`,`h`.`TenHocKy` AS `TenHocKy` from (((((`truonghoc`.`sinhvien` `sv` join `truonghoc`.`dangkyhocphan` `dk` on(`sv`.`SinhVienID` = `dk`.`SinhVienID`)) join `truonghoc`.`lophocphan` `lh` on(`dk`.`LopHocPhanID` = `lh`.`LopHocPhanID`)) join `truonghoc`.`monhoc` `mh` on(`lh`.`MonHocID` = `mh`.`MonHocID`)) left join `truonghoc`.`giangvien` `gv` on(`lh`.`GiangVienID` = `gv`.`GiangVienID`)) join `truonghoc`.`hocky` `h` on(`lh`.`HocKyID` = `h`.`HocKyID`)) where `dk`.`TrangThai` = 'ThanhCong' and `h`.`HocKyID` = (select max(`truonghoc`.`hocky`.`HocKyID`) from `truonghoc`.`hocky`)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `v_dangkyhocphan_hien_tai`");
    }
};
