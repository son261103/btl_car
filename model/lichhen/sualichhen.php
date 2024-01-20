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

// Lấy dữ liệu cho dropdown Khách Hàng từ CSDL
$sql_select_customers = "SELECT maKhachHang, hoTen FROM KhachHang";
$result_customers = $conn->query($sql_select_customers);

// Lấy dữ liệu cho dropdown Nhân Viên từ CSDL
$sql_select_employees = "SELECT maNhanVien, hoTen FROM NhanVien";
$result_employees = $conn->query($sql_select_employees);

// Lấy dữ liệu cho dropdown Dịch Vụ từ CSDL
$sql_select_services = "SELECT maDichVu, tenDichVu FROM DichVu";
$result_services = $conn->query($sql_select_services);

// Lấy dữ liệu cho dropdown Xe từ CSDL
$sql_select_cars = "SELECT maXe, moHinh, bienSo FROM Xe";
$result_cars = $conn->query($sql_select_cars);

// Xử lý khi submit form sửa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_submit_form"])) {
    $edit_appointment_id = $_POST["edit_appointment_id"];
    $edit_customer_id = $_POST["edit_customer_id"];
    $edit_car_id = $_POST["edit_car_id"];
    $edit_employee_id = $_POST["edit_employee_id"];
    $edit_appointment_date = $_POST["edit_appointment_date"];
    $edit_purpose = $_POST["edit_purpose"];
    $edit_service_id = $_POST["service_id"];

    // Lấy giá trị từ các trường input ẩn
    $edit_customer_id_hidden = $_POST["edit_customer_id_hidden"];
    $edit_car_id_hidden = $_POST["edit_car_id_hidden"];
    $edit_employee_id_hidden = $_POST["edit_employee_id_hidden"];

    // Thực hiện cập nhật lịch hẹn
    $sql_update_appointment = "UPDATE LichHen 
                               SET maKhachHang = '$edit_customer_id', 
                                   maXe = '$edit_car_id', 
                                   maNhanVien = '$edit_employee_id', 
                                   ngayHen = '$edit_appointment_date', 
                                   mucDich = '$edit_purpose',
                                   maDichVu = '$edit_service_id'
                               WHERE maLichHen = '$edit_appointment_id'
                               AND maKhachHang = '$edit_customer_id_hidden' 
                               AND maXe = '$edit_car_id_hidden' 
                               AND maNhanVien = '$edit_employee_id_hidden'";

    if ($conn->query($sql_update_appointment) === TRUE) {
        // Điều hướng hoặc thông báo thành công
        //header("Location: ./lichhen.html");
        //exit();
        echo "Sửa thành công!";
    } else {
        // Xử lý lỗi khi cập nhật vào CSDL
        echo "Lỗi: " . $sql_update_appointment . "<br>" . $conn->error;
    }
}

// Lấy dữ liệu cần sửa từ CSDL và hiển thị form với dữ liệu cũ
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_submit"])) {
    $edit_appointment_id = $_POST["edit_appointment_id"];

    // Lấy dữ liệu cần sửa từ CSDL
    $sql_select_appointment = "SELECT * FROM LichHen WHERE maLichHen = '$edit_appointment_id'";
    $result = $conn->query($sql_select_appointment);

    if ($result->num_rows > 0) {
        $appointment_data = $result->fetch_assoc();

        // Hiển thị form với dữ liệu cũ
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="edit_appointment_id" value="' . $edit_appointment_id . '">';

        // Dropdown cho Khách Hàng
        echo 'Khách Hàng: <select name="edit_customer_id" required>';
        while ($customer = $result_customers->fetch_assoc()) {
            $selected = ($customer['maKhachHang'] == $appointment_data['maKhachHang']) ? 'selected' : '';
            echo '<option value="' . $customer['maKhachHang'] . '" ' . $selected . '>' . $customer['hoTen'] . '</option>';
        }
        echo '</select><br>';

        // Dropdown cho Xe
        echo 'Xe: <select name="edit_car_id" required>';
        while ($car = $result_cars->fetch_assoc()) {
            $selected_car = ($car['maXe'] == $appointment_data['maXe']) ? 'selected' : '';
            echo '<option value="' . $car['maXe'] . '" ' . $selected_car . '>' . $car['moHinh'] . ' - ' . $car['bienSo'] . '</option>';
        }
        echo '</select><br>';

        // Dropdown cho Nhân Viên
        echo 'Nhân Viên: <select name="edit_employee_id" required>';
        while ($employee = $result_employees->fetch_assoc()) {
            $selected_employee = ($employee['maNhanVien'] == $appointment_data['maNhanVien']) ? 'selected' : '';
            echo '<option value="' . $employee['maNhanVien'] . '" ' . $selected_employee . '>' . $employee['hoTen'] . '</option>';
        }
        echo '</select><br>';

        echo 'Ngày Hẹn: <input type="text" name="edit_appointment_date" value="' . $appointment_data['ngayHen'] . '"><br>';
        echo 'Mục Đích: <input type="text" name="edit_purpose" value="' . $appointment_data['mucDich'] . '"><br>';

        // Dropdown cho Dịch Vụ
        echo 'Dịch Vụ: <select name="service_id" required>';
        while ($service = $result_services->fetch_assoc()) {
            $selected_service = ($service['maDichVu'] == $appointment_data['maDichVu']) ? 'selected' : '';
            echo '<option value="' . $service['maDichVu'] . '" ' . $selected_service . '>' . $service['tenDichVu'] . '</option>';
        }
        echo '</select><br>';

        // Thêm các trường input ẩn để giữ giá trị của các thuộc tính không hiển thị
        echo '<input type="hidden" name="edit_customer_id_hidden" value="' . $appointment_data['maKhachHang'] . '">';
        echo '<input type="hidden" name="edit_car_id_hidden" value="' . $appointment_data['maXe'] . '">';
        echo '<input type="hidden" name="edit_employee_id_hidden" value="' . $appointment_data['maNhanVien'] . '">';

        echo '<input type="submit" name="edit_submit_form" value="Lưu">';
        echo '</form>';
    }
}

$conn->close();
?>
