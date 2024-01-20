<?php
// Kết nối đến cơ sở dữ liệu
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "sql_car";

// Khởi tạo kết nối
$conn = new mysqli($server, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đặt encoding UTF-8 để tránh lỗi hiển thị tiếng Việt
mysqli_query($conn, "SET NAMES 'UTF8'");

// Lấy dữ liệu từ form
$tenKhachHang = $_POST['tenKhachHang'];
$tenNhanVien = $_POST['tenNhanVien'];
$tenDichVu = $_POST['tenDichVu'];
$moTa = $_POST['moTa'];
$gia = $_POST['gia'];

// Truy vấn SQL để lấy mã khách hàng
$sqlKhachHang = "SELECT maKhachHang FROM KhachHang WHERE hoTen = '$tenKhachHang'";
$resultKhachHang = $conn->query($sqlKhachHang);

if ($resultKhachHang->num_rows > 0) {
    $rowKhachHang = $resultKhachHang->fetch_assoc();
    $maKhachHang = $rowKhachHang['maKhachHang'];

    // Truy vấn SQL để lấy mã nhân viên
    $sqlNhanVien = "SELECT maNhanVien FROM NhanVien WHERE hoTen = '$tenNhanVien'";
    $resultNhanVien = $conn->query($sqlNhanVien);

    if ($resultNhanVien->num_rows > 0) {
        $rowNhanVien = $resultNhanVien->fetch_assoc();
        $maNhanVien = $rowNhanVien['maNhanVien'];

        // Truy vấn SQL để lấy mã xe dựa trên tên khách hàng
        $sqlXe = "SELECT Xe.maXe
                FROM Xe
                JOIN KhachHang ON Xe.maKhachHang = KhachHang.maKhachHang
                WHERE KhachHang.hoTen = '$tenKhachHang'";

        $resultXe = $conn->query($sqlXe);

        if ($resultXe->num_rows > 0) {
            $rowXe = $resultXe->fetch_assoc();
            $maXe = $rowXe['maXe'];

            // Thêm dịch vụ mới vào bảng DichVu
            $sqlThemDichVu = "INSERT INTO DichVu (tenDichVu, moTa, gia) VALUES ('$tenDichVu', '$moTa', $gia)";
            $conn->query($sqlThemDichVu);

            // Lấy mã dịch vụ vừa thêm
            $maDichVu = $conn->insert_id;

            // Thêm phiếu dịch vụ vào bảng PhieuDichVu
            $sqlThemPhieuDichVu = "INSERT INTO PhieuDichVu (maXe, maNhanVien, ngayDichVu, ghiChu) VALUES ('$maXe', '$maNhanVien', NOW(), '')";
            if ($conn->query($sqlThemPhieuDichVu)) {
                // Lấy mã phiếu dịch vụ vừa thêm
                $maPhieuDichVu = $conn->insert_id;

                // Thêm chi tiết phiếu dịch vụ vào bảng ChiTietPhieuDichVu
                $sqlThemChiTiet = "INSERT INTO ChiTietPhieuDichVu (maPhieuDichVu, maDichVu, soLuongSuDung) VALUES ('$maPhieuDichVu', '$maDichVu', 1)";
                $conn->query($sqlThemChiTiet);

                echo "Thêm dịch vụ thành công!";
            } else {
                echo "Không thể thêm phiếu dịch vụ: " . $conn->error;
            }
        } else {
            echo "Không tìm thấy mã xe cho khách hàng: $tenKhachHang";
        }
    } else {
        echo "Không tìm thấy mã nhân viên.";
    }
} else {
    echo "Không tìm thấy mã khách hàng.";
}

// Đóng kết nối
$conn->close();
