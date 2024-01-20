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

// Truy vấn tất cả xe từ CSDL
$sql_cars = "SELECT maXe, moHinh, bienSo FROM Xe";
$result_cars = $conn->query($sql_cars);

// Hiển thị danh sách xe trong dropdown
foreach ($result_cars as $car) {
    echo '<option value="' . $car['maXe'] . '">' . $car['moHinh'] . ' - ' . $car['bienSo'] . '</option>';
    
}

$conn->close();
?>
