<?php
$partId = $_GET['partId'];

$conn = new mysqli('localhost:3306', 'root', '', 'sql_car');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_query($conn, "SET NAMES 'UTF8'");

$sql = "SELECT soLuong, gia FROM phutung WHERE maPhuTung = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $partId);
$stmt->execute();
$stmt->bind_result($soLuong, $gia);
$stmt->fetch();
$stmt->close();
$conn->close();

echo json_encode(['soLuong' => $soLuong, 'gia' => $gia]);
?>
