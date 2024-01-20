<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['maDichVu'])) {
    $maDichVu = $_GET['maDichVu'];
    ?>

    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác nhận xóa dịch vụ</title>
    </head>
    <body>

        <h2>Xác nhận xóa dịch vụ</h2>
        <p>Bạn có chắc chắn muốn xóa dịch vụ có mã <?php echo $maDichVu; ?> không?</p>

        <form action="./xoadichvu.php" method="post">
            <input type="hidden" name="maDichVu" value="<?php echo $maDichVu; ?>">
            <input type="submit" name="confirmDelete" value="Yes">
            <!-- <a href="./model/dichvu/">No</a> -->
        </form>

    </body>
    </html>

<?php
}
?>
