<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="shortcut icon" href="../../../images/logo-nobg.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../view/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../../view/js/tailwindcss.js"></script>
    <script src="../../../view/js/all.js"></script>
</head>
<?php
session_start();
error_reporting(1);

if (isset($_POST["action"])) {
    $value = explode("/", $_POST["action"]);
    $action = $value[0];
    $dishID = $value[1];

    foreach ($_SESSION["cart"] as &$item) {
        if ($item["id"] == $dishID) {
            if ($action == "increase") {
                $item["quantity"]++;
            } elseif ($action == "decrease" && $item["quantity"] > 1) {
                $item["quantity"]--;
            }

            $item["total"] = $item["quantity"] * $item["price"];
            break;
        }
    }
    unset($item);
}

if (isset($_POST["btndel"])) {
    $dishID = $_POST["btndel"];
    foreach ($_SESSION["cart"] as $key => $item) {
        if ($item["id"] == $dishID) {
            unset($_SESSION["cart"][$key]);
            break;
        }
    }

    if (count($_SESSION["cart"]) == 0)
        unset($_SESSION["cart"]);
}

if (isset($_POST["clear"]) || !isset($_SESSION["cart"])) {
    unset($_SESSION["cart"]);
}
?>

<body>
    <div class="box-1">
    <div
        class="fixed top-5 left-5 px-3 py-1 bg-gray-200 rounded-lg w-12 h-8 btn-one hover:w-fit overflow-hidden linear transition-all delay-200">
        <a href="../../../index.php?p=dish">
            <i class="fa-solid fa-arrow-left mr-2"></i>Tiếp tục đặt món
        </a>
    </div>
    </div>

    <h2 class="my-8 font-bold text-center text-3xl text-[#EF5350] w-3/5 mx-auto">Giỏ Hàng</h2>
    <form action="" method="POST" class="">
        <div class="w-2/3 flex mx-auto shadow rounded-lg border-amber-400 border-2">
            <div class="p-8 w-2/3 border-r-2 border-amber-400 flex flex-col">
                <?php
                $total = 0;

                if (isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $cart) {
                        echo "<div class='flex justify-between items-center border-b pb-4 mb-4'>";
                        echo "<img alt='" . $cart["name"] . "' class='w-20 h-20 object-cover rounded' height='100' width='100' src='../../../images/dish/" . $cart["image"] . "' />";
                        echo "<div class='ml-4 flex-1'>
                        <h3 class='text-lg font-semibold'>" . $cart["name"] . "</h3>
                        <div class='flex items-center mt-2 w-full'>
                            <h4 class='text-gray-500 w-1/2'>" . number_format($cart["price"], 0, ".", ",") . " đ</h4>
                            <div class='flex w-fit items-center border rounded ml-2'>
                                <button type='submit' class='px-2 py-1 decrease' name='action' value='decrease/" . $cart["id"] . "'>-</button>
                                <span class='px-2'>" . $cart["quantity"] . "</span>
                                <button type='submit' class='px-2 py-1 increase' name='action' value='increase/" . $cart["id"] . "'>+</button>
                            </div>
                        </div>
                    </div>";
                        echo "<div class='text-right'>
                        <p class='text-lg font-semibold' name='totalAmount'>" . number_format($cart["total"], 0, ".", ",") . " đ</p>
                        <div class='mt-2'>
                            <button class='btn btn-secondary w-full' name='btndel' value='" . $cart["id"] . "'>
                                <i class='far fa-trash-alt mr-2'></i>Xóa
                            </button>
                        </div>
                    </div>";
                        echo "</div>";

                        $total += $cart["total"];
                    }
                } else
                    echo "<div class='flex justify-center items-center w-full h-full text-gray-400'>Giỏ hàng đang trống!</div>";
                ?>

            </div>
            <div class="w-1/3 p-8">
                <h3 class="font-bold text-2xl mb-3 pb-2 pl-3 border-b-2 border-l-8 border-amber-200">Thông tin thanh
                    toán
                </h3>
                <div class="">
                    <label for="name" class="form-label">Họ tên:</label>
                    <input type="text" name="" id="name" class="form-control mb-3">
                    <label for="address" class="form-label">Địa chỉ nhận:</label>
                    <input type="text" name="" id="address" class="form-control mb-4">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" name="" id="phone" class="form-control mb-4">
                </div>
                <div class="flex justify-between">
                    <h2 class='font-bold text-xl'>Tổng đơn:</h2>
                    <?php echo number_format($total, 0, ".", ",") . " đ"; ?>
                </div>
                <div class="mt-3 flex justify-between">
                    <button class="btn btn-secondary" name="clear">Xóa tất cả</button>
                    <button class="btn btn-danger" name="checkout">Thanh toán</button>
                </div>
                <div class='flex justify-between items-center'>
                </div>
            </div>
    </form>

</body>

</html>