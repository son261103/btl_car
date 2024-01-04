<?php
include("./libs/includes/header.php");

include("./libs/includes/sidebar.php");

include("./libs/includes/navbar.php");

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'dashboard':
            # code...
            include "./views/back_end/pages/dashboard.php";
            break;
        case 'khachhang':
            # code...
            include "./views/back_end/pages/khachhang.php";
            break;
        case 'nhanvien':
            # code...
            include "./views/back_end/pages/nhanvien.php";
            break;
        case 'car':
            # code...
            include "./views/back_end/pages/car.php";
            break;
        case 'lichhen':
            # code...
            include "./views/back_end/pages/lichhen.php";
            break;
        case 'dichvu':
            # code...
            include "./views/back_end/pages/dichvu.php";
            break;
        case 'phutung':
            # code...
            include "./views/back_end/pages/phutung.php";
            break;
        case 'hoadon':
            # code...
            include "./views/back_end/pages/hoadon.php";
            break;
        default:
            # code...
            include "./views/back_end/pages/dashboard.php";
            break;
    }
} else {
    include "./views/back_end/pages/dashboard.php";
}


include("./libs/includes/footer.php");


?>
