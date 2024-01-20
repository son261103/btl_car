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
// Hiển thị danh sách xe
// $sql_display = "SELECT * FROM Xe";
// $result_display = $conn->query($sql_display);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Lấy thông tin từ form
        $maKhachHang = $_POST['maKhachHang'];
        $hangSanXuat = $_POST['hangSanXuat'];
        $moHinh = $_POST['moHinh'];
        $namSanXuat = $_POST['namSanXuat'];
        $bienSo = $_POST['bienSo'];

        // Xử lý hình ảnh
        $target_dir = "./img/";
        $target_file = $target_dir . basename($_FILES["hinhAnh"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra xem file hình ảnh có hợp lệ không
        $check = getimagesize($_FILES["hinhAnh"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Kiểm tra loại file hợp lệ (chỉ cho phép jpg, jpeg, png)
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            echo "Chỉ cho phép tải lên các file JPG, JPEG, PNG.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Xin lỗi, file của bạn không được tải lên.";
        } else {
            // Nếu hình ảnh hợp lệ, tiến hành tải lên và thêm vào cơ sở dữ liệu
            if (move_uploaded_file($_FILES["hinhAnh"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["hinhAnh"]["name"]) . " đã được tải lên.";

                // Thêm dữ liệu vào cơ sở dữ liệu
                $sql = "INSERT INTO Xe (maKhachHang, hangSanXuat, moHinh, namSanXuat, bienSo, hinhAnh) 
                        VALUES ('$maKhachHang', '$hangSanXuat', '$moHinh', '$namSanXuat', '$bienSo', '$target_file')";
                if ($conn->query($sql) === TRUE) {
                    echo "Thêm xe thành công!";
                } else {
                    echo "Lỗi: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Xin lỗi, có lỗi khi tải file của bạn lên.";
            }
        }
    } elseif (isset($_POST['edit'])) {
        // Xử lý sửa thông tin xe
        // Code xử lý sửa thông tin xe ở đây
    } elseif (isset($_POST['delete'])) {
        // Lấy ID của xe cần xóa từ form
        $xe_id_to_delete = $_POST['xe_id'];

        // Thực hiện câu lệnh xóa dữ liệu trong bảng Xe
        $sql_delete_car = "DELETE FROM Xe WHERE maXe = '$xe_id_to_delete'";

        if ($conn->query($sql_delete_car) === TRUE) {
            echo "Xóa xe thành công!";
        } else {
            echo "Lỗi khi xóa xe: " . $conn->error;
        }
    }
}

?>
