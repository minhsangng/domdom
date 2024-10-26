<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản trị hệ thống | Nhân viên bếp</title>
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

    <!-- Bootstrap JS (bundle includes Popper.js) -->
    <script src="../../js/bootstrap.bundle.min.js"></script>

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

        #workshift {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<?php
error_reporting(1);
session_start();
include("../../../model/connect.php");
include("../../../controller/cCategories.php");
include("../../../controller/cPromotions.php");
include("../../../controller/cDishes.php");
include("../../../controller/cIngredients.php");

$db = new Database();
$conn = $db->connect();
?>

<body class="bg-gray-900" style="scroll-behavior: smooth; font-family: 'Playwrite DE Grund', cursive;">
    <div class="flex flex-col md:flex-row">
        <div class="w-fit md:w-64">
            <div class="flex items-center justify-center h-20 w-full bg-gray-500 py-5">
                <a href="index.php">
                    <img src="../../../images/logo-nobg.png" alt="Logo" class="size-20">
                </a>
            </div>
            <nav class="mt-10">
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="home" href="index.php?i=home">
                    <i class="fa-solid fa-home mr-3"></i>Trang chủ
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="ingredient" href="index.php?i=ingredient">
                    <i class="fa-solid fa-folder-plus mr-3"></i>Nhập nguyên liệu
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="update" href="index.php?i=update">
                    <i class="fa-solid fa-pen-to-square mr-3"></i>Cập nhật đơn hàng
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="shift" href="index.php?i=shift">
                    <i class="fa-regular fa-calendar-days mr-3"></i>Đăng ký ca làm
                </a>
                <a class="flex items-center py-2 px-8 text-gray-400 hover:bg-gray-700 hover:text-white adnav" id="info" href="index.php?i=info">
                    <i class="fa-solid fa-lightbulb mr-3"></i>Xem TT công việc
                </a>
            </nav>
        </div>
        <div class="bg-gray-100 flex-1 p-6 pb-2 md:p-10" id="right">
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
                            
                            $userName = $_SESSION["userName"];
                            
                            $sql = "SELECT userID FROM user WHERE userName = '$userName'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            
                            $_SESSION["userID"] = $row["userID"];
                            ?>
                        </span>

                        <div class="subnav absolute top-11 right-0 bg-white rounded-lg bg-gray-500 h-fit p-2 text-center border-2">
                            <a href="index.php?m=lgout">Đăng xuất <i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            $i = "";
            if (isset($_REQUEST["i"]))
                $i = $_REQUEST["i"];
            else
                $i = "home";

            if ($i != "home")
                require("" . $_REQUEST["i"] . "/index.php");
            else if ($i == "home")
                require("home/index.php");

            if (isset($_GET["m"])) {
                unset($_SESSION["userName"]);
                unset($_SESSION["login"]);
                echo "<script>window.location.href = '../login/'</script>";
            }
            ?>
        </div>
    </div>
    </div>

    <script>
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
        let idActiveAd = "home";

        navAd.forEach(function(item) {
            item.addEventListener("click", () => {
                navAd.forEach((i) => i.classList.remove("activeAd"));
            });
        });

        if (window.location.search != "")
            if (window.location.search.slice(3).includes("home"))
                idActiveAd = "home";
            else idActiveAd = window.location.search.slice(3);


        window.addEventListener("load", () => {
            navAd.forEach(function(item) {
                if (item.id == idActiveAd) item.classList.add("activeAd");
                else item.classList.remove("activeAd");
            });
        });

        function logout() {
            <?php
            unset($_SESSION["loginstaff"]);
            unset($_SESSION["name"]);
            ?>
        }
    </script>
</body>

</html>