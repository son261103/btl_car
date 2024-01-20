<!DOCTYPE html>
<html>

<head>
    <title>Danh Sách Phụ Tùng</title>
</head>

<body>
    <h1>Danh Sách Phụ Tùng</h1>

    <?php
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
    $sql = "SELECT pt.*, kh.hoTen AS tenKhachHang, nv.hoTen AS tenNhanVien, lh.ngayHen FROM phutung pt
            INNER JOIN KhachHang kh ON pt.maKhachHang = kh.maKhachHang
            INNER JOIN NhanVien nv ON pt.maNhanVien = nv.maNhanVien
            INNER JOIN LichHen lh ON pt.maLichHen = lh.maLichHen";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Mã Phụ Tùng</th>
                    <th>Tên Phụ Tùng</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Khách Hàng</th>
                    <th>Nhân Viên</th>
                    <th>Ngày Hẹn</th>
                    <th>Ảnh Phụ Tùng</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['maPhuTung']}</td>";
            echo "<td>{$row['tenPhuTung']}</td>";
            echo "<td>{$row['soLuong']}</td>";
            echo "<td>{$row['gia']}</td>";
            echo "<td>{$row['tenKhachHang']}</td>";
            echo "<td>{$row['tenNhanVien']}</td>";
            echo "<td>{$row['ngayHen']}</td>";
            echo "<td><img src='{$row['anhPhuTung']}' alt='Ảnh Phụ Tùng' style='max-width: 100px;'></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Không có dữ liệu phụ tùng.";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>

</html>
