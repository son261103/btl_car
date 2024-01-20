<?php
    // Xử lý khi form được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin từ form
        $partId = isset($_POST["partId"]) ? $_POST["partId"] : null;
        $tenPhuTung = isset($_POST["tenPhuTung"]) ? $_POST["tenPhuTung"] : null;
        $soLuong = isset($_POST["soLuong"]) ? $_POST["soLuong"] : null;
        $gia = isset($_POST["gia"]) ? $_POST["gia"] : null;
        $maKhachHang = isset($_POST["maKhachHang"]) ? $_POST["maKhachHang"] : null;
        $maNhanVien = isset($_POST["maNhanVien"]) ? $_POST["maNhanVien"] : null;
        $maLichHen = isset($_POST["maLichHen"]) ? $_POST["maLichHen"] : null;

        // Kiểm tra nếu có bất kỳ trường nào không có giá trị
        if ($partId === null || $tenPhuTung === null || $soLuong === null || $gia === null || $maKhachHang === null || $maNhanVien === null || $maLichHen === null) {
            exit("Dữ liệu không hợp lệ.");
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

        // Lấy thông tin về hình ảnh mới từ form
        $targetDirectory = "./img/";
        $originalFileName = basename($_FILES["anhPhuTung"]["name"]);
        $targetFile = $targetDirectory . $originalFileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Thực hiện truy vấn SQL để cập nhật thông tin phụ tùng và hình ảnh trong cơ sở dữ liệu
        $sql = "UPDATE phutung SET tenPhuTung = ?, soLuong = ?, gia = ?, maKhachHang = ?, maNhanVien = ?, maLichHen = ?, anhPhuTung = ? WHERE maPhuTung = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("siiiiisi", $tenPhuTung, $soLuong, $gia, $maKhachHang, $maNhanVien, $maLichHen, $targetFile, $partId);
            $stmt->execute();

            // Kiểm tra kết quả truy vấn
            if ($stmt->affected_rows > 0) {
                // Kiểm tra xem người dùng đã chọn hình ảnh mới hay chưa
                if (!empty($targetFile)) {
                    // Upload hình ảnh mới
                    if (move_uploaded_file($_FILES['anhPhuTung']['tmp_name'], $targetFile)) {
                        echo "Sửa thông tin phụ tùng và hình ảnh thành công!";
                    } else {
                        echo "Không thể upload hình ảnh.";
                    }
                } else {
                    echo "Sửa thông tin phụ tùng thành công!";
                }
            } else {
                echo "Không có dòng nào được cập nhật. Có thể dữ liệu không thay đổi.";
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
