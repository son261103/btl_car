<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDelete'])) {
    $maDichVu = $_POST["maDichVu"];

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

    // Kiểm tra và xóa các bản ghi trong ChiTietPhieuDichVu liên quan đến maDichVu
    $sqlCheckExistence = "SELECT * FROM ChiTietPhieuDichVu WHERE maDichVu = '$maDichVu'";
    $resultExistence = $conn->query($sqlCheckExistence);

    if ($resultExistence->num_rows > 0) {
        // Xóa các bản ghi trong ChiTietPhieuDichVu liên quan đến maDichVu
        $sqlDeleteChiTiet = "DELETE FROM ChiTietPhieuDichVu WHERE maDichVu = '$maDichVu'";
        $conn->query($sqlDeleteChiTiet);
    }

    // Thực hiện truy vấn xóa dịch vụ
    $sqlDeleteDichVu = "DELETE FROM DichVu WHERE maDichVu = '$maDichVu'";
    
    if ($conn->query($sqlDeleteDichVu) === TRUE) {
        echo "Dịch vụ có mã $maDichVu đã được xóa thành công.";
    } else {
        echo "Lỗi khi xóa dịch vụ: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
