<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lịch hẹn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
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

// Xử lý thêm lịch hẹn
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $customer_id = $_POST["customer_id"];
    $car_id = $_POST["car_id"];
    $employee_id = $_POST["employee_id"];
    $appointment_date = $_POST["appointment_date"];
    $purpose = $_POST["purpose"];
    $service_id = $_POST["service_id"];  // Thêm dòng này để lấy giá trị của trường maDichVu

    // Thực hiện lưu lịch hẹn vào CSDL
    $sql_insert_appointment = "INSERT INTO LichHen (maKhachHang, maXe, maNhanVien, ngayHen, mucDich, maDichVu)
                            VALUES ('$customer_id', '$car_id', '$employee_id', '$appointment_date', '$purpose', '$service_id')";

    if ($conn->query($sql_insert_appointment) === TRUE) {
        // Thành công, điều hướng hoặc thông báo thành công
        //header("Location: ./lichhen.html");
        //exit();
        echo"Thêm Lịch Hẹn Thành Công";
    } else {
        // Xử lý lỗi khi thêm vào CSDL
        echo "Lỗi: " . $sql_insert_appointment . "<br>" . $conn->error;
    }
}

// Xử lý hiển thị danh sách lịch hẹn
$sql_appointments = "SELECT LichHen.maLichHen, KhachHang.hoTen AS hoTenKhachHang, Xe.moHinh, Xe.bienSo, NhanVien.hoTen AS tenNhanVien, LichHen.ngayHen, LichHen.mucDich
                    FROM LichHen
                    INNER JOIN KhachHang ON LichHen.maKhachHang = KhachHang.maKhachHang
                    INNER JOIN Xe ON LichHen.maXe = Xe.maXe
                    INNER JOIN NhanVien ON LichHen.maNhanVien = NhanVien.maNhanVien";
$result_appointments = $conn->query($sql_appointments);

$conn->close();
?>

<!-- Hiển thị danh sách lịch hẹn trong bảng -->
<table>
    <tr>
        <th>ID</th>
        <th>Tên Khách hàng</th>
        <th>Xe</th>
        <th>Nhân viên</th>
        <th>Ngày hẹn</th>
        <th>Mục đích</th>
    </tr>
    <?php
    foreach ($result_appointments as $appointment) {
        echo '<tr>';
        echo '<td>' . $appointment['maLichHen'] . '</td>';
        echo '<td>' . $appointment['hoTenKhachHang'] . '</td>';
        echo '<td>' . $appointment['moHinh'] . ' - ' . $appointment['bienSo'] . '</td>';
        echo '<td>' . $appointment['tenNhanVien'] . '</td>';
        echo '<td>' . $appointment['ngayHen'] . '</td>';
        echo '<td>' . $appointment['mucDich'] . '</td>';
        echo '</tr>';
    }
    ?>
</table>

</body>
</html>
