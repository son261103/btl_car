    <!DOCTYPE html>
    <html>

    <head>
        <title>Sửa Thông Tin Phụ Tùng</title>
    </head>

    <body>
        <h1>Sửa Thông Tin Phụ Tùng</h1>

        <?php
        // Xử lý khi form được submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy mã phụ tùng từ form
            $partId = isset($_POST["partId"]) ? $_POST["partId"] : null;

            // Kiểm tra nếu $partId không tồn tại hoặc là giá trị không hợp lệ
            if ($partId === null) {
                // Xử lý khi không có mã phụ tùng được chọn
                // Ví dụ: hiển thị thông báo lỗi và chuyển hướng hoặc quay lại trang trước đó.
                exit("Mã phụ tùng không hợp lệ.");
            }

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

            // Thực hiện truy vấn SQL để lấy thông tin phụ tùng từ cơ sở dữ liệu
            $sql = "SELECT * FROM phutung WHERE maPhuTung = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $partId);
                $stmt->execute();

                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    // Hiển thị form sửa thông tin và thêm nút submit
                    echo "<form method=\"post\" action=\"./xulysuaphutung.php\" enctype=\"multipart/form-data\">";
                    echo "<input type=\"hidden\" name=\"partId\" value=\"{$row['maPhuTung']}\">";
                    echo "Tên phụ tùng: <input type=\"text\" name=\"tenPhuTung\" value=\"{$row['tenPhuTung']}\"><br>";
                    echo "Số lượng: <input type=\"text\" name=\"soLuong\" value=\"{$row['soLuong']}\"><br>";
                    echo "Giá: <input type=\"text\" name=\"gia\" value=\"{$row['gia']}\"><br>";

                    // Lựa chọn khách hàng
                    echo "Khách hàng: <select name=\"maKhachHang\">";
                    $sqlKhachHang = "SELECT maKhachHang, hoTen FROM KhachHang";
                    $resultKhachHang = $conn->query($sqlKhachHang);
                    while ($rowKhachHang = $resultKhachHang->fetch_assoc()) {
                        $selected = ($rowKhachHang['maKhachHang'] == $row['maKhachHang']) ? "selected" : "";
                        echo "<option value=\"{$rowKhachHang['maKhachHang']}\" $selected>{$rowKhachHang['hoTen']}</option>";
                    }
                    echo "</select><br>";

                    // Lựa chọn nhân viên
                    echo "Nhân viên: <select name=\"maNhanVien\">";
                    $sqlNhanVien = "SELECT maNhanVien, hoTen FROM NhanVien";
                    $resultNhanVien = $conn->query($sqlNhanVien);
                    while ($rowNhanVien = $resultNhanVien->fetch_assoc()) {
                        $selected = ($rowNhanVien['maNhanVien'] == $row['maNhanVien']) ? "selected" : "";
                        echo "<option value=\"{$rowNhanVien['maNhanVien']}\" $selected>{$rowNhanVien['hoTen']}</option>";
                    }
                    echo "</select><br>";

                    // Lựa chọn lịch hẹn
                    echo "Lịch hẹn: <select name=\"maLichHen\">";
                    $sqlLichHen = "SELECT maLichHen, ngayHen FROM LichHen";
                    $resultLichHen = $conn->query($sqlLichHen);
                    while ($rowLichHen = $resultLichHen->fetch_assoc()) {
                        $selected = ($rowLichHen['maLichHen'] == $row['maLichHen']) ? "selected" : "";
                        echo "<option value=\"{$rowLichHen['maLichHen']}\" $selected>{$rowLichHen['ngayHen']}</option>";
                    }
                    echo "</select><br>";

                    // Hiển thị ảnh phụ tùng hiện tại
                    echo "Ảnh Phụ Tùng: <br>";
                    echo "<img src=\"{$row['anhPhuTung']}\" alt=\"Ảnh Phụ Tùng\" style=\"max-width: 200px;\"><br>";
                    // Thêm input để tải lên ảnh mới
                    echo "Chọn ảnh mới: <input type=\"file\" name=\"anhPhuTung\"><br>";

                    // Thêm nút submit
                    echo "<input type=\"submit\" name=\"submit\" value=\"Sửa Thông Tin\">";
                    echo "</form>";
                }

                $stmt->close();
            } else {
                // Xử lý khi có lỗi trong prepared statement
                echo "Lỗi trong truy vấn SQL: " . $conn->error;
            }

            // Đóng kết nối
            $conn->close();
        }
        ?>
    </body>

    </html>