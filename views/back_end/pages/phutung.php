<!-- phutung.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/phutung.css">
    <title>Quản lý Phụ Tùng</title>
    <head>
    <title>Xem Danh Sách Phụ Tùng</title>
    <style>
        #zone7 button {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        #zone7 button:hover {
            background-color: #45a049;
        }
    </style>
</head>
</head>

<body>
    <section id="zone7">
        <div class="container">
            <!-- Hiển thị danh sách phụ tùng -->
            <?php include './model/phutung/themphutung.php'; ?>

            <!-- select_part_to_edit.php -->
            <form action="./model/phutung/suaphutung.php" method="post">
                <h1>Chọn Phụ Tùng Cần Sửa</h1>
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
                <input type="submit" value="Chọn">
            </form>

            <h1>Chọn Phụ Tùng để Xóa</h1>

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

            // Lấy danh sách phụ tùng từ CSDL
            $sql = "SELECT maPhuTung, tenPhuTung FROM phutung";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<form method=\"post\" action=\"./model/phutung/xoa_phutung.php\">";
                echo "<label for=\"maPhuTung\">Chọn Phụ Tùng để Xóa:</label>";
                echo "<select name=\"maPhuTung\">";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"{$row['maPhuTung']}\">{$row['tenPhuTung']}</option>";
                }
                echo "</select>";
                echo "<br>";
                echo "<input type=\"submit\" name=\"submit\" value=\"Xác Nhận Xóa\">";
                echo "</form>";
            } else {
                echo "Không có phụ tùng để xóa.";
            }

            // // Đóng kết nối
            // $conn->close();
            ?>
            
            <?php include './model/phutung/hienthiphutung.php'; ?>


        </div>
    </section>

</body>

</html>
<!--  -->