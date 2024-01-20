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

// Lấy mã hóa đơn cần xóa từ tham số truyền vào
if (isset($_GET['id'])) {
    $maHoaDon = $_GET['id'];

    // Kiểm tra xem có hóa đơn có mã như vậy không
    $result = mysqli_query($conn, "SELECT * FROM HoaDon WHERE maHoaDon = '$maHoaDon'");

    if ($result) {
        $hoaDon = mysqli_fetch_assoc($result);

        // Thực hiện câu truy vấn DELETE để xóa hóa đơn
        $deleteQuery = "DELETE FROM HoaDon WHERE maHoaDon = '$maHoaDon'";
        
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Hóa đơn đã được xóa thành công!";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        die("Lỗi: " . mysqli_error($conn));
    }
} else {
    echo "Lỗi: Không có ID hóa đơn được chọn.";
    exit();
}

// Đóng kết nối đến CSDL
$conn->close();
?>
