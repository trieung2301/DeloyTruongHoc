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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_dangky_hocphan`(IN `p_SinhVienID` INT, IN `p_LopHocPhanID` INT, IN `p_UserID` INT, OUT `p_KetQua` VARCHAR(255), OUT `p_ThanhCong` TINYINT)
BEGIN
    DECLARE v_DaDangKy INT DEFAULT 0;
    DECLARE v_SiSoHienTai INT DEFAULT 0;
    DECLARE v_SiSoToiDa INT DEFAULT 0;
    DECLARE v_MonHocID INT;
    DECLARE v_HocKyID INT;
    DECLARE v_DotDangKyID INT;
    DECLARE v_TrangThaiDot ENUM('Mo','Dong','TamNgung');
    DECLARE v_NgayBatDau DATETIME;
    DECLARE v_NgayKetThuc DATETIME;
    DECLARE v_CoNoHocPhi DECIMAL(15,2) DEFAULT 0;
    DECLARE v_MonTienQuyet INT DEFAULT 0;
    DECLARE v_MonSongHanh INT DEFAULT 0;
    DECLARE v_TrungLichHoc INT DEFAULT 0;
    DECLARE v_TrungLichThi INT DEFAULT 0;
    
    -- 1. Kiểm tra lớp học phần có tồn tại
    IF NOT EXISTS (SELECT 1 FROM lophocphan WHERE LopHocPhanID = p_LopHocPhanID) THEN
        SET p_KetQua = 'Lớp học phần không tồn tại';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    SELECT MonHocID, HocKyID, SoLuongToiDa INTO v_MonHocID, v_HocKyID, v_SiSoToiDa
    FROM lophocphan WHERE LopHocPhanID = p_LopHocPhanID;
    
    -- 2. Kiểm tra đã đăng ký môn này chưa (tránh trùng môn trong cùng học kỳ)
    SELECT COUNT(*) INTO v_DaDangKy
    FROM dangkyhocphan dk
    INNER JOIN lophocphan lh ON dk.LopHocPhanID = lh.LopHocPhanID
    WHERE dk.SinhVienID = p_SinhVienID
      AND lh.MonHocID = v_MonHocID
      AND lh.HocKyID = v_HocKyID
      AND dk.TrangThai = 'ThanhCong';
    
    IF v_DaDangKy > 0 THEN
        SET p_KetQua = 'Bạn đã đăng ký môn học này trong học kỳ này';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    -- 3. Kiểm tra sĩ số lớp
    SELECT COUNT(*) INTO v_SiSoHienTai
    FROM dangkyhocphan
    WHERE LopHocPhanID = p_LopHocPhanID AND TrangThai = 'ThanhCong';
    
    IF v_SiSoHienTai >= v_SiSoToiDa THEN
        SET p_KetQua = 'Lớp học phần đã đủ sĩ số';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    -- 4. Kiểm tra đợt đăng ký đang mở
    SELECT DotDangKyID, TrangThai, NgayBatDau, NgayKetThuc INTO v_DotDangKyID, v_TrangThaiDot, v_NgayBatDau, v_NgayKetThuc
    FROM dot_dangky
    WHERE HocKyID = v_HocKyID
      AND TrangThai = 'Mo'
      AND CURRENT_TIMESTAMP BETWEEN NgayBatDau AND NgayKetThuc
    LIMIT 1;
    
    IF v_DotDangKyID IS NULL THEN
        SET p_KetQua = 'Hiện không có đợt đăng ký nào đang mở cho học kỳ này';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    -- 5. Kiểm tra công nợ học phí (nếu có quy định chặn)
    SELECT (TongTien - DaNop) INTO v_CoNoHocPhi
    FROM hocphi
    WHERE SinhVienID = p_SinhVienID AND HocKyID = v_HocKyID
    LIMIT 1;
    
    IF v_CoNoHocPhi > 0 THEN   -- có thể điều chỉnh ngưỡng
        SET p_KetQua = 'Bạn còn nợ học phí, vui lòng thanh toán trước khi đăng ký';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    -- 6. Kiểm tra môn tiên quyết (đã hoàn thành chưa)
    SELECT COUNT(*) INTO v_MonTienQuyet
    FROM dieukienmonhoc dtq
    LEFT JOIN trangthai_monhoc_sinhvien tmhs 
      ON dtq.MonTienQuyetID = tmhs.MonHocID 
      AND tmhs.SinhVienID = p_SinhVienID
      AND tmhs.TrangThai = 'DaHoanThanh'
    WHERE dtq.MonHocID = v_MonHocID
      AND tmhs.ID IS NULL;
    
    IF v_MonTienQuyet > 0 THEN
        SET p_KetQua = 'Bạn chưa hoàn thành môn tiên quyết';
        SET p_ThanhCong = 0;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = p_KetQua;
    END IF;
    
    -- 7. Kiểm tra môn song hành (nếu có quy định bắt buộc phải học cùng kỳ)
    -- (có thể bỏ qua nếu trường không yêu cầu nghiêm ngặt)
    
    -- 8. Kiểm tra trùng lịch học (so sánh tiết học)
    -- (cần logic phức tạp hơn, ví dụ join lich_hoc → so sánh ngày, buổi, tiết)
    -- tạm thời để comment, nếu cần triển khai chi tiết thì mở rộng sau
    
    -- Nếu qua hết kiểm tra → thực hiện đăng ký
    INSERT INTO dangkyhocphan (SinhVienID, LopHocPhanID, ThoiGianDangKy, TrangThai)
    VALUES (p_SinhVienID, p_LopHocPhanID, CURRENT_TIMESTAMP, 'ThanhCong');
    
    -- Ghi log
    INSERT INTO hethong_log (UserID, HanhDong, MoTa, BangLienQuan, IDBanGhi, created_at)
    VALUES (p_UserID, 'DangKyHocPhan', CONCAT('SV ', p_SinhVienID, ' đăng ký lớp HP ', p_LopHocPhanID), 'dangkyhocphan', LAST_INSERT_ID(), CURRENT_TIMESTAMP);
    
    SET p_KetQua = 'Đăng ký học phần thành công';
    SET p_ThanhCong = 1;
    
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_dangky_hocphan");
    }
};
