<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/logo-nobg.png" type="image/x-icon">

    <!-- Font Awesome CSS -->
    <link href="view/css/all.css" rel="stylesheet" />

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="view/css/bootstrap.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="view/css/style.css">

    <!-- Tailwind CSS -->
    <script src="view/js/tailwindcss.js"></script>

    <!-- jQuery -->
    <script src="view/js/jquery.min.js"></script>

    <!-- Chart -->
    <script src="view/js/chart.js"></script>

    <!-- Font Awesome JS -->
    <script src="view/js/all.js"></script>

    <!-- Bootstrap JS (bundle includes Popper.js) -->
    <script src="view/js/bootstrap.bundle.min.js"></script>

    <style>
        header {
            padding: 10px 0;
            transition: all 0.15s linear;
        }

        .scrolled {
            box-shadow: 0 5px 10px 0 rgba(138, 155, 165, 0.15);
            padding: 2px 0;
            -webkit-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
        }

        #onTopBtn {
            display: none;
        }

        .modal-backdrop {
            z-index: -1;
        }

        .banner {
            height: 100vh;
            background-size: cover;
        }

        header .active {
            border-radius: 10px;
            border-bottom: 2px solid;
            border-color: var(--fourth-color);
            opacity: 0.7;
            transition: all 0.2s ease;
        }

        .nav-item {
            position: relative;
            transition: all 200ms linear;
        }

        .nav-link:hover {
            border-radius: 10px;
            border-bottom: 2px solid;
            border-color: var(--fourth-color);
            opacity: 0.7;
            transition: all 0.2s ease;
        }

        .nav-item .dropdown-menu {
            transform: translate3d(0, 10px, 0);
            visibility: hidden;
            opacity: 0;
            max-height: 0;
            display: block;
            padding: 0;
            margin: 0;
            transition: all 200ms linear;
        }

        .nav-item:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            max-height: 999px;
            transform: translate3d(0, 0, 0);
        }

        .dropdown-menu {
            padding: 10px !important;
            left: -8%;
            margin: 0;
            font-size: 16px;
            letter-spacing: 1px;
            color: #212121;
            background-color: #fcfaff;
            border: none;
            border-radius: 3px;
            box-shadow: 0 5px 10px 0 rgba(138, 155, 165, 0.15);
            transition: all 200ms linear;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-item {
            padding: 3px 12px;
            color: #212121;
            border-radius: 2px;
            transition: all 200ms linear;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            color: #fff;
            background-color: rgba(129, 103, 169, .6);
        }
    </style>
</head>

<?php
if (isset($_POST["btnlogin"])) {
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

        if ($email == $row["email"] && $psw == $row["password"]) {
            $_SESSION["userName"] = $row["userName"];
            switch ($row["roleID"]) {
                case 1:
                    echo "<script>window.location.href = 'view/page/admin/index.php'</script>";
                    break;
                case 2:
                    echo "<script>window.location.href = 'view/page/manager/index.php'</script>";
                    break;
                case 3:
                    echo "Nhân viên nhận đơn";
                    break;
                case 4:
                    echo "Nhân viên bếp";
                    break;
            }
        }
    }
}
?>

