<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/nhanvien.css">
    <link rel="stylesheet" href="./public/css/khachhang.css">
    <title>Quản lý Nhân Viên</title>
</head>

<body>
    <section class="zone1">
        <section id="zone1" class="employee-management">
            <h1>Quản lý Nhân Viên</h1>
            <form method="post" action="./model/nhanvien/nhanvienad.php" class="search-employee">
                <h3>Tìm Kiếm Nhân Viên</h3>
                Tìm Theo Tên: <input type="text" name="searchName">
                <button type="submit" name="searchEmployee">Tìm Kiếm</button>
            </form>

            <form method="post" action="./model/nhanvien/nhanvienad.php" class="add-employee">
                <h3>Thêm Nhân Viên</h3>
                Ho Ten: <input type="text" name="hoTen" required><br>
                Email: <input type="text" name="email" required><br>
                So Dien Thoai: <input type="text" name="soDienThoai" required><br>
                Chuc Vu: <input type="text" name="chucVu" required><br>
                Dia Chi: <textarea name="diaChi" required></textarea><br>
                <button type="submit" name="addEmployee">Thêm Nhân Viên</button>
            </form>

            <form method="post" action="./model/nhanvien/nhanvienad.php" class="edit-employee">
                <h3>Sửa Thông Tin Nhân Viên</h3>
                Ma Nhan Vien: <input type="text" name="maNhanVien" required><br>
                Ho Ten: <input type="text" name="hoTen" required><br>
                Email: <input type="text" name="email" required><br>
                So Dien Thoai: <input type="text" name="soDienThoai" required><br>
                Chuc Vu: <input type="text" name="chucVu" required><br>
                Dia Chi: <textarea name="diaChi" required></textarea><br>
                <button type="submit" name="editEmployee">Sửa Thông Tin</button>
            </form>

            <form method="post" action="./model/nhanvien/nhanvienad.php" class="delete-employee">
                <h3>Xóa Nhân Viên</h3>
                Ma Nhan Vien: <input type="text" name="maNhanVien" required><br>
                <button type="submit" name="deleteEmployee">Xóa Nhân Viên</button>
            </form>
        </section>

        <section id="zone2" class="employee-management">
            <h1>Danh sách Nhân Viên</h1>
            <table>
                <tr>
                    <th>Ma Nhan Vien</th>
                    <th>Ho Ten</th>
                    <th>Email</th>
                    <th>So Dien Thoai</th>
                    <th>Chuc Vu</th>
                    <th>Dia Chi</th>
                </tr>
                <?php
                include('./model/connection/connection.php');
                $sql = "SELECT maNhanVien, hoTen, email, soDienThoai, chucVu, diaChi FROM nhanvien";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Hiển thị dữ liệu Nhân viên trong bảng
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
                    echo "<tr><td colspan='6'>Không có Nhân Viên nào.</td></tr>";
                }
                ?>
            </table>
        </section>
    </section>
</body>

</html>