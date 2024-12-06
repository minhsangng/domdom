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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<?php
session_start();
error_reporting(1);



include("../../../model/connect.php");
include("../../../model/mPromotions.php");
include("../../../controller/cPromotions.php");



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
                        <button type='submit' class='btn btn-secondary w-full' name='btndel' value='" . $cart["id"] . "'>
                            <i class='far fa-trash-alt mr-2'></i>Xóa
                        </button>
                    </div>
                </div>";
                        echo "</div>";

                        $total += $cart["total"];
                    }
                } else {
                    echo "<div class='flex justify-center items-center w-full h-full text-gray-400'>Giỏ hàng đang trống!</div>";
                }
                ?>

            </div>
            <div class="w-1/3 p-8">
                <h3 class="font-bold text-2xl mb-3 pb-2 pl-3 border-b-2 border-l-8 border-amber-200">Thông tin thanh toán</h3>
                <div>
                    <label for="name" class="form-label">Họ tên:</label>
                    <input type="text" name="name" id="name" class="form-control mb-3">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" name="phone" id="phone" class="form-control mb-4">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" id="email" class="form-control mb-4">
                    <label for="address" class="form-label">Địa chỉ nhận:</label>
                    <input type="text" name="address" id="address" class="form-control mb-4">
                </div>
                <div class="flex justify-between">
                    <h2 class='font-bold text-xl'>Tổng đơn:</h2>
                    <?php echo number_format($total, 0, ".", ",") . " đ"; ?>
                </div>
                <div class="mt-3 flex justify-between">
                    <button class="btn btn-secondary" name="clear">Xóa tất cả</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="fillModal()">Xác nhận</button>
                </div>
            </div>


            <div class="modal modalCheckout" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header justify-center">
                            <h2 class="modal-title fs-5 font-bold text-3xl" id="checkoutModalLabel" style="color: #E67E22;">Thông tin đơn hàng</h2>
                        </div>

                        <div class="modal-body">
                            <div class="TTKH mb-4">
                                <h3 style="color: #E67E22;">Thông tin khách hàng</h3>
                                <table class="table">
                                    <tr>
                                        <td>Họ tên:</td>
                                        <td id="modalName"></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại:</td>
                                        <td id="modalPhone"></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td id="modalEmail"></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ nhận:</td>
                                        <td id="modalAddress"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="TTDH mb-4">
                                <h3 style="color: #E67E22;">Thông tin đơn hàng</h3>
                                <table class="table">
                                    <tr>
                                        <td>Ngày tạo đơn:</td>
                                        <td>
                                            <?php echo date('d/m/Y H:i:s'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tổng số lượng món:</td>
                                        <td>
                                            <?php
                                            $sumofQuantity = 0;
                                            foreach ($_SESSION["cart"] as $cart) {
                                                $sumofQuantity += $cart["quantity"];
                                            }
                                            echo $sumofQuantity;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghi chú:</td>
                                        <td>
                                            <textarea name="note" id="note" class="form-control mb-4" rows="4"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="CTDH mb-4">
                                <h3 style="color: #E67E22;">Chi tiết đơn hàng</h3>
                                <?php
                                $totalAmount = 0;
                                foreach ($_SESSION["cart"] as $cart):
                                    $totalAmount += $cart['total'];
                                ?>
                                    <div class="d-flex justify-between align-items-center border-bottom pb-3 mb-3 cart-item" data-dish-id="<?php echo $cart['id']; ?>" data-dish-price="<?php echo $cart['price']; ?>" data-dish-quantity="<?php echo $cart['quantity']; ?>">
                                        <img src="../../../images/dish/<?php echo $cart['image']; ?>" alt="<?php echo $cart['name']; ?>" class="w-20 h-20 object-cover rounded" width="100" height="100">
                                        <div class="ml-4 flex-grow-1">
                                            <h4 class="text-lg font-semibold"><?php echo $cart['name']; ?></h4>
                                            <p class="text-gray-500">Giá: <span class="dish-price"><?php echo number_format($cart['price'], 0, ".", ","); ?></span> đ</p>
                                            <p class="text-gray-500">Số lượng: <span class="dish-quantity"><?php echo $cart['quantity']; ?></span></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-semibold dish-total">
                                                <?php echo number_format($cart['total'], 0, ".", ","); ?> đ
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Hiển thị tổng tiền của đơn hàng -->
                                <p class="text-lg font-semibold text-right">Tổng cộng: <span id="totalAmount"><?php echo number_format($totalAmount, 0, ".", ","); ?></span> đ</p>
                                <p class="text-lg font-semibold text-right">Số tiền giảm giá: <span id="discountAmount">0</span> đ</p>
                                <p class="text-lg font-semibold text-right">Tổng sau giảm giá: <span id="finalAmount"><?php echo number_format($totalAmount, 0, ".", ","); ?></span> đ</p>
                            </div>



                            <div class="store mb-4">
                                <h3 style="color: #E67E22;">Cửa hàng</h3>
                                <?php
                                $db = new Database();
                                $conn = $db->connect();
                                $sql = "SELECT * FROM `store`";
                                $result = $conn->query($sql);
                                $store = [];
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $store[] = $row;
                                    }
                                } else {
                                    echo "Không có cửa hàng nào.";
                                }
                                ?>
                                <select name="store" id="store" class="form-control">
                                    <option value="">Chọn cửa hàng</option>
                                    <?php
                                    foreach ($store as $row) {
                                        $store_id = $row['storeID'];
                                        $store_name = $row['storeName'];
                                        $store_address = $row['address'];
                                        echo "<option value=\"$store_id\">$store_name ($store_address)</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="KM">
                                <h3 style="color: #E67E22;">Khuyến mãi</h3>
                                <?php
                                $ctrl = new cPromotions;
                                $promotions = $ctrl->cGetAllPromotionGoingOn();
                                if ($promotions) {
                                    echo '<select class="form-control" name="promotionID" id="promotionID">';
                                    echo '<option value="" disabled selected>Chọn mã giảm giá</option>';
                                    foreach ($promotions as $promotion) {
                                        // Thêm thuộc tính data-max-discount để lưu giá trị maxDiscountAmount
                                        echo '<option value="' . $promotion['discountPercentage'] . '" data-max-discount="' . $promotion['maxDiscountAmount'] . '">';
                                        echo substr($promotion['promotionName'], 0, 50) . '</option>';
                                    }
                                    echo '</select>';
                                } else {
                                    echo 'Không có mã giảm giá';
                                }
                                ?>
                            </div>



                            <script>
                                document.getElementById('promotionID').addEventListener('change', function() {
                                    let discountPercentage = parseFloat(this.value); // Lấy giá trị discountPercentage từ mã giảm giá
                                    let maxDiscountAmount = parseFloat(this.options[this.selectedIndex].getAttribute('data-max-discount')); // Lấy giá trị maxDiscountAmount từ thuộc tính data-max-discount
                                    let totalAmount = parseFloat(document.getElementById('totalAmount').innerText.replace(/,/g, '')); // Lấy tổng hóa đơn, loại bỏ dấu phẩy

                                    if (!isNaN(discountPercentage)) {
                                        let discountAmount = totalAmount * (discountPercentage / 100); 

                                        
                                        if (discountAmount > maxDiscountAmount) {
                                            discountAmount = maxDiscountAmount;
                                        }

                                        let finalAmount = totalAmount - discountAmount; // Tính số tiền sau khi giảm

                                        // Định dạng số với dấu phân cách hàng nghìn, không có thập phân
                                        const formatNumber = (num) => {
                                            return new Intl.NumberFormat('en-US', {
                                                style: 'decimal',
                                                maximumFractionDigits: 0
                                            }).format(num);
                                        };

                                        // Cập nhật giao diện với số tiền giảm và tổng tiền sau giảm
                                        document.getElementById('discountAmount').innerText = formatNumber(discountAmount); // Hiển thị số tiền giảm giá (không có thập phân)
                                        document.getElementById('finalAmount').innerText = formatNumber(finalAmount); // Hiển thị tổng số tiền sau khi giảm (không có thập phân)
                                    }
                                });
                            </script>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ttpayModal">Tiếp tục</button>
                            </div>
                        </div>
















                    </div>
                </div>
            </div>
    </form>
    <script>
        function fillModal() {

            const name = document.getElementById("name").value;
            const phone = document.getElementById("phone").value;
            const email = document.getElementById("email").value;
            const address = document.getElementById("address").value;

            document.getElementById("modalName").innerText = name || "Chưa nhập";
            document.getElementById("modalPhone").innerText = phone || "Chưa nhập";
            document.getElementById("modalEmail").innerText = email || "Chưa nhập";
            document.getElementById("modalAddress").innerText = address || "Chưa nhập";
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("confirmPay").addEventListener("click", function() {
                document.querySelector("form").submit();
            });
        });
    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['payment_method'])) {
            $payment_method = $_POST['payment_method'];
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $email = $_POST['email'] ?? '';
            $address = $_POST['address'] ?? '';
            $note = $_POST['note'] ?? '';
            $storeID = $_POST['store'] ?? '';
            $promotionID = $_POST['promotionID'] ?? '';

            /*// In ra các giá trị để kiểm tra
            echo "<h4>Kiểm tra dữ liệu:</h4>";
            echo "<p><strong>Họ tên:</strong> $name</p>";
            echo "<p><strong>Số điện thoại:</strong> $phone</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Địa chỉ nhận:</strong> $address</p>";
            echo "<p><strong>Ghi chú:</strong> $note</p>";
            echo "<p><strong>PTTT:</strong> $payment_method </p>";
            echo "<p><strong>Cửa hàng ID:</strong> $storeID</p>";
            echo "<p><strong>Mã khuyến mãi ID:</strong> $promotionID</p>";*/

            $sql_check = "SELECT * FROM customer WHERE phone = '$phone'";
            $result = $conn->query($sql_check);

            if ($result->num_rows == 0) {
                $sql_insert_customer = "INSERT INTO customer (phone, fullName, address, email, blackList) VALUES ('$phone', '$name', '$address', '$email', 0)";
                if ($conn->query($sql_insert_customer) !== TRUE) {
                    echo "<p>Lỗi khi thêm khách hàng: " . $conn->error . "</p>";
                    exit();
                }
            }

            // Kiểm tra số đơn hàng có status = 4 của khách hàng
            $sql_check_orders = "SELECT COUNT(*) AS order_count FROM `order` WHERE customerID = '$phone' AND status = 4";
            $order_result = $conn->query($sql_check_orders);

            $discountAmount = isset($discountAmount) ? $discountAmount : "NULL";
            $finalAmount = isset($finalAmount) ? $finalAmount : "NULL";
            $partyPackageID = isset($partyPackageID) ? $partyPackageID : "NULL";



            $sumofQuantity = 0;
            foreach ($_SESSION["cart"] as $cart) {
                $sumofQuantity += $cart["quantity"];
            }


            if ($order_result) {
                $order_row = $order_result->fetch_assoc();
                $order_count = $order_row['order_count'];

                if ($order_count > 3) {
                    echo "<p>Không thể đặt hàng: Khách hàng đã hủy đơn quá 3 lần.</p>";
                } else {
                    // echo "$total, $sumOfQuantity, $payment_method, $note, '1', $phone, $discountAmount, $finalAmount, $partyPackageID, $storeID";
                    $sql_insert_order = "INSERT INTO `order` (orderDate, total, sumOfQuantity, paymentMethod, note, status, customerID, discountAmount, finalAmount, partyPackageID, storeID) 
                    VALUES (NOW(), $total, $sumofQuantity, '$payment_method', '$note', '1', '$phone', $discountAmount, $finalAmount, $partyPackageID, '$storeID')";

                    if ($conn->query($sql_insert_order) === TRUE) {
                        // echo "<p>Đơn hàng đã được thêm thành công!</p>";

                        $orderID = $conn->insert_id;
                        foreach ($_SESSION["cart"] as $cart) {
                            $dishID = $cart['id'];
                            $quantity = $cart['quantity'];
                            $unitPrice = $cart['unitPrice'];
                            $discountAmount = isset($cart['discountAmount']) ? $cart['discountAmount'] : "NULL";
                            $lineTotal = $cart['total'];

                            $sql_insert_order_detail = "INSERT INTO order_dish (orderID, dishID, quantity, unitPrice, discountAmount, lineTotal, promotionID) 
                                                        VALUES ('$orderID', '$dishID', '$quantity', '$unitPrice', $discountAmount, '$lineTotal', 'Null')";

                            echo "<p>Câu truy vấn SQL: $sql_insert_order_detail</p>";
                            if ($conn->query($sql_insert_order_detail) === TRUE) {
                                echo "<p>Đơn hàng đã được thêm thành công!</p>";
                            } else {
                                echo "<p>Lỗi khi thêm chi tiết món $dishID: " . $conn->error . "</p>";
                            }
                        }
                    } else {
                        echo "<p>Lỗi khi thêm đơn hàng: " . $conn->error . "</p>";
                    }
                }
            } else {
                echo "<p>Lỗi khi kiểm tra đơn hàng: " . $conn->error . "</p>";
            }
        }
    }
    ?>


</body>

</html>