<?php
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

// Lấy danh sách phụ tùng từ CSDL
$sql_get_parts = "SELECT maPhuTung, tenPhuTung FROM phutung";
$result_parts = $conn->query($sql_get_parts);

// Hiển thị danh sách phụ tùng trong thẻ option
foreach ($result_parts as $part) {
    echo '<option value="' . $part['maPhuTung'] . '">' . $part['tenPhuTung'] . '</option>';
}

$conn->close();
?>
