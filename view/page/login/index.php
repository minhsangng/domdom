<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản trị hệ thống | Đăng nhập</title>
    <link rel="shortcut icon" href="../../../images/logo-nobg.png" type="image/x-icon" />

    <!-- Font Awesome CSS -->
    <link href="../../../view/css/all.css" rel="stylesheet" />

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../view/css/bootstrap.min.css" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="../../../view/css/style.css" />

    <!-- Tailwind CSS -->
    <script src="../../../view/js/tailwindcss.js"></script>

    <!-- jQuery -->
    <script src="../../../view/js/jquery.min.js"></script>

    <!-- Chart -->
    <script src="../../../view/js/chart.js"></script>

    <!-- Font Awesome JS -->
    <script src="../../../view/js/all.js"></script>

    <!-- Bootstrap JS (bundle includes Popper.js) -->
    <script src="../../../view/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: "Playwrite DE Grund", cursive;
        }
    </style>
</head>

<?php
session_start();
include("../../../model/connect.php");
$db = new Database;
$conn = $db->connect();

if (isset($_POST["btndn"])) {
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    
    if (empty($email) || empty($psw)) {
        echo "<script>alert('Thông tin chưa hợp lệ. Vui lòng nhập lại!');</script>";
    } else {
        $sql = "SELECT * FROM user WHERE roleID AND email = '$email' AND password = '$psw'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $_SESSION["userName"] = $row["userName"];
            $_SESSION["login"] = 1;

            switch ($row["roleID"]) {
                case 1:
                    echo "<script>window.location.href = '../admin/index.php'</script>";
                    break;
                case 2:
                    echo "<script>window.location.href = '../manager/index.php'</script>";
                    break;
                case 3:
                    echo "<script>window.location.href = '../orderstaff/index.php'</script>";
                    break;
                case 4:
                    echo "<script>window.location.href = '../kitchenstaff/index.php'</script>";
                    break;
            }
        } else {
            echo "<script>alert('Thông tin chưa hợp lệ. Vui lòng nhập lại!');</script>";
        }
    }
    
}
?>

<body class="bg-gray-100">
    <div class="flex h-screen w-full bg-white">
        <div class="w-1/3 h-5/6 shadow bg-transparent flex flex-col justify-center items-center p-10 mx-auto my-auto rounded-lg">
            <div class="mb-8 flex flex-col items-center justify-center">
                <img alt="Logo" class="mb-4 size-24" src="../../../images/logo-nobg.png" />
                <h1 class="text-2xl font-semibold mb-2">ĐĂNG NHẬP</h1>
                <p class="text-gray-500">Welcome back!</p>
            </div>
            <div class="w-full max-w-sm">
                <form action="" method="POST">
                    <div class="relative mb-4">
                        <i class="fas fa-user absolute left-4 top-3 text-gray-400"></i>
                        <input type="email" class="w-full border border-gray-300 py-2 px-5 rounded-lg form-control" name="email"
                            placeholder="Địa chỉ email" />
                    </div>
                    <div class="relative mb-4">
                        <i class="fas fa-lock absolute left-4 top-3 text-gray-400"></i>
                        <input type="password" class="w-full border border-gray-300 py-2 px-5 rounded-lg form-control" name="psw"
                            placeholder="Mật khẩu" />
                    </div>
                    <div class="flex justify-end items-center mb-4">
                        <a class="text-blue-500 text-sm" href="#"> Quên mật khẩu? </a>
                    </div>
                    <button class="w-full text-white py-2 px-4 rounded-lg btn btn-primary" name="btndn">
                        Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>