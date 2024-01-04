<?php
include("../connection/connection.php");
// Handle add, edit, and delete operations
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addCustomer"])) {
    $hoTen = $_POST["hoTen"];
    $email = $_POST["email"];
    $soDienThoai = $_POST["soDienThoai"];
    $diaChi = $_POST["diaChi"];

    $sql = "INSERT INTO KhachHang (hoTen, email, soDienThoai, diaChi) VALUES ('$hoTen', '$email', '$soDienThoai', '$diaChi')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm khách hàng thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Handle edit operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editCustomer"])) {
    $maKhachHang = $_POST["maKhachHang"];
    $hoTen = $_POST["hoTen"];
    $email = $_POST["email"];
    $soDienThoai = $_POST["soDienThoai"];
    $diaChi = $_POST["diaChi"];

    $sql = "UPDATE KhachHang SET hoTen='$hoTen', email='$email', soDienThoai='$soDienThoai', diaChi='$diaChi' WHERE maKhachHang=$maKhachHang";

    if ($conn->query($sql) === TRUE) {
        echo "Sửa thông tin khách hàng thành công";
    } else {
        echo "Lỗi sửa thông tin: " . $conn->error;
    }
}

// Handle delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteCustomer"])) {
    $maKhachHang = $_POST["maKhachHang"];

    $sql = "DELETE FROM KhachHang WHERE maKhachHang=$maKhachHang";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa khách hàng thành công";
    } else {
        echo "Lỗi xóa khách hàng: " . $conn->error;
    }
}

if (isset($_POST['searchCustomer'])) {
    $searchName = $_POST['searchName'];

    // Truy vấn tìm kiếm khách hàng theo tên
    $query = "SELECT * FROM KhachHang WHERE hoTen LIKE '%$searchName%'";
    $result = mysqli_query($conn, $query);

    // Hiển thị kết quả tìm kiếm
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['maKhachHang'] . "</td>";
            echo "<td>" . $row['hoTen'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['soDienThoai'] . "</td>";
            echo "<td>" . $row['diaChi'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($conn);
    }
}


$conn->close();
