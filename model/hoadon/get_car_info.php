<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedCar = isset($_POST["selectedCar"]) ? $_POST["selectedCar"] : null;

    if ($selectedCar !== null) {
        // Thực hiện truy vấn SQL để lấy thông tin xe tương ứng
        // (Thay thế bằng mã truy vấn thực tế của bạn)
        $carInfo = "Thông tin xe cho xe $selectedCar";

        echo $carInfo;
    } else {
        echo "Vui lòng chọn một xe.";
    }
} else {
    echo "Invalid Request!";
}
?>
