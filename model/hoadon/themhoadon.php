<h1>Quản Lý Hóa Đơn</h1>
<!-- Form thêm hóa đơn -->
<form method="post" action="./model/hoadon/xulythemhoadon.php" enctype="multipart/form-data" id="addInvoiceForm">
<h2>Thêm Hóa Đơn</h2>

    Nhân viên: <select name="maNhanVien" required>
        <!-- Đoạn mã PHP để lấy danh sách nhân viên từ CSDL và hiển thị ở đây -->
        <?php include './model/lichhen/get_nhanvien.php'; ?>
    </select><br>

    Khách hàng: <select name="maKhachHang" required>
        <!-- Đoạn mã PHP để lấy danh sách khách hàng từ CSDL và hiển thị ở đây -->
        <?php include './model/lichhen/get_customers.php'; ?>
    </select><br>

    Lịch hẹn: <select name="maLichHen" required>
        <!-- Đoạn mã PHP để lấy danh sách lịch hẹn từ CSDL và hiển thị ở đây -->
        <?php include './model/lichhen/get_appointments.php'; ?>
    </select><br>

    Xe: <select name="maXe" required onchange="updateCarInfo()">
        <!-- Đoạn mã PHP để lấy danh sách xe từ CSDL và hiển thị ở đây -->
        <?php include './model/lichhen/get_cars.php'; ?>
    </select><br>

    Dịch vụ: <select name="maDichVu" required onchange="updateServiceInfo()">
        <!-- Đoạn mã PHP để lấy danh sách dịch vụ từ CSDL và hiển thị ở đây -->
        <?php include './model/hoadon/get_dichvu.php'; ?>
    </select><br>

    <label for="partSelection">Chọn Phụ Tùng:</label>
    <select name="partSelection" id="partSelection" onchange="updatePartInfo()">
        <?php include 'get_parts.php'; ?>
    </select><br>

    Số Lượng Phụ Tùng: <input type="text" name="soLuongPhuTung" id="soLuongPhuTung" readonly><br>
    Giá Phụ Tùng: <input type="text" name="giaPhuTung" id="giaPhuTung" readonly><br>

    <!-- Nút submit để thêm hóa đơn -->
    <input type="submit" name="submit" value="Thêm Hóa Đơn">
</form>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#maXe").change(updateCarInfo);
        $("#partSelection").change(updatePartInfo);
        $("#maDichVu").change(updateServiceInfo);
    });

    function updateCarInfo() {
        var selectedCarId = $("#maXe").val();
        $("[id^='carImage_']").hide();
        $("#carImage_" + selectedCarId).show();
    }

    function updatePartInfo() {
        var selectedPartId = $("#partSelection").val();
        $.getJSON(`./model/hoadon/get_part_info.php?partId=${selectedPartId}`, function (data) {
            if (data) {
                $("#soLuongPhuTung").val(data.soLuong);
                $("#giaPhuTung").val(data.gia);
            } else {
                alert("Không thể lấy thông tin phụ tùng.");
            }
        }).fail(function (jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.log("Request Failed: " + err);
            alert("Lỗi khi lấy thông tin phụ tùng: " + err);
        });
    }

    function updateServiceInfo() {
        var selectedServiceId = $("#maDichVu").val();
        $.getJSON(`./model/hoadon/get_service_info.php?serviceId=${selectedServiceId}`, function (data) {
            if (data) {
                $("#soLuongDichVu").val(data.soLuong);
                $("#giaDichVu").val(data.gia);
            } else {
                alert("Không thể lấy thông tin dịch vụ.");
            }
        }).fail(function (jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.log("Request Failed: " + err);
            alert("Lỗi khi lấy thông tin dịch vụ: " + err);
        });
    }
</script>
