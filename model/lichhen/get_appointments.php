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

// Lấy danh sách lịch hẹn từ CSDL
$sql_get_appointments = "SELECT maLichHen, ngayHen FROM LichHen";
$result_appointments = $conn->query($sql_get_appointments);

// Hiển thị danh sách lịch hẹn trong thẻ option
foreach ($result_appointments as $appointment) {
    echo '<option value="' . $appointment['maLichHen'] . '">' . $appointment['ngayHen'] . '</option>';
}

$conn->close();
?>
