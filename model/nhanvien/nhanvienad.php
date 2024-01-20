<?php
include('../connection/connection.php');
// Xử lý thêm Nhân viên
if (isset($_POST["addEmployee"])) {
    $hoTen = $_POST["hoTen"];
    $email = $_POST["email"];
    $soDienThoai = $_POST["soDienThoai"];
    $chucVu = $_POST["chucVu"];
    $diaChi = $_POST["diaChi"];

    $sql = "INSERT INTO nhanvien (hoTen, email, soDienThoai, chucVu, diaChi) VALUES ('$hoTen', '$email', '$soDienThoai', '$chucVu', '$diaChi')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm Nhân Viên thành công!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý sửa thông tin Nhân viên
if (isset($_POST["editEmployee"])) {
    $maNhanVien = $_POST["maNhanVien"];
    $hoTen = $_POST["hoTen"];
    $email = $_POST["email"];
    $soDienThoai = $_POST["soDienThoai"];
    $chucVu = $_POST["chucVu"];
    $diaChi = $_POST["diaChi"];

    $sql = "UPDATE nhanvien SET hoTen='$hoTen', email='$email', soDienThoai='$soDienThoai', chucVu='$chucVu', diaChi='$diaChi' WHERE maNhanVien='$maNhanVien'";

    if ($conn->query($sql) === TRUE) {
        echo "Sửa thông tin Nhân Viên thành công!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý xóa Nhân viên
if (isset($_POST["deleteEmployee"])) {
    $maNhanVien = $_POST["maNhanVien"];

    $sql = "DELETE FROM nhanvien WHERE maNhanVien='$maNhanVien'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa Nhân Viên thành công!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý tìm kiếm Nhân viên
if (isset($_POST["searchEmployee"])) {
    $searchName = $_POST["searchName"];

    $sql = "SELECT maNhanVien, hoTen, email, soDienThoai, chucVu, diaChi FROM nhanvien WHERE hoTen LIKE '%$searchName%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hiển thị kết quả tìm kiếm
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["maNhanVien"] . "</td>
                    <td>" . $row["hoTen"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["soDienThoai"] . "</td>
                    <td>" . $row["chucVu"] . "</td>
                    <td>" . $row["diaChi"] . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Không có kết quả tìm kiếm.</td></tr>";
    }
}

// Hiển thị danh sách Nhân viên
// $sql = "SELECT maNhanVien, hoTen, email, soDienThoai, chucVu, diaChi FROM nhanvien";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Hiển thị dữ liệu Nhân viên trong bảng
//     while ($row = $result->fetch_assoc()) {
//         echo "<tr>
//                 <td>" . $row["maNhanVien"] . "</td>
//                 <td>" . $row["hoTen"] . "</td>
//                 <td>" . $row["email"] . "</td>
//                 <td>" . $row["soDienThoai"] . "</td>
//                 <td>" . $row["chucVu"] . "</td>
//                 <td>" . $row["diaChi"] . "</td>
//               </tr>";
//     }
// } else {
//     echo "<tr><td colspan='6'>Không có Nhân Viên nào.</td></tr>";
// }

// Đóng kết nối
$conn->close();
?>
