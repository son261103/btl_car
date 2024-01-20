<?php
// Kiểm tra xem có dữ liệu POST từ trang xoa_phutung.php hay không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $maPhuTung = $_POST["maPhuTung"];
    $confirm = $_POST["confirm"];

    // Kiểm tra xem người dùng đã nhập 'yes' hay chưa để xác nhận xóa
    if (strtolower($confirm) == "yes") {
        // Kết nối đến cơ sở dữ liệu
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

        // Thực hiện truy vấn SQL để xóa phụ tùng
        $sql = "DELETE FROM phutung WHERE maPhuTung = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $maPhuTung);
            $stmt->execute();

            // Kiểm tra xem có phụ tùng nào bị xóa hay không
            if ($stmt->affected_rows > 0) {
                echo "Xóa Phụ Tùng Thành Công.";
            } else {
                echo "Không tìm thấy phụ tùng để xóa.";
            }

            $stmt->close();
        } else {
            // Xử lý khi có lỗi trong prepared statement
            echo "Lỗi trong truy vấn SQL: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    } else {
        // Nếu không xác nhận xóa, thông báo và chuyển hướng về trang chonxoa_phutung.php
        echo "Xác nhận xóa không hợp lệ. Phụ Tùng không bị xóa.";
        // header("Refresh: 3; URL=./chonxoa_phutung.php");
        // exit();
    }
} else {
    // Nếu không có dữ liệu POST, chuyển hướng về trang chonxoa_phutung.php
    // header("Location: ./chonxoa_phutung.php");
    // exit();
}
?>
