<?php
// Kết nối CSDL và truy vấn tên nhân viên
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
$sql_employee = "SELECT maNhanVien, hoTen FROM NhanVien";
$result_employee = $conn->query($sql_employee);

// Hiển thị danh sách nhân viên trong dropdown
while ($row_employee = $result_employee->fetch_assoc()) {
    echo '<option value="' . $row_employee['maNhanVien'] . '">' . $row_employee['hoTen'] . '</option>';
}
