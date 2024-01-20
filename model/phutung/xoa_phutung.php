<!DOCTYPE html>
<html>
<head>
    <title>Xác Nhận và Xóa Phụ Tùng</title>
</head>
<body>
    <h1>Xác Nhận và Xóa Phụ Tùng</h1>

    <?php
    // Kiểm tra xem có dữ liệu POST từ trang chonxoa_phutung.php hay không
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $maPhuTung = $_POST["maPhuTung"];

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

        // Lấy thông tin phụ tùng để xác nhận
        $sql = "SELECT * FROM phutung WHERE maPhuTung = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $maPhuTung);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Hiển thị thông tin phụ tùng để xác nhận
                echo "<p>Bạn có chắc chắn muốn xóa phụ tùng sau đây?</p>";
                echo "<p>Mã Phụ Tùng: {$row['maPhuTung']}</p>";
                echo "<p>Tên Phụ Tùng: {$row['tenPhuTung']}</p>";
                echo "<p>Số Lượng: {$row['soLuong']}</p>";
                echo "<p>Giá: {$row['gia']}</p>";

                // Thêm hình ảnh nếu có
                if (!empty($row['anhPhuTung'])) {
                    echo "<p>Ảnh Phụ Tùng: <img src=\"{$row['anhPhuTung']}\" alt=\"Ảnh Phụ Tùng\" style=\"max-width: 200px;\"></p>";
                }

                // Thêm nút xác nhận xóa
                echo "<form method=\"post\" action=\"./xulyxoa_phutung.php\">";
                echo "<input type=\"hidden\" name=\"maPhuTung\" value=\"{$row['maPhuTung']}\">";
                echo "<label for=\"confirm\">Nhập 'yes' để xác nhận xóa:</label>";
                echo "<input type=\"text\" name=\"confirm\" required>";
                echo "<br>";
                echo "<input type=\"submit\" name=\"submit\" value=\"Xác Nhận Xóa\">";
                echo "</form>";
            } else {
                echo "Không tìm thấy thông tin phụ tùng.";
            }

            $stmt->close();
        } else {
            // Xử lý khi có lỗi trong prepared statement
            echo "Lỗi trong truy vấn SQL: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    } else {
        // Nếu không có dữ liệu POST, chuyển hướng về trang chonxoa_phutung.php
        header("Location: ./chonxoa_phutung.php");
        exit();
    }
    ?>
</body>
</html>