<body style="scroll-behavior: smooth; font-family: 'Playwrite DE Grund', cursive; background-color: var(--third-color);">
    <header class="fixed w-full top-0 z-10">
        <div class="container mx-auto px-6">
            <nav class="navbar navbar-expand-md">
                <a class="" href="index.php"><img src="images/logo-nobg.png" alt="" class="h-16 rounded-full"></a>
                <ul class="nav ml-auto py-4 py-md-0">
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="index.php" id="home">Trang chủ</a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link dropdown-toggle" href="index.php?p=dish" id="dish">Thực đơn</a>
                        <div class="dropdown-menu">
                            <?php
                            $ctrl = new cCategories();
                            $ctrl->showCategoriesHeader("SELECT * FROM dish GROUP BY dishCategory");
                            ?>
                        </div>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="index.php?p=partyorder" id="partyorder">Dịch vụ</a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="index.php?p=discount" id="discount">Khuyến mãi</a>
                    </li>
                </ul>
                <ul class="nav ml-auto py-4 py-md-0">
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <a class="nav-link" href="#" id="cart"><i class="fas fa-shopping-cart text-xl"> </i></a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4" data-bs-toggle="modal" data-bs-target="#userModal">
                        <a class="nav-link" href="#" id="user"><i class="fas fa-user text-xl"> </i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="modal modalCart" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="cartModalLabel" style="color: #E67E22;">Giỏ hàng</h2>
                    </div>
                    <div class=" modal-body">
                        <div class="flex items-center border-b pb-4 mb-4">
                            <img alt="Blue T-shirt" class="w-20 h-20 object-cover rounded" height="100" src="images/dish/burgerbo.png" width="100" />
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-semibold">Burger bò</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-gray-500"></span>
                                    <div class="flex items-center border rounded">
                                        <button type="button" class="px-2 py-1" onclick="increase()">-</button>
                                        <span class="px-2" id="quantityCart"></span>
                                        <button type="button" class="px-2 py-1" onclick="decrease()">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-semibold">30,000 đ</p>
                                <div class="mt-2">
                                    <button class="btn btn-secondary w-full">
                                        <i class="far fa-trash-alt"></i>Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" name="btntt">Thanh toán</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modalUser" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="cartModalLabel" style="color: #E67E22;">Đăng nhập</h2>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="email" class="w-full py-2"><b>Email</b></label>
                            <input type="email" class="w-full form-control" placeholder="Địa chỉ email" name="email" id="email" required>
                        </div>

                        <div>
                            <label for="psw" class="w-full py-2"><b>Password</b></label>
                            <input type="password" class="w-full form-control" placeholder="Mật khẩu" name="psw" id="psw" required>
                        </div>

                        <div class="text-right text-sm text-red-400 my-2">
                            <a href="">Quên mật khẩu?</a>
                        </div>

                        <div class="flex justify-center items-center text-sm mt-4">
                            <p>Chưa có tài khoản? <a href="" class="text-blue-600">Đăng ký</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnlogin">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="banner w-full flex items-center relative">
        <div id="carousel" class="carousel slide w-full" data-bs-ride="carousel">
            <div class="carousel-indicators" id="ci">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="images/banner.png" class="d-block w-100" alt="images/banner.png">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/banner2.png" class="d-block w-100" alt="images/banner2.png">
                </div>
                <div class="carousel-item">
                    <img src="images/banner3.png" class="d-block w-100" alt="images/banner3.png">
                </div>
            </div>
        </div>
    </div>

    <div class="search absolute top-52 left-16">
        <form action="" method="post" class="form-search">
            <section class="content-home">
                <h1 class="text-center my-4 leading-relaxed text-5xl">THÈM MÓN GÌ, <br> <span id="text">NGẠI CHI MÀ KHÔNG NÓI?</span></h1>
                <div class="content w-full flex justify-center text-xl">
                    <div class="flex justify-center items-center input-group w-full h-14 mr-3">
                        <input type="search" name="search" id="" class="form-control h-14 pl-8 text-xl" autocomplete="false" value="<?php echo $_POST['search']; ?>">
                        <button type="submit" class="btn btn-danger btn-search h-full px-8 text-xl font-bold" name="btn">Tìm</button>
                    </div>
            </section>
        </form>
    </div>

    <?php
    $input = "";
    if (isset($_REQUEST["btn"])) {
        $input = $_POST["search"];

        if ($input != "") {
            $sql = "SELECT * FROM dishes WHERE dishName LIKE '%" . $input . "%'";
            $result = $conn->query($sql);
            $n = $result->num_rows;

            echo "<section class='output-search border-t border-gray-500 my-16' id='search-output'>
            <h2 class='border-b border-gray-500 text-2xl font-bold px-2 py-4'>KẾT QUẢ DÀNH CHO: " . $input . "</h2>";

            if ($n > 0) {
                echo "<div class='grid grid-cols-3 gap-x-14 gap-y-10 my-4'>";
                while ($row = $result->fetch_assoc()) {
                    echo "
                <div class='card w-full'>
                  <a href='?i=" . $row["dishID"] . "'>
                    <img src='images/dish/" . $row["image"] . "' class='card-img-top h-64' alt=''>
                    <div class='card-body flex justify-between items-center'>
                      <h5 class='card-title font-bold'>" . $row["dishName"] . "</h5>
                      <a href='#' class='btn btn-outline-info'>Xem thêm</a>
                    </div>
                  </a>
              </div>
              ";
                }
                echo "</div>";
            } else {
                echo "<div class='grid w-full my-4'><h5 class='font-bold'>Xin lỗi! Chúng tôi không tìm thấy kết quả bạn cần!</h5></div>";
                $_POST["search"] = "";
            }
            echo "</section>";
        }
    } else
        $_POST["search"] = "";
    ?>