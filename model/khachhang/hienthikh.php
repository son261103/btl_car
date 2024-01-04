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
// Display customer list
$sql = "SELECT * FROM KhachHang";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["maKhachHang"]."</td>";
        echo "<td>".$row["hoTen"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["soDienThoai"]."</td>";
        echo "<td>".$row["diaChi"]."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Không có khách hàng nào.</td></tr>";
}

?>