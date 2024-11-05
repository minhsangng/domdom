<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản trị hệ thống | QLCH</title>
    <link rel="shortcut icon" href="../../../images/logo-nobg.png" type="image/x-icon" />

    <!-- Font Awesome CSS -->
    <link href="../../css/all.css" rel="stylesheet" />

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="../../js/tailwindcss.js"></script>

    <!-- jQuery -->
    <script src="../../js/jquery.min.js"></script>

    <!-- Chart -->
    <script src="../../js/chart.js"></script>

    <!-- Font Awesome JS -->
    <script src="../../js/all.js"></script>

    <!-- Bootstrap Bundle JS  -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .activeAd {
            background-color: rgb(55 65 81);
            color: #FFF !important;
        }

        .subnav {
            display: none;
        }

        .user-container:hover .subnav {
            display: inline-block;
            width: 150px;
        }


        #calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .day {
            border: 1px solid #ccc;
            padding: 20px;
            position: relative;
            cursor: pointer;
        }

        .dot {
            width: 10px;
            height: 10px;
            background-color: orange;
            border-radius: 50%;
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: none;
        }

        .hidden {
            display: none;
        }

        #info {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }

        .pagination {
            margin-left: 40%;
            margin-bottom: 8%;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            text-align: center;
            border: 1px solid #DDD;
            border-radius: 5px;
            margin-right: 4px;
        }

        .pagination a.active {
            background-color: rgb(200,200,200);
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
            border-radius: 5px;
        }
        
        .swal2-icon {
            font-size: 1rem;
        }
        
        .swal2-title {
            font-size: 1.5rem;
        }
        
        .swal2-cancel {
            margin-right: 5px;
        }
        
        .swal2-confirm {
            margin-left: 5px;
        }
    </style>
</head>
<?php
/* Xử lý ban đầu */
error_reporting(1);
session_start();

/* Kết nói control */
include("../../../model/connect.php");
include("../../../controller/cCategories.php");
include("../../../controller/cPromotions.php");
include("../../../controller/cDishes.php");
include("../../../controller/cIngredients.php");
include("../../../controller/cOrders.php");
include("../../../controller/cMessage.php");

/* Xử lý đăng nhập */
if (!isset($_SESSION["login"]))
    echo "<script>window.location.href = '../login/';</script>";

/* Kết nối database */
$db = new Database();
$conn = $db->connect();

if (isset($_POST["btnxem"])) {
    $_SESSION["startM"] = $_POST["startM"];
    $_SESSION["endM"] = $_POST["endM"];

    $daystart = explode("-", $_SESSION["startM"]);
    $startM = implode("-", array($daystart[0], $daystart[1], $daystart[2]));
    $dayend = explode("-", $_SESSION["endM"]);
    $endM = implode("-", array($dayend[0], $dayend[1], $dayend[2]));
} else {
    $startM = date("Y-m-01");
    $endM = date("Y-m-t");
}

$startW = date("Y-m-d", strtotime("monday this week"));
$endW = date("Y-m-d", strtotime("sunday this week"));
?>

