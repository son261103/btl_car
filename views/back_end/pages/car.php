<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/car.css">
    <title>Quản lý Xe</title>
</head>

<body>

    <section id="zone4">
        <h2>Danh sách Xe</h2>

        <table>
            <tr>
                <th>Mã Xe</th>
                <th>Mã Khách Hàng</th>
                <th>Hãng Sản Xuất</th>
                <th>Mô Hình</th>
                <th>Năm Sản Xuất</th>
                <th>Biển Số</th>
                <th>Hình Ảnh</th>
                <th>Thao tác</th>
            </tr>
            <?php
            include('./model/connection/connection.php');

            // Truy vấn cơ sở dữ liệu để lấy thông tin về xe
            $sql = "SELECT * FROM Xe";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["maXe"] . "</td>";
                    echo "<td>" . $row["maKhachHang"] . "</td>";
                    echo "<td>" . $row["hangSanXuat"] . "</td>";
                    echo "<td>" . $row["moHinh"] . "</td>";
                    echo "<td>" . $row["namSanXuat"] . "</td>";
                    echo "<td>" . $row["bienSo"] . "</td>";
                    echo "<td><img src='" . $row["hinhAnh"] . "' height='50' width='50'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Không có dữ liệu Xe</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <!-- thêm xe -->
        <h2>Thêm Xe Mới</h2>
        <form enctype="multipart/form-data" method="post" action="./model/car/carad.php" class="add">
            <label for="maKhachHang">Mã Khách Hàng:</label>
            <input type="text" id="maKhachHang" name="maKhachHang"><br><br>

            <label for="hangSanXuat">Hãng Sản Xuất:</label>
            <input type="text" id="hangSanXuat" name="hangSanXuat"><br><br>

            <label for="moHinh">Mô Hình:</label>
            <input type="text" id="moHinh" name="moHinh"><br><br>

            <label for="namSanXuat">Năm Sản Xuất:</label>
            <input type="text" id="namSanXuat" name="namSanXuat"><br><br>

            <label for="bienSo">Biển Số:</label>
            <input type="text" id="bienSo" name="bienSo"><br><br>

            <label for="hinhAnh">Hình Ảnh:</label>
            <input type="file" id="hinhAnh" name="hinhAnh"><br><br>

            <input type="submit" value="Thêm Xe" name="add">
        </form>


        <h2>Xóa Xe</h2>
        <form method="post" action="./model/car/carad.php">
            <label for="xe_id">Nhập ID của xe cần xóa:</label><br>
            <input type="text" id="xe_id" name="xe_id" required><br><br>
            <input type="submit" name="delete" value="Xóa">
        </form>
    </section>

</body>

</html>