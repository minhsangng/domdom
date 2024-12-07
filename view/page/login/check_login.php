<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    echo "<script>alert('Bạn phải đăng nhập mới có quyền truy cập');</script>";
    echo "<script>window.location.href = '../login/';</script>";
    exit();
}

// Lấy role của user hiện tại
$currentRole = $_SESSION["role"];

// Lấy đường dẫn hiện tại
$currentPath = dirname($_SERVER['PHP_SELF']);
$allowedPath = "";

// Xác định đường dẫn được phép theo role
switch($currentRole) {
    case 1:
        $allowedPath = "/view/page/admin";
        break;
    case 2: 
        $allowedPath = "/view/page/manager";
        break;
    case 3:
        $allowedPath = "/view/page/orderstaff";
        break;
    case 4:
        $allowedPath = "/view/page/kitchenstaff";

        break;
    default:
        echo "<script>alert('Bạn không có quyền truy cập trang này');</script>";
        echo "<script>window.location.href = '../login/';</script>";
        exit();
}

// Kiểm tra quyền truy cập
if (strpos($currentPath, $allowedPath) === false) {
    echo "<script>alert('Bạn không có quyền truy cập trang này');</script>";
    echo "<script>window.location.href = '../login/';</script>";
    exit();
}
?>