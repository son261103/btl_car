<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy Mã Lịch Hẹn từ biểu mẫu
    $maLichHen = $_POST["maLichHen"];

    // Kết nối cơ sở dữ liệu
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

    // Truy vấn để lấy thông tin về lịch hẹn cần xóa, kết hợp cả thông tin khách hàng và nhân viên
    $sql = "SELECT LichHen.*, KhachHang.hoTen AS tenKhachHang, NhanVien.hoTen AS tenNhanVien
            FROM LichHen
            INNER JOIN KhachHang ON LichHen.maKhachHang = KhachHang.maKhachHang
            INNER JOIN NhanVien ON LichHen.maNhanVien = NhanVien.maNhanVien
            WHERE LichHen.maLichHen = $maLichHen";
    $result = $conn->query($sql);

    // Kiểm tra và hiển thị thông tin
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Thông tin Lịch Hẹn cần xóa:</h3>";
        echo "<p>Mã Lịch Hẹn: " . $row["maLichHen"] . "</p>";
        echo "<p>Tên Khách Hàng: " . $row["tenKhachHang"] . "</p>";
        echo "<p>Tên Nhân Viên: " . $row["tenNhanVien"] . "</p>";
        // Các thông tin khác tương tự
        echo "<form method='post' action='xoa_lich_hen.php'>";
        echo "<input type='hidden' name='maLichHen' value='" . $row["maLichHen"] . "'>";

        // Hiển thị tất cả thông tin cần xóa
        echo "<label for='confirm'>Xác nhận xóa lịch hẹn (Nhập 'YES' để xác nhận): </label>";
        echo "<input type='text' id='confirm' name='confirm' required>";
        echo "<button type='submit'>Xóa Lịch Hẹn</button>";
        echo "</form>";
    } else {
        echo "Không tìm thấy thông tin cho Mã Lịch Hẹn: $maLichHen";
    }

    // Xử lý khi biểu mẫu xác nhận xóa được gửi đi
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
        $confirm = $_POST['confirm'];

        if (strtolower($confirm) === 'yes') {
            // Truy vấn xóa lịch hẹn
            $sql_delete = "DELETE FROM LichHen WHERE maLichHen = $maLichHen";

            if ($conn->query($sql_delete) === TRUE) {
                echo "Đã xóa lịch hẹn thành công";
            } else {
                echo "Lỗi khi xóa lịch hẹn: " . $conn->error;
            }
        } else {
            echo "Xác nhận không hợp lệ. Lịch hẹn chưa được xóa.";
        }
    }

    // Đóng kết nối
    $conn->close();
}
