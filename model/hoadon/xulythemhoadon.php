<?php
// Kết nối đến CSDL ở đây
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $maNhanVien = $_POST["maNhanVien"];
    $maKhachHang = $_POST["maKhachHang"];
    $maLichHen = $_POST["maLichHen"];
    $maXe = $_POST["maXe"];
    $maDichVu = $_POST["maDichVu"];
    $soLuongPhuTung = $_POST["soLuongPhuTung"];
    $giaPhuTung = $_POST["giaPhuTung"];

    // Thực hiện truy vấn để thêm hóa đơn vào CSDL
    $sql = "INSERT INTO HoaDon (maNhanVien, maKhachHang, maLichHen, maXe, maDichVu, soLuongPhuTung, giaPhuTung )
            VALUES ('$maNhanVien', '$maKhachHang', '$maLichHen', '$maXe', '$maDichVu', '$soLuongPhuTung', '$giaPhuTung')";

    if (mysqli_query($conn, $sql)) {
        echo "Hóa đơn đã được thêm thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // Nếu không phải là phương thức POST, chẳng hạn như GET, chuyển hướng hoặc xử lý theo cách khác
    //header("Location: ./index.php"); // Điều hướng về trang chính hoặc trang khác tùy vào cấu hình của bạn
    echo"thêm dữ liệu thành công!";
    //exit();
}

// Đóng kết nối đến CSDL ở đây
$conn->close();
?>
