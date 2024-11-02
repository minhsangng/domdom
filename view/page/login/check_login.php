<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== 1) {
    echo "<script>alert('Bạn phải đăng nhập mới có quyền truy cập');</script>";
    echo "<script>window.location.href = '../login/';</script>";
    exit();
}
?>