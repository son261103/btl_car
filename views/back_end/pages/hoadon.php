<!-- phutung.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/hoadon.css">
    <link rel="stylesheet" href="./public/css/khachhang.css">
    <title>Quản lý Phụ Tùng</title>
    <head>
    <title>Xem Danh Sách Phụ Tùng</title>
    <style>
        #zone8 button {
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        #zone8 button:hover {
            background-color: #45a049;
        }
        #zone8 body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #zone8 h2 {
            color: #333;
        }

        #zone8 table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #zone8 th, #zone8 td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #zone8 th {
            background-color: #f2f2f2;
        }

        #zone8 tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #zone8 a {
            color: #3498db;
            text-decoration: none;
            margin-right: 10px;
        }

        #zone8 a:hover {
            text-decoration: underline;
        }
    </style>
    </style>
</head>
</head>

<body>
    <section id="zone8">
        <div class="container">
            <!-- Hiển thị danh sách phụ tùng -->
            <?php include './model/hoadon/themhoadon.php'; ?>
            <!-- Hiển thị danh sách phụ tùng -->
            <?php include './model/hoadon/suahoadon.php'; ?>


        </div>
    </section>




    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>
<!--  -->