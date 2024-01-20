<?php
session_start();

$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "sql_car";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_query($conn, "SET NAMES 'UTF8'");

// Lấy danh sách hóa đơn từ CSDL
$result = mysqli_query($conn, "SELECT * FROM HoaDon");

if (!$result) {
    die("Lỗi: " . mysqli_error($conn));
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $matkhau = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = ? and password = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $matkhau);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if(password_verify($matkhau,$user['password'])){
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Xác định quyền và chuyển hướng đến trang tương ứng
                if ($_SESSION['role'] == 1) {
                    setcookie('admin', $username, time() + (86400 * 30), '/');
                    ob_end_clean(); // Xóa output buffer nếu có
                    header('Location: ../../admin.php');
                    exit();
                } else {
                    setcookie('user', $username, time() + (86400 * 30), '/');
                    header("Location: ./user.php");
                    exit();
                }
            }
            } else {
                echo '<script>alert("Tài Khoản Hoặc Mật Khẩu Không Chính Xác!"); window.history.back();</script>';
                // Xử lý khi đăng nhập thất bại
            }
        } else {
            echo '<script>alert("Lỗi Truy Vấn CSDL!"); window.history.back();</script>';
            // Xử lý khi truy vấn không thành công
        }
    } else {
        echo '<script>alert("Tài Khoản Chưa Có Mời Tạo Tài Khoản!"); window.history.back();</script>';
        // Xử lý khi chuẩn bị truy vấn không thành công
    }

    $conn->close(); // Đóng kết nối CSDL sau khi sử dụng
}
?>
