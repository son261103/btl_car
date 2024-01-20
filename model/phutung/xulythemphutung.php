<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "sql_car";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_query($conn, "SET NAMES 'UTF8'");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $tenPhuTung = $_POST["tenPhuTung"];
    $soLuong = $_POST["soLuong"];
    $gia = $_POST["gia"];
    $maKhachHang = $_POST["customer_id"];
    $maNhanVien = $_POST["employee_id"];
    $maLichHen = $_POST["appointment_id"];

    $uploadOk = 1;

    // Kiểm tra xem có tệp được chọn hay không
    if (isset($_FILES["anhPhuTung"]) && $_FILES["anhPhuTung"]["error"] === UPLOAD_ERR_OK) {
        $targetDirectory = "./img/";
        $originalFileName = basename($_FILES["anhPhuTung"]["name"]);
        $targetFile = $targetDirectory . $originalFileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra xem tệp đã tồn tại chưa
        $counter = 1;
        while (file_exists($targetFile)) {
            $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $counter . '.' . $imageFileType;
            $targetFile = $targetDirectory . $newFileName;
            $counter++;
        }

        // Kiểm tra kích thước tệp
        if ($_FILES["anhPhuTung"]["size"] > 500000) {
            echo "Tệp quá lớn.";
            $uploadOk = 0;
        }

        // Kiểm tra định dạng ảnh
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Chỉ chấp nhận các định dạng JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        // Kiểm tra uploadOk
        if ($uploadOk == 0) {
            echo "Tệp không được tải lên.";
        } else {
            if (move_uploaded_file($_FILES["anhPhuTung"]["tmp_name"], $targetFile)) {
                echo "Tệp " . basename($targetFile) . " đã được tải lên thành công.";
            } else {
                echo "Có lỗi xảy ra khi tải lên tệp.";
                $uploadOk = 0;
            }
        }
    } else {
        echo "Vui lòng chọn một tệp ảnh.";
        $uploadOk = 0;
    }

    // Nếu không có vấn đề với tệp tải lên, tiếp tục thêm phụ tùng vào CSDL
    if ($uploadOk) {
        // Thêm vào truy vấn SQL
        $sql_insert_part = "INSERT INTO PhuTung (tenPhuTung, soLuong, gia, maKhachHang, maNhanVien, maLichHen, anhPhuTung)
                           VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert_part);

        if ($stmt) {
            // Đặt các giá trị vào truy vấn và thực thi
            $stmt->bind_param("siiiiis", $tenPhuTung, $soLuong, $gia, $maKhachHang, $maNhanVien, $maLichHen, $targetFile);
            $stmt->execute();

            echo "Thêm Phụ Tùng Thành Công";
            $stmt->close();
        } else {
            // Xử lý lỗi khi thêm vào CSDL
            echo "Lỗi: " . $sql_insert_part . "<br>" . $conn->error;
        }
    }
}


