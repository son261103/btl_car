<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/dichvu.css">
    <title>Danh sách dịch vụ</title>
</head>

<body>
    <section id="zone6">
    <h2>Thêm Dịch Vụ</h2>

    <form action="./model/dichvu/themdichvu.php" method="post">
        <label for="tenKhachHang">Tên Khách Hàng:</label>
        <select name="tenKhachHang" id="tenKhachHang">
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

            // Truy vấn SQL để lấy tên khách hàng
            $sqlKhachHang = "SELECT hoTen FROM KhachHang";
            $resultKhachHang = $conn->query($sqlKhachHang);

            if ($resultKhachHang->num_rows > 0) {
                while ($rowKhachHang = $resultKhachHang->fetch_assoc()) {
                    echo "<option value='{$rowKhachHang['hoTen']}'>{$rowKhachHang['hoTen']}</option>";
                }
            }
            ?>
        </select>

        <br><br>

        <label for="tenNhanVien">Tên Nhân Viên:</label>
        <select name="tenNhanVien" id="tenNhanVien">
            <?php
            // Truy vấn SQL để lấy tên nhân viên
            $sqlNhanVien = "SELECT hoTen FROM NhanVien";
            $resultNhanVien = $conn->query($sqlNhanVien);

            if ($resultNhanVien->num_rows > 0) {
                while ($rowNhanVien = $resultNhanVien->fetch_assoc()) {
                    echo "<option value='{$rowNhanVien['hoTen']}'>{$rowNhanVien['hoTen']}</option>";
                }
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </select>

        <br><br>

        <label for="tenDichVu">Tên Dịch Vụ:</label>
        <input type="text" name="tenDichVu" id="tenDichVu" required>

        <br><br>

        <label for="moTa">Mô Tả:</label>
        <textarea name="moTa" id="moTa" rows="4" required></textarea>

        <br><br>

        <label for="gia">Giá:</label>
        <input type="number" name="gia" id="gia" required>

        <br><br>

        <!-- Thêm trường ẩn để lưu mã xe -->
        <input type="hidden" name="maXe" id="maXe" value="">

        <!-- Nút submit -->
        <input type="submit" value="Thêm Dịch Vụ">
    </form>

    <!-- Script để lấy giá trị mã xe dựa trên lựa chọn khách hàng -->
    <script>
        document.getElementById('tenKhachHang').addEventListener('change', function() {
            // Bạn cần sử dụng JavaScript để lấy giá trị mã xe từ lựa chọn khách hàng
            // và cập nhật giá trị của trường ẩn "maXe" trước khi gửi form.
            // Ví dụ, bạn có thể sử dụng Ajax để gửi yêu cầu đến máy chủ để lấy mã xe tương ứng.
        });
    </script>


    <h2>Sửa Dịch Vụ</h2>

    <form action="./model/dichvu/suadichvu.php" method="post">
        <label for="maDichVu">Chọn Dịch Vụ:</label>
        <select name="maDichVu" id="maDichVu">
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

            // Truy vấn SQL để lấy danh sách dịch vụ
            $sqlDichVu = "SELECT maDichVu, tenDichVu FROM DichVu";
            $resultDichVu = $conn->query($sqlDichVu);

            if ($resultDichVu->num_rows > 0) {
                while ($rowDichVu = $resultDichVu->fetch_assoc()) {
                    echo "<option value='{$rowDichVu['maDichVu']}'>{$rowDichVu['tenDichVu']}</option>";
                }
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </select>

        <br><br>

        <label for="tenKhachHang">Chọn Khách Hàng:</label>
        <select name="tenKhachHang" id="tenKhachHang">
            <?php
            // Kết nối đến cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối không thành công: " . $conn->connect_error);
            }

            // Truy vấn SQL để lấy danh sách khách hàng
            $sqlKhachHang = "SELECT hoTen FROM KhachHang";
            $resultKhachHang = $conn->query($sqlKhachHang);

            if ($resultKhachHang->num_rows > 0) {
                while ($rowKhachHang = $resultKhachHang->fetch_assoc()) {
                    echo "<option value='{$rowKhachHang['hoTen']}'>{$rowKhachHang['hoTen']}</option>";
                }
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </select>

        <br><br>

        <label for="tenNhanVien">Chọn Nhân Viên:</label>
        <select name="tenNhanVien" id="tenNhanVien">
            <?php
            // Kết nối đến cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối không thành công: " . $conn->connect_error);
            }

            // Truy vấn SQL để lấy danh sách nhân viên
            $sqlNhanVien = "SELECT hoTen FROM NhanVien";
            $resultNhanVien = $conn->query($sqlNhanVien);

            if ($resultNhanVien->num_rows > 0) {
                while ($rowNhanVien = $resultNhanVien->fetch_assoc()) {
                    echo "<option value='{$rowNhanVien['hoTen']}'>{$rowNhanVien['hoTen']}</option>";
                }
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </select>

        <br><br>

        <label for="moTa">Mô Tả:</label>
        <textarea name="moTa" id="moTa" rows="4" required></textarea>

        <br><br>

        <label for="gia">Giá:</label>
        <input type="number" name="gia" id="gia" required>

        <br><br>

        <!-- Nút submit -->
        <input type="submit" value="Sửa Dịch Vụ">
    </form>


    <?php
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

    // Truy vấn SQL để lấy danh sách dịch vụ
    $sql = "SELECT * FROM DichVu";
    $result = $conn->query($sql);

    ?>
    <h2>Danh sách dịch vụ</h2>

    <?php
    if ($result->num_rows > 0) {
        foreach ($result as $row) {
            echo "<p>{$row['tenDichVu']} - 
            <a href='./model/dichvu/xacnhanxoa.php?maDichVu={$row['maDichVu']}'>Xóa</a></p>";
        }
    } else {
        echo "Không có dữ liệu";
    }
    ?>
    <?php
    // Đóng kết nối
    $conn->close();
    ?>


    <!-- <h2>Danh sách dịch vụ</h2> -->
    <table border="1">
        <!-- <tr>
            <th>Ngày hẹn</th>
            <th>Tên khách hàng</th>
            <th>Tên nhân viên</th>
            <th>Tên dịch vụ</th>
            <th>Mô tả</th>
            <th>Giá</th>
        </tr> -->
        <!-- hiển thị danh sách -->
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

        // Truy vấn SQL để lấy thông tin về lịch hẹn, khách hàng, nhân viên và dịch vụ
        $sql = "
    SELECT LichHen.ngayHen, KhachHang.hoTen AS tenKhachHang, NhanVien.hoTen AS tenNhanVien, DichVu.maDichVu, DichVu.tenDichVu, DichVu.moTa, DichVu.gia
    FROM LichHen
    LEFT JOIN KhachHang ON LichHen.maKhachHang = KhachHang.maKhachHang
    LEFT JOIN NhanVien ON LichHen.maNhanVien = NhanVien.maNhanVien
    LEFT JOIN Xe ON LichHen.maXe = Xe.maXe
    LEFT JOIN PhieuDichVu ON Xe.maXe = PhieuDichVu.maXe
    LEFT JOIN ChiTietPhieuDichVu ON PhieuDichVu.maPhieuDichVu = ChiTietPhieuDichVu.maPhieuDichVu
    LEFT JOIN DichVu ON ChiTietPhieuDichVu.maDichVu = DichVu.maDichVu
";

        $result = $conn->query($sql);

        echo "<h2>Danh sách dịch vụ</h2>
    <table border='1'>
    <tr>
        <th>Ngày hẹn</th>
        <th>Tên khách hàng</th>
        <th>Tên nhân viên</th>
        <th>Mã dịch vụ</th>
        <th>Tên dịch vụ</th>
        <th>Mô tả</th>
        <th>Giá</th>
    </tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <td>{$row['ngayHen']}</td>
            <td>{$row['tenKhachHang']}</td>
            <td>{$row['tenNhanVien']}</td>
            <td>{$row['maDichVu']}</td>
            <td>{$row['tenDichVu']}</td>
            <td>{$row['moTa']}</td>
            <td>{$row['gia']}</td>
        </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
        }

        echo "</table>";

        // Đóng kết nối
        $conn->close();
        ?>

    </table>
    </section>
</body>

</html>