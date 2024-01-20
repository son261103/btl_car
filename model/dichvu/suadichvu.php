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
$maDichVu = $_POST['maDichVu'];
$tenKhachHang = $_POST['tenKhachHang'];
$tenNhanVien = $_POST['tenNhanVien'];
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

        // Cập nhật dịch vụ trong bảng DichVu
        $sqlSuaDichVu = "UPDATE DichVu SET moTa='$moTa', gia=$gia WHERE maDichVu=$maDichVu";
        if ($conn->query($sqlSuaDichVu)) {
            echo "Sửa dịch vụ thành công!";
        } else {
            echo "Không thể sửa dịch vụ: " . $conn->error;
        }
    } else {
        echo "Không tìm thấy mã nhân viên.";
    }
} else {
    echo "Không tìm thấy mã khách hàng.";
}

// Đóng kết nối
$conn->close();
?>
