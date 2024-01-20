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

// Lấy danh sách dịch vụ từ CSDL
$sql_get_services = "SELECT maDichVu, tenDichVu FROM DichVu";
$result_services = $conn->query($sql_get_services);

// Hiển thị danh sách dịch vụ trong thẻ option
foreach ($result_services as $service) {
    echo '<option value="' . $service['maDichVu'] . '">' . $service['tenDichVu'] . '</option>';
}

$conn->close();
?>
