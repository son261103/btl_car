<!-- Form Thêm Phụ Tùng -->
<form action="./model/phutung/xulythemphutung.php" method="post" enctype="multipart/form-data">
    <h2>Thêm Phụ Tùng</h2>

    <label for="customer_id">Khách hàng:</label>
    <select name="customer_id" required>
        <?php include './model/lichhen/get_customers.php'; ?>
    </select><br>

    <label for="employee_id">Nhân viên:</label>
    <select name="employee_id" required>
        <?php include './model/lichhen/get_nhanvien.php'; ?>
    </select><br>

    <label for="appointment_id">Lịch hẹn:</label>
    <select name="appointment_id" required>
    <?php include './model/lichhen/get_appointments.php'; ?>
    </select><br>

    <label for="tenPhuTung">Tên Phụ Tùng:</label>
    <input type="text" name="tenPhuTung" required><br>

    <label for="soLuong">Số Lượng:</label>
    <input type="number" name="soLuong" required><br>

    <label for="gia">Giá:</label>
    <input type="text" name="gia" required><br>

    <label for="anhPhuTung">Hình ảnh Phụ Tùng:</label>
    <input type="file" name="anhPhuTung" accept="image/*" required><br>

    <input type="submit" name="submit" value="Thêm Phụ Tùng">
</form>