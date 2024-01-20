<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "sql_car";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_query($conn, "SET NAMES 'UTF8'");

// Lấy mã hóa đơn cần sửa từ tham số truyền vào
if (isset($_GET['id'])) {
    $maHoaDon = $_GET['id'];

    // Kiểm tra xem có hóa đơn có mã như vậy không
    $result = mysqli_query($conn, "SELECT * FROM HoaDon WHERE maHoaDon = '$maHoaDon'");

    if ($result) {
        $hoaDon = mysqli_fetch_assoc($result);
    } else {
        die("Lỗi: " . mysqli_error($conn));
    }
} else {
    echo "Lỗi: Không có ID hóa đơn được chọn.";
    exit();
}

// Kiểm tra nếu form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $maNhanVien = $_POST["maNhanVien"];
    $maKhachHang = $_POST["maKhachHang"];
    $maLichHen = $_POST["maLichHen"];
    $maXe = $_POST["maXe"];
    $maDichVu = $_POST["maDichVu"];
    $soLuongPhuTung = $_POST["soLuongPhuTung"];
    $giaPhuTung = $_POST["giaPhuTung"];

    // Thực hiện truy vấn để cập nhật thông tin hóa đơn
    $sql = "UPDATE HoaDon SET
            maNhanVien = '$maNhanVien',
            maKhachHang = '$maKhachHang',
            maLichHen = '$maLichHen',
            maXe = '$maXe',
            maDichVu = '$maDichVu',
            soLuongPhuTung = '$soLuongPhuTung',
            giaPhuTung = '$giaPhuTung'
            WHERE maHoaDon = '$maHoaDon'";

    if (mysqli_query($conn, $sql)) {
        echo "Hóa đơn đã được cập nhật thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>