<body class="bg-gray-900" style="scroll-behavior: smooth; font-family: 'Playwrite DE Grund', cursive;">
    <div class="flex flex-col md:flex-row h-full" id="container">
        <div class=" w-full md:w-64">
            <div class="flex items-center justify-center h-20 w-full bg-gray-500 py-5">
                <a href="index.php">
                    <img src="../../../images/logo-nobg.png" alt="Logo" class="size-20">
                </a>
            </div>
            <nav class="mt-10">
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="admin" href="index.php">
                    <i class="fas fa-home mr-3"></i>Trang chủ
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="employee" href="index.php?i=employee">
                    <i class="fa-solid fa-users-gear mr-3"></i></i>Xem thông tin NV
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="ingredient" href="index.php?i=ingredient">
                    <i class="fa-solid fa-cubes mr-3"></i>Tính toán ng.liệu
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="revenue" href="index.php?i=revenue">
                    <i class="fa-solid fa-file-invoice-dollar mr-3"></i>Xem thống kê
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="shift" href="index.php?i=shift">
                    <i class="fa-regular fa-calendar-days mr-3"></i>Phân ca
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="attendance" href="index.php?i=attendance">
                    <i class="fa-solid fa-clock mr-3"></i>Chấm công
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="proposal" href="index.php?i=proposal">
                    <i class="fa-solid fa-paper-plane mr-3"></i>Đề xuất
                </a>
                <a href="#" onclick="logout()" class="flex items-center py-2 px-8 text-white border-y-2 bg-gray-700 border-gray-500 mt-4 hover:bg-gray-700 hover:text-white adnav">
                    <i class="fa-solid fa-right-from-bracket mr-3"></i>Đăng xuất
                </a>
            </nav>
        </div>
        <div class="bg-gray-100 flex-1 p-6 h-fit pb-2 md:p-10" id="right">
            <div class="flex justify-between items-center mb-6 hover:cursor-pointer">
                <div class="relative w-1/2 flex">
                    <input class="w-full py-2 px-4 mr-2 rounded-lg border border-gray-300" placeholder="Tìm kiếm..." type="text" />
                    <button type="submit" class="btn btn-primary ml-2 px-3">Tìm</button>
                </div>
                <div class="flex items-center hover:cursor-pointer">
                    <div class="ml-4 bg-blue-100 text-blue-500 p-2 rounded-full text-xl hover:bg-blue-500 hover:text-white">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <div class="ml-4 flex items-center relative user-container">
                        <img alt="User Avatar" class="rounded-full mr-1 border-solid border-2" height="40" width="40" src="../../../images/user.png" />
                        <span class="text-xs font-bold ml-1">
                            <?php
                            echo $_SESSION["userName"];
                            ?>
                        </span>
                    </div>
                </div>
            </div>


            <?php
            $i = "";
            if (isset($_REQUEST["i"])) {
                $i = $_REQUEST["i"];
            } else {
                $i = "home";
            }

            if ($i != "home") {
                require("" . $_REQUEST["i"] . "/index.php");
            } else {
                require("home/index.php");
            }
            ?>
        </div>
    </div>
    </div>

    <script>
        /* Nếu thoát khỏi trang sẽ xóa tất cả session - ngăn chặn truy cập khi chưa đăng nhập */
        document.addEventListener("DOMContentLoaded", () => {
            let targetUrl = "";
            let isFormSubmitting = false;

            document.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", function(event) {
                    targetUrl = event.currentTarget.href;
                });
            });

            document.querySelectorAll("form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    isFormSubmitting = true;
                });
            });

            let hasNavigatedAway = false;

            document.addEventListener("visibilitychange", () => {
                if (document.visibilityState === "hidden") {
                    hasNavigatedAway = true;
                }
            });

            window.addEventListener("beforeunload", (event) => {
                if (!isFormSubmitting && hasNavigatedAway && (!targetUrl || new URL(targetUrl).origin !== window.location.origin)) {
                    if (performance.navigation.type !== 1) {
                        navigator.sendBeacon("../logout/index.php");
                    }
                }
            });
        });

        function adjustContentHeight() {
            var rightSession = document.getElementById("right");

            if (document.body.scrollHeight > window.innerHeight) {
                rightSession.style.height = "";
            } else {
                rightSession.style.height = "100vh";
            }
        }

        window.onload = adjustContentHeight;

        window.onresize = adjustContentHeight;

        const navAd = document.querySelectorAll(".adnav");
        let idActiveAd = "admin";

        navAd.forEach(function(item) {
            item.addEventListener("click", () => {
                navAd.forEach((i) => i.classList.remove("activeAd"));
            });
        });

        if (window.location.search != "")
            idActiveAd = window.location.search.slice(3);
            
        if (window.location.search.includes("ingredient"))
            idActiveAd = "ingredient";

        window.addEventListener("load", () => {
            navAd.forEach(function(item) {
                if (item.id == idActiveAd) item.classList.add("activeAd");
                else item.classList.remove("activeAd");
            });
        });
        
        function logout() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Bạn chắc chắn muốn đăng xuất?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../logout/";
                }
            });
        }
    </script>
</body>

</html>