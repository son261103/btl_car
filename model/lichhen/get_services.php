<?php
// Kết nối đến cơ sở dữ liệu
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "sql_car";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đặt encoding UTF-8 để tránh lỗi hiển thị tiếng Việt
mysqli_query($conn, "SET NAMES 'UTF8'");

// Truy vấn SQL để lấy danh sách dịch vụ
$sqlServices = "SELECT maDichVu, tenDichVu FROM DichVu";
$resultServices = $conn->query($sqlServices);

if ($resultServices->num_rows > 0) {
    while ($rowService = $resultServices->fetch_assoc()) {
        echo "<option value='{$rowService['maDichVu']}'>{$rowService['tenDichVu']}</option>";
    }
}

// Đóng kết nối
$conn->close();
?>
