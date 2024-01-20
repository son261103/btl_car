<?php
$serviceId = $_GET['serviceId'];

$conn = new mysqli('localhost:3306', 'root', '', 'sql_car');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_query($conn, "SET NAMES 'UTF8'");

$sql = "SELECT soLuong, gia FROM dichvu WHERE maDichVu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $serviceId);
$stmt->execute();
$stmt->bind_result($soLuong, $gia);
$stmt->fetch();
$stmt->close();
$conn->close();

// Check if the data is fetched successfully
if ($soLuong !== null && $gia !== null) {
    $jsonData = ['soLuong' => $soLuong, 'gia' => $gia];
    $jsonError = json_last_error();

    if ($jsonError === JSON_ERROR_NONE) {
        echo json_encode($jsonData);
    } else {
        echo json_encode(['error' => 'JSON encoding error', 'errorCode' => $jsonError, 'errorMessage' => json_last_error_msg()]);
    }
} else {
    echo json_encode(['error' => 'Data not found']);
}
?>
