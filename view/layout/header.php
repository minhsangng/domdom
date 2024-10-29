<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/logo-nobg.png" type="image/x-icon">

    <!-- Font Awesome CSS -->
    <link href="view/css/all.css" rel="stylesheet" />

    <!-- Preconnect for Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo+2:400,800&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="view/css/bootstrap.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="view/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
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
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<body style="scroll-behavior: smooth; font-family: 'Playwrite DE Grund', cursive; background-color: var(--third-color);">
    <header class="fixed w-full top-0 z-50">
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
                            $ctrl = new cDishes;
                            
                            if ($ctrl->cGetAllCategory() != 0) {
                                $result = $ctrl->cGetAllCategory();
                                while ($row = $result->fetch_assoc()) {
                                    echo "<a class='dropdown-item' href='index.php?p=dish&c=".$row["dishCategory"]."&#ci'>" . $row["dishCategory"] . "</a>";
                                }
                            }
                            else echo "Không có dữ liệu!";
                            ?>
                        </div>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="index.php?p=partypackage" id="partypackage">Dịch vụ</a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="index.php?p=discount" id="discount">Khuyến mãi</a>
                    </li>
                </ul>
                <ul class="nav ml-auto py-4 py-md-0">
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4" data-bs-toggle="modal" data-bs-target="#cartModal" title="Giỏ hàng">
                        <a class="nav-link" href="#" id="cart"><i class="fas fa-shopping-cart text-xl"> </i></a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4" data-bs-toggle="modal" data-bs-target="#followModal" title="Theo dõi đơn hàng">
                        <a class="nav-link" href="#" id="flCart"><i class="fa-solid fa-eye text-lg"></i></a>
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
                                        <span class="px-2" id="quantityCart">2</span>
                                        <button type="button" class="px-2 py-1" onclick="decrease()">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-semibold">60,000 đ</p>
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
                        <button type="button" class="btn btn-danger" name="btntt" data-bs-toggle="modal" data-bs-target="#payModal">Đặt món</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal modalPay" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="payModalLabel" style="color: #E67E22;">Thông tin đơn hàng</h2>
                    </div>
                    <div class=" modal-body">
                        <div class="flex items-center border-b pb-4 mb-4">
                            <form action="" method="POST">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-1">Tên khách hàng</label>
                                                <input type="text" name="" id="" class="form-control mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-1">Số điện thoại</label>
                                                <input type="text" name="" id="" class="form-control mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-1">Địa chỉ</label>
                                                <input type="text" name="" id="" class="form-control mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-1">Email</label>
                                                <input type="email" name="" id="" class="form-control mb-2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="flex items-center border-b pb-4 mb-4">
                            <img alt="Blue T-shirt" class="w-20 h-20 object-cover rounded" height="100" src="images/dish/burgerbo.png" width="100" />
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-semibold">Burger bò</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-gray-500"></span>
                                    <div class="flex items-center border rounded">
                                        <button type="button" class="px-2 py-1" onclick="increase()">-</button>
                                        <span class="px-2" id="quantityCart">2</span>
                                        <button type="button" class="px-2 py-1" onclick="decrease()">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-semibold">60,000 đ</p>
                                <div class="mt-2">
                                    <button class="btn btn-secondary w-full">
                                        <i class="far fa-trash-alt"></i>Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="border-b pb-4 mb-4">
                            <div class="w-full">
                                <label for="" class="font-bold mt-2">Nhập mã khuyến mãi</label>
                                <input type="text" name="" id="" class="form-control mt-2">
                            </div>
                            <div class="w-full">
                                <label for="" class="font-bold mt-2">Ghi chú</label>
                                <input type="text" name="" id="" class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" name="btntt" data-bs-toggle="modal" data-bs-target="#checkoutModal">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal modalCheckout" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="checkoutModalLabel" style="color: #E67E22;">Thông tin thanh toán</h2>
                    </div>
                    <div class=" modal-body">
                        <div class="flex items-center border-b pb-4 mb-4">
                            <img alt="" class="w-20 h-20 object-cover rounded" height="100" src="images/dish/burgerbo.png" width="100" />
                            <div class="ml-4 flex justify-between items-center w-full">
                                <h3 class="text-lg font-semibold">Burger bò</h3>
                                <p class="px-2" id="quantityCart">x2</p>
                                <p class="text-lg font-semibold">60,000 đ</p>
                            </div>
                        </div>
                        <div class="border-b pb-4 mb-4">
                            <label for="" class="font-bold w-full mb-2">Phương thức thanh toán</label>
                            <ul class="w-full">
                                <li><input type="radio" name="" id="" class="mr-2">Ví điện tử</li>
                                <li><input type="radio" name="" id="" class="mr-2">Thẻ ngân hàng</li>
                            </ul>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-bold text-xl">Tổng đơn</p>
                            </div>
                            <div>
                                <p class="text-lg font-semibold">60,000 đồng</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" name="btntt" data-bs-toggle="modal" data-bs-target="#payModal">Thanh toán</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal modalFollow" id="followModal" tabindex="-1" aria-labelledby="followModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="followModalLabel" style="color: #E67E22;">Theo dõi đơn hàng</h2>
                    </div>
                    <div class=" modal-body">
                        <div class="w-full border-b pb-4 mb-4">
                            <label for="" class="font-bold text-lg mb-2">Nhập mã đơn hàng</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" name="btntt" data-bs-toggle="modal" data-bs-target="#followDetailModal">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal modalFollowDetail" id="followDetailModal" tabindex="-1" aria-labelledby="followDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="followDetailModalLabel" style="color: #E67E22;">Thông tin đơn hàng</h2>
                    </div>
                    <div class=" modal-body">
                        <div class="w-full border-b pb-4 mb-4">
                            <form action="" method="POST">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Mã đơn hàng</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="#DH012">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Ngày đặt</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="23-10-2024">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Tên món (gói tiệc)</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="Burger bò">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Số lượng</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Tổng tiền</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="60,000">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Ghi chú</label>
                                                <input type="text" name="" id="" class="form-control mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Trạng thái</label>
                                                <select type="text" name="" id="" class="form-control mb-2">
                                                    <option value="">Chờ chế biến</option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" name="btntt" data-bs-toggle="modal" data-bs-target="#payModal">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modalParty z-50" id="partyModal" tabindex="-1" aria-labelledby="partyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header flex justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="partyModalLabel" style="color: #E67E22;">Thông tin đặt tiệc</h2>
                    </div>
                    <div class=" modal-body">
                        <div class="w-full border-b pb-4 mb-4">
                            <form action="" method="POST">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Họ tên</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="Nguyễn Minh Sang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Số điện thoại</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="0926458232">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Email</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="sang@gmail.com">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Ngày diễn ra</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="26-10-2024">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Giờ diễn ra</label>
                                                <input type="text" name="" id="" class="form-control mb-2" value="14:00">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="" class="font-bold mb-2">Yêu cầu khác</label>
                                                <input type="text" name="" id="" class="form-control mb-2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="border-b pb-4 mb-4">
                            <label for="" class="font-bold w-full mb-2">Phương thức thanh toán</label>
                            <ul class="w-full">
                                <li><input type="radio" name="" id="" class="mr-2">Ví điện tử</li>
                                <li><input type="radio" name="" id="" class="mr-2">Thẻ ngân hàng</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" name="btntt" data-bs-toggle="modal" data-bs-target="#payModal">Xác nhận</button>
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