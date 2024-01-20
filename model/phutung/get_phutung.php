<h1>Chọn Phụ Tùng Cần Sửa</h1>

<form action="edit_part_info.php" method="post">
    <label for="partId">Chọn Phụ Tùng:</label>
    <select name="partId" id="partId">
        <?php
        // Kết nối đến cơ sở dữ liệu
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
        // Thực hiện truy vấn SQL để lấy danh sách phụ tùng từ cơ sở dữ liệu
        $sql = "SELECT maPhuTung, tenPhuTung FROM PhuTung";
        $result = mysqli_query($conn, $sql);

        // Hiển thị danh sách phụ tùng trong danh sách thả xuống
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value=\"{$row['maPhuTung']}\">{$row['tenPhuTung']}</option>";
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </select>

</form>