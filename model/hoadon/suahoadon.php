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

// Lấy danh sách hóa đơn từ CSDL
$result = mysqli_query($conn, "SELECT * FROM HoaDon");

if (!$result) {
    die("Lỗi: " . mysqli_error($conn));
}

// Đóng kết nối
$conn->close();
?>

<!-- Hiển thị danh sách hóa đơn để chọn -->
<h2>Chọn Hóa Đơn Cần Sửa Hoặc Xóa</h2>
<table border="1">
    <tr>
        <th>Mã Hóa Đơn</th>
        <th>Mã Nhân Viên</th>
        <th>Mã Khách Hàng</th>
        <th>Mã Lịch Hẹn</th>
        <th>Mã Xe</th>
        <th>Mã Dịch Vụ</th>
        <th>Ảnh Xe</th>
        <th>Số Lượng Phụ Tùng</th>
        <th>Giá Phụ Tùng</th>
        <th>Ngày Tạo</th>
        <th>Thao Tác</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $row['maHoaDon']; ?></td>
            <td><?php echo $row['maNhanVien']; ?></td>
            <td><?php echo $row['maKhachHang']; ?></td>
            <td><?php echo $row['maLichHen']; ?></td>
            <td><?php echo $row['maXe']; ?></td>
            <td><?php echo $row['maDichVu']; ?></td>
            <td><?php echo $row['anhXe']; ?></td>
            <td><?php echo $row['soLuongPhuTung']; ?></td>
            <td><?php echo $row['giaPhuTung']; ?></td>
            <td><?php echo $row['ngayTao']; ?></td>
            <td><a href="./model/hoadon/sua_hoadon.php?id=<?php echo $row['maHoaDon']; ?>">Sửa</a>
                <a href="./model/hoadon/xoahoadon.php?id=<?php echo $row['maHoaDon']; ?>">Xóa</a></td>
        </tr>
    <?php endwhile; ?>
</table>

