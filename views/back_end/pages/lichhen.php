<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/lichhen.css">
    <title>Danh sách lịch hẹn</title>
</head>

<body>
    <section id="zone5">
        <h1>Danh sách lịch hẹn</h1>

        <form action="./model/lichhen/hienthilichhen.php" method="post">
            <h2>Thêm Lịch Hẹn</h2>

            <!-- Chọn khách hàng từ CSDL -->
            <label for="customer_id">Khách hàng:</label>
            <select name="customer_id" required>
                <?php include './model/lichhen/get_customers.php'; ?>
            </select><br>

            <!-- Chọn xe từ CSDL -->
            <label for="car_id">Xe:</label>
            <select name="car_id" required>
                <?php include './model/lichhen/get_cars.php'; ?>
            </select><br>

            <!-- Chọn nhân viên từ CSDL -->
            <label for="employee_id">Nhân viên:</label>
            <select name="employee_id" required>
                <?php include './model/lichhen/get_nhanvien.php'; ?>
            </select><br>

            <label for="appointment_date">Ngày hẹn:</label>
            <input type="date" name="appointment_date" required><br>

            <!-- Thêm trường mục đích -->
            <label for="purpose">Mục đích:</label>
            <input type="text" name="purpose" required><br>

            <!-- Chọn dịch vụ từ CSDL -->
            <label for="service_id">Dịch vụ:</label>
            <select name="service_id" required>
                <?php include './model/lichhen/get_services.php'; ?>
            </select><br>

            <!-- Nút Submit -->
            <input type="submit" name="submit" value="Thêm lịch hẹn">
        </form>


        <!-- Form Sửa Lịch Hẹn -->
        <form action="./model/lichhen/sualichhen.php" method="post">
            <h2>Sửa Lịch Hẹn</h2>
            <label for="edit_appointment_id">Chọn lịch hẹn:</label>
            <select name="edit_appointment_id" required>

                <?php
                // Kết nối database
                $server = "localhost:3306";
                $username = "root";
                $password = "";
                $dbname = "sql_car";
                $conn = new mysqli($server, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // Lấy danh sách lịch hẹn
                $sql_appointments = "SELECT maLichHen, ngayHen FROM LichHen";
                $result_appointments = $conn->query($sql_appointments);

                // Hiển thị danh sách lịch hẹn trong dropdown
                while ($row = $result_appointments->fetch_assoc()) {
                    echo "<option value='" . $row['maLichHen'] . "'>" . $row['ngayHen'] . "</option>";
                }

                // Đóng kết nối
                $conn->close();
                ?>

            </select><br>
            <!-- Hiển thị thông tin chi tiết lịch hẹn khi chọn -->
            <?php
            if (isset($_POST['selected_appointment_id'])) {
                $selected_appointment_id = $_POST['selected_appointment_id'];

                // Kết nối database
                $conn = new mysqli($server, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // Lấy thông tin chi tiết của lịch hẹn đã chọn
                $sql_selected_appointment = "SELECT * FROM LichHen WHERE maLichHen = '$selected_appointment_id'";
                $result_selected_appointment = $conn->query($sql_selected_appointment);
                // Đóng kết nối
                $conn->close();
            }
            ?>

            <!-- Các trường dữ liệu cần sửa -->
            <!-- Thêm các trường cần sửa tại đây -->
            <input type="submit" name="edit_submit" value="Sửa Lịch Hẹn">
        </form>


        <!-- Form Xóa Lịch Hẹn -->
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

        // Xử lý khi biểu mẫu được gửi đi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy Mã Lịch Hẹn từ biểu mẫu
            $maLichHen = $_POST["maLichHen"];

            // Truy vấn để lấy thông tin về lịch hẹn cần xóa
            $sql = "SELECT * FROM LichHen WHERE maLichHen = $maLichHen";
            $result = $conn->query($sql);

            // Kiểm tra và hiển thị thông tin
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h3>Thông tin Lịch Hẹn cần xóa:</h3>";
                echo "<p>Mã Lịch Hẹn: " . $row["maLichHen"] . "</p>";
                echo "<p>Mã Khách Hàng: " . $row["maKhachHang"] . "</p>";
                // Các thông tin khác tương tự
                echo "<form method='post' action='xoa_lich_hen.php'>";
                echo "<input type='hidden' name='maLichHen' value='" . $row["maLichHen"] . "'>";
                echo "<button type='submit'>Xóa Lịch Hẹn</button>";
                echo "</form>";
            } else {
                echo "Không tìm thấy thông tin cho Mã Lịch Hẹn: $maLichHen";
            }
        }
        ?>
        <form action="./model/lichhen/xoalichhen.php" method="post">
            <label for="maLichHen">Chọn Mã Lịch Hẹn:</label>
            <select id="maLichHen" name="maLichHen" required>
                <?php
                // Truy vấn để lấy danh sách Mã Lịch Hẹn
                $sql = "SELECT maLichHen FROM LichHen";
                $result = $conn->query($sql);

                // Hiển thị danh sách trong phần tử select
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["maLichHen"] . "'>" . $row["maLichHen"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Không có dữ liệu</option>";
                }
                ?>
            </select>
            <button type="submit">Xem thông tin và Xóa</button>
        </form>

        <!-- Bảng hiển thị danh sách lịch hẹn -->
        <table>
            <tr>
                <th>ID</th>
                <th>Tên Khách hàng</th>
                <th>Xe</th>
                <th>Nhân viên</th>
                <th>Ngày hẹn</th>
                <th>Mục đích</th>
                <th>Dịch Vụ</th>
            </tr>

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
            // Xử lý hiển thị danh sách lịch hẹn
            $sql_appointments = "SELECT LichHen.maLichHen, KhachHang.hoTen AS hoTenKhachHang, Xe.moHinh, Xe.bienSo, NhanVien.hoTen AS tenNhanVien, LichHen.ngayHen, LichHen.mucDich, DichVu.tenDichVu
                FROM LichHen
                INNER JOIN KhachHang ON LichHen.maKhachHang = KhachHang.maKhachHang
                INNER JOIN Xe ON LichHen.maXe = Xe.maXe
                INNER JOIN NhanVien ON LichHen.maNhanVien = NhanVien.maNhanVien
                LEFT JOIN DichVu ON LichHen.maDichVu = DichVu.maDichVu"; // LEFT JOIN với DichVu để lấy thông tin dịch vụ

            $result_appointments = $conn->query($sql_appointments);

            // Hiển thị danh sách lịch hẹn trong bảng
            foreach ($result_appointments as $appointment) {
                echo '<tr>';
                echo '<td>' . $appointment['maLichHen'] . '</td>';
                echo '<td>' . $appointment['hoTenKhachHang'] . '</td>';
                echo '<td>' . $appointment['moHinh'] . ' - ' . $appointment['bienSo'] . '</td>';
                echo '<td>' . $appointment['tenNhanVien'] . '</td>';
                echo '<td>' . $appointment['ngayHen'] . '</td>';
                echo '<td>' . $appointment['mucDich'] . '</td>';
                echo '<td>' . $appointment['tenDichVu'] . '</td>'; // Hiển thị tên dịch vụ
                echo '</tr>';
            }

            $conn->close();
            ?>
        </table>
    </section>
</body>

</html>