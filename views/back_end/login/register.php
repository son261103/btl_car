<?php
session_start();
include("../model/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $role = (strpos($email, '@company.com') !== false) ? 1 : 0;

    $sql_check = "SELECT * FROM Users WHERE username = ? OR email = ?";
    $stmt_check = $conn->prepare($sql_check);

    if ($stmt_check) {
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            echo "<script>alert('Tên đăng nhập hoặc email đã tồn tại');window.history.back();</script>";
            // Thông báo khi tên đăng nhập hoặc email đã tồn tại
        } else {
            $sql = "INSERT INTO Users (username, password, role, email) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param("ssis", $username, $password, $role, $email);
                $stmt->execute();

                echo "<script>alert('Đăng ký thành công');</script>";
                echo "window.location = '../views/login.html';</>";
                // Thông báo khi đăng ký thành công
            } else {    
                echo "<script>alert('Đã xảy ra lỗi');window.history.back();</script>";
                // Thông báo khi có lỗi xảy ra trong quá trình thực hiện truy vấn
            }
        }
        $stmt_check->close();
    } else {
        echo "<script>alert('Đã xảy ra lỗi');window.history.back();</script>";
        // Thông báo khi có lỗi xảy ra trong quá trình chuẩn bị truy vấn
    }

    $conn->close();
}
?>
