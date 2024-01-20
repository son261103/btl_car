<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/khachhang.css">
    <title>Quản lý Khách Hàng</title>
    <style>
        .zone1 body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .zone1 .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .zone1 h3 {
            margin: 1px 1.5rem;
            color: #2980b9;
        }

        .zone1 form,
        #dskh {
            margin-bottom: 20px;
            margin: 1px 1rem;
        }

        .zone1 form h3 {
            color: #2980b9;
        }

        .zone1 form label {
            display: block;
            margin-bottom: 5px;
        }

        .zone1 form input,
        .zone1 form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .zone1 button {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .zone1 button:hover {
            background-color: #2980b9;
        }

        .zone1 table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .zone1 table,
        .zone1 th,
        .zone1 td {
            border: 1px solid #ddd;
        }

        .zone1 th,
        .zone1 td {
            padding: 12px;
            text-align: left;
        }

        .zone1 th {
            background-color: #3498db;
            color: #fff;
        }

        .zone1 h1 {
            color: #2980b9;
            text-align: center;
            font-size: 2rem;
        }

        .zone1 .dskh {
            color: #3498db;
            font-size: 2rem;
            text-align: center;
        }

        .zone1 .themkh,
        .zone1 .suakh,
        .zone1 .xoakh {
            border-bottom: 2px solid #92C7CF;
        }
    </style>
</head>

<body>
    <section class="zone1">
        <h1>Quản lý Khách Hàng</h1>
        <form method="post" action="./model/khachhang/khachhangthemsuaxoa.php">
            <h3>Tìm Kiếm Khách Hàng</h3>
            Tìm Theo Tên: <input type="text" name="searchName">
            <button type="submit" name="searchCustomer">Tìm Kiếm</button>
        </form>
        <!-- Form for adding a new customer -->
        <form method="post" action="./model/khachhang/khachhangthemsuaxoa.php" class="themkh">
            <h3>Thêm Khách Hàng</h3>
            Ho Ten: <input type="text" name="hoTen" required><br>
            Email: <input type="text" name="email" required><br>
            So Dien Thoai: <input type="text" name="soDienThoai" required><br>
            Dia Chi: <textarea name="diaChi" required></textarea><br>
            <button type="submit" name="addCustomer">Thêm Khách Hàng</button>
        </form>
        <!-- Form for editing customer information -->
        <form method="post" action="./model/khachhang/khachhangthemsuaxoa.php" class="suakh">
            <h3>Sửa Thông Tin Khách Hàng</h3>
            Ma Khach Hang: <input type="text" name="maKhachHang" required><br>
            Ho Ten: <input type="text" name="hoTen" required><br>
            Email: <input type="text" name="email" required><br>
            So Dien Thoai: <input type="text" name="soDienThoai" required><br>
            Dia Chi: <textarea name="diaChi" required></textarea><br>
            <button type="submit" name="editCustomer">Sửa Thông Tin</button>
        </form>
        <!-- Form for deleting a customer -->
        <form method="post" action="./model/khachhang/khachhangthemsuaxoa.php" class="xoakh">
            <h3>Xóa Khách Hàng</h3>
            Ma Khach Hang: <input type="text" name="maKhachHang" required><br>
            <button type="submit" name="deleteCustomer">Xóa Khách Hàng</button>
        </form>
        <!-- Display customer list -->
        <div id="dskh">
            <h3 class="dskh">Danh sách Khách Hàng</h3>
            <table>
                <tr>
                    <th>Ma Khach Hang</th>
                    <th>Ho Ten</th>
                    <th>Email</th>
                    <th>So Dien Thoai</th>
                    <th>Dia Chi</th>
                </tr>
                <?php
                include("./model/khachhang/hienthikh.php");
                ?>
            </table>
        </div>
    </section>
</body>

</html>