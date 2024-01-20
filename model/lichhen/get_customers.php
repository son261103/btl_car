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

// Truy vấn tất cả khách hàng từ CSDL
$sql_customers = "SELECT maKhachHang, hoTen FROM KhachHang";
$result_customers = $conn->query($sql_customers);

// Hiển thị danh sách khách hàng trong dropdown
foreach ($result_customers as $customer) {
    echo '<option value="' . $customer['maKhachHang'] . '">' . $customer['hoTen'] . '</option>';
}

$conn->close();
?>
