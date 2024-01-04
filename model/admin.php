<?php
include("../includes/header.php");

include("../includes/sidebar.php");

include("../includes/navbar.php");

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'dashboard':
            # code...
            include "../includes/dashboard.php";
            break;
        case 'khachhang':
            # code...
            include "../includes/khachhang.php";
            break;
        case 'nhanvien':
            # code...
            include "../includes/nhanvien.php";
            break;
        case 'car':
            # code...
            include "../includes/car.php";
            break;
        case 'lichhen':
            # code...
            include "../includes/lichhen.php";
            break;
        case 'dichvu':
            # code...
            include "../includes/dichvu.php";
            break;
        case 'phutung':
            # code...
            include "../includes/phutung.php";
            break;
        case 'hoadon':
            # code...
            include "../includes/hoadon.php";
            break;
        default:
            # code...
            include "../includes/dashboard.php";
            break;
    }
} else {
    include "../includes/dashboard.php";
}


include("../includes/footer.php");


?>
