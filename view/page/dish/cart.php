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
    <form action="" method="POST" class="" novalidate>
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
                    <input type="text" name="name" id="name" class="form-control mb-3" required pattern="^[a-zA-ZÀ-ỹ\s]+$">
                    <div id="name-error" class="text-red-500 text-sm"></div>

                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" name="phone" id="phone" class="form-control mb-4" required pattern="^((0[1-9]{1}[0-9]{8})|(\+84[1-9]{1}[0-9]{8}))$">
                    <div id="phone-error" class="text-red-500 text-sm"></div>


                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" id="email" class="form-control mb-4" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                    <div id="email-error" class="text-red-500 text-sm"></div>

                    <label for="address" class="form-label">Địa chỉ nhận:</label>
                    <input type="text" name="address" id="address" class="form-control mb-4" required>
                    <div id="address-error" class="text-red-500 text-sm"></div>
                </div>
                <div class="flex justify-between">
                    <h2 class='font-bold text-xl'>Tổng đơn:</h2>
                    <?php echo number_format($total, 0, ".", ",") . " đ"; ?>
                </div>
                <div class="mt-3 flex justify-between">
                    <button class="btn btn-secondary" name="clear">Xóa tất cả</button>
                    <button type="button" class="btn btn-danger" id="submitButton" onclick="validateAndFillModal()">Xác nhận</button>
                </div>
            </div>

            <script>
                function validateAndFillModal() {
                    var isValid = true;

                    var name = document.getElementById('name');
                    var phone = document.getElementById('phone');
                    var email = document.getElementById('email');
                    var address = document.getElementById('address');

                    var nameError = document.getElementById('name-error');
                    var phoneError = document.getElementById('phone-error');
                    var emailError = document.getElementById('email-error');
                    var addressError = document.getElementById('address-error');

                    nameError.innerText = '';
                    phoneError.innerText = '';
                    emailError.innerText = '';
                    addressError.innerText = '';

                    if (!name.value.trim()) {
                        nameError.innerText = 'Họ tên không được bỏ trống.';
                        isValid = false;
                    } else if (!name.value.match(name.pattern)) {
                        nameError.innerText = 'Tên phải bắt đầu bằng chữ cái. Vui lòng nhập lại.';
                        isValid = false;
                    }

                    if (!phone.value.trim()) {
                        phoneError.innerText = 'Số điện thoại không được bỏ trống.';
                        isValid = false;
                    } else if (!phone.value.match(phone.pattern)) {
                        phoneError.innerText = 'Số điện thoại gồm 10 chữ số và bắt đầu bằng số 0 hoặc +84. Vui lòng nhập lại.';
                        isValid = false;
                    }

                    if (!email.value.trim()) {
                        emailError.innerText = 'Email không được bỏ trống.';
                        isValid = false;
                    } else if (!email.value.match(email.pattern)) {
                        emailError.innerText = 'Email phải có định dạng abc@gmail.com. Vui lòng nhập lại.';
                        isValid = false;
                    }

                    if (!address.value.trim()) {
                        addressError.innerText = 'Địa chỉ không được bỏ trống.';
                        isValid = false;
                    }

                    if (isValid) {
                        fillModal(name.value, phone.value, email.value, address.value);
                        var modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
                        modal.show();
                    }
                }

                function validateStore() {
                    var store = document.getElementById('store');
                    var storeError = document.getElementById('store-error');
                    storeError.innerText = '';
                    if (store.value === "") {
                        storeError.innerText = 'Vui lòng chọn cửa hàng.';
                    } else {
                        var checkoutModalElement = document.getElementById('checkoutModal');
                        var checkoutModal = bootstrap.Modal.getInstance(checkoutModalElement);
                        checkoutModal.hide();

                        var payModal = new bootstrap.Modal(document.getElementById('payModal'));
                        payModal.show();
                    }
                }

                function checkPaymentMethod() {
                    console.log("Checking payment method...");
                    var paymentMethods = document.getElementsByName('payment_method');
                    var selectedMethod = null;

                    for (var i = 0; i < paymentMethods.length; i++) {
                        if (paymentMethods[i].checked) {
                            selectedMethod = paymentMethods[i].value;
                            break;
                        }
                    }

                    if (!selectedMethod) {
                        var errorMessage = document.getElementById('payment-error');
                        if (errorMessage) {
                            errorMessage.textContent = 'Vui lòng chọn phương thức thanh toán!';
                        }
                    } else {
                        var errorMessage = document.getElementById('payment-error');
                        if (errorMessage) {
                            errorMessage.textContent = '';
                        }

                        var payModalElement = document.getElementById('payModal');
                        if (payModalElement) {
                            var payModal = bootstrap.Modal.getInstance(payModalElement);
                            payModal.hide();
                        }
                        var ttpayModalElement = document.getElementById('ttpayModal');
                        if (ttpayModalElement) {
                            var ttpayModal = new bootstrap.Modal(ttpayModalElement);
                            ttpayModal.show();
                        }
                    }
                }

                function fillModal(name, phone, email, address) {
                    document.getElementById('modalName').innerText = name;
                    document.getElementById('modalPhone').innerText = phone;
                    document.getElementById('modalEmail').innerText = email;
                    document.getElementById('modalAddress').innerText = address;
                }

                document.addEventListener("DOMContentLoaded", () => {
                    document.getElementById("confirmPay").addEventListener("click", function() {
                        document.querySelector("form").submit();
                    });
                });
            </script>

            <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
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
                                <p class="text-lg font-semibold text-right">Tổng cộng: <span name="totalAmount" id="totalAmount"><?php echo number_format($totalAmount, 0, ".", ","); ?></span> đ</p>
                                <p class="text-lg font-semibold text-right">Số tiền giảm giá: <span name="discountAmount" id="discountAmount">0</span> đ</p>
                                <p class="text-lg font-semibold text-right">Tổng sau giảm giá: <span name="finalAmount" id="finalAmount"><?php echo number_format($totalAmount, 0, ".", ","); ?></span> đ</p>
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
                                    <option value="">Chọn cửa hàng</option> <!-- Không có giá trị mặc định nào được chọn -->
                                    <?php
                                    foreach ($store as $row) {
                                        $store_id = $row['storeID'];
                                        $store_name = $row['storeName'];
                                        $store_address = $row['address'];
                                        echo "<option value=\"$store_id\">$store_name ($store_address)</option>";
                                    }
                                    ?>
                                </select>
                                <div id="store-error" class="text-red-500 text-sm"></div>
                            </div>



                            <div class="KM">
                                <h3 style="color: #E67E22;">Khuyến mãi</h3>
                                <?php
                                $ctrl = new cPromotions;
                                $promotions = $ctrl->cGetAllPromotionGoingOn();
                                if ($promotions) {
                                    echo '<select class="form-control" name="promotionID" id="promotionID">';
                                    echo '<option value="" disabled readonly selected>Chọn mã giảm giá</option>';
                                    echo '<option value="0" data-max-discount="0">--</option>';
                                    foreach ($promotions as $promotion) {
                                        echo '<option value="' . $promotion['promotionID'] . '" data-p-d="' . $promotion['discountPercentage'] . '" data-max-discount="' . $promotion['maxDiscountAmount'] . '">';
                                        echo substr($promotion['promotionName'], 0, 50) . '</option>';
                                    }
                                    echo '</select>';
                                } else {
                                    echo 'Không có mã giảm giá';
                                }
                                ?>
                                <!-- Input ẩn để gửi giá trị qua POST -->
                                <input type="hidden" name="hiddenDiscountAmount" id="hiddenDiscountAmount" value="0">
                                <input type="hidden" name="hiddenFinalAmount" id="hiddenFinalAmount" value="0">
                            </div>

                            <script>
                                document.getElementById('promotionID').addEventListener('change', function() {
                                    let selectedOption = this.options[this.selectedIndex];
                                    let discountPercentage = parseFloat(selectedOption.getAttribute('data-p-d'));
                                    let maxDiscountAmount = parseFloat(selectedOption.getAttribute('data-max-discount'));
                                    let totalAmount = parseFloat(document.getElementById('totalAmount').innerText.replace(/,/g, '')); 

                                    if (!isNaN(discountPercentage)) {
                                        let discountAmount = totalAmount * (discountPercentage / 100);
                                        if (discountAmount > maxDiscountAmount) {
                                            discountAmount = maxDiscountAmount;
                                        }

                                        let finalAmount = totalAmount - discountAmount;

                                        const formatNumber = (num) => {
                                            return new Intl.NumberFormat('en-US', {
                                                style: 'decimal',
                                                maximumFractionDigits: 0
                                            }).format(num);
                                        };

                                        document.getElementById('discountAmount').innerText = formatNumber(discountAmount);
                                        document.getElementById('finalAmount').innerText = formatNumber(finalAmount);

                                        // Gán giá trị vào input ẩn để gửi qua POST
                                        document.getElementById('hiddenDiscountAmount').value = discountAmount.toFixed(0);
                                        document.getElementById('hiddenFinalAmount').value = finalAmount.toFixed(0);
                                    }
                                });
                            </script>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-danger" onclick="validateStore()">Tiếp tục</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header flex justify-center">
                            <h2 class="modal-title fs-5 font-bold text-3xl" id="payModalLabel" style="color: #E67E22;">
                                Phương thức thanh toán</h2>
                        </div>
                        <div class="modal-body">
                            <div class="border-b pb-4 mb-4">
                                <label for="" class="font-bold w-full mb-2">Phương thức thanh toán</label>
                                <ul class="w-full">
                                    <li><input type="radio" name="payment_method" id="1" class="mr-2" value="1" required>Ví điện tử</li>
                                    <li><input type="radio" name="payment_method" id="2" class="mr-2" value="2" required>Thẻ ngân hàng</li>
                                </ul>
                                <div id="payment-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-xl">Tổng đơn</p>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold"><?php echo number_format($total, 0, ".", ",") . " đ"; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" onclick="checkPaymentMethod()">Tiếp tục</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="ttpayModal" tabindex="-1" aria-labelledby="ttpayModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header flex justify-center">
                            <h2 class="modal-title fs-5 font-bold text-3xl" id="payModalLabel" style="color: #E67E22;">
                                Chuyển khoản</h2>
                        </div>
                        <div class="modal-body">
                            <div class="flex flex-wrap">
                                <div class="w-full md:w-1/2 mb-4 pr-4">
                                    <div>
                                        <h5 class="font-bold text-lg" style="color: #E67E22;">Ngân hàng</h5>
                                        <p>VietinBank</p>
                                        <h5 class="font-bold text-lg" style="color: #E67E22;">Số tài khoản</h5>
                                        <p>8386</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-bold text-lg" style="color: #E67E22;">Mã QR</h5>
                                        <img src="path_to_qr_image" alt="QR Code" class="w-40 h-40" />
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 mb-4 pl-4">
                                    <div>
                                        <h5 class="font-bold text-lg" style="color: #E67E22;">Ví Momo</h5>
                                        <p>Số điện thoại: <strong>0123456789</strong></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-bold text-lg" style="color: #E67E22;">Mã QR</h5>
                                        <img src="path_to_momo_qr_image" alt="Momo QR Code" class="w-40 h-40" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger" id="confirmPay" name="btntt">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
            $discountAmount = $_POST['hiddenDiscountAmount'] ?? 0;
            $finalAmount = $_POST['hiddenFinalAmount'] ?? 0;
            $partyPackageID = "Null";

            /*// In ra các giá trị để kiểm tra
            echo "<h4>Kiểm tra dữ liệu:</h4>";
            echo "<p><strong>Họ tên:</strong> $name</p>";
            echo "<p><strong>Số điện thoại:</strong> $phone</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Địa chỉ nhận:</strong> $address</p>";
            echo "<p><strong>Ghi chú:</strong> $note</p>";
            echo "<p><strong>PTTT:</strong> $payment_method </p>";
            echo "<p><strong>Cửa hàng ID:</strong> $storeID</p>";
            echo "<p><strong>Mã khuyến mãi ID:</strong> $promotionID</p>";
            echo "<p><strong>Số tiền giảm giá:</strong> $discountAmount</p>";
            echo "<p><strong>Tổng tiền sau giảm giá:</strong> $finalAmount</p>";
            echo "<p><strong>gói tiệc</strong> $partyPackageID</p>";*/

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
            $sumofQuantity = 0;
            foreach ($_SESSION["cart"] as $cart) {
                $sumofQuantity += $cart["quantity"];
            }

            if ($order_result) {
                $order_row = $order_result->fetch_assoc();
                $order_count = $order_row['order_count'];

                if ($order_count > 3) {
                    echo "<script>alert('Không thể đặt hàng: Khách hàng đã hủy đơn quá 3 lần.');</script>";
                } else {
                    //echo "$total, $sumOfQuantity, $payment_method, $note, '1', $phone, $discountAmount, $finalAmount, $partyPackageID, $storeID";
                    $sql_insert_order = "INSERT INTO `order` (orderDate, total, sumOfQuantity, paymentMethod, note, status, customerID, discountAmount, finalAmount, partyPackageID, storeID) 
                    VALUES (NOW(), $total, $sumofQuantity, '$payment_method', '$note', '1', '$phone', $discountAmount, $finalAmount, $partyPackageID, '$storeID')";

                    if ($conn->query($sql_insert_order) === TRUE) {
                        // echo "<p>Đơn hàng đã được thêm thành công!</p>";

                        $orderID = $conn->insert_id;
                        foreach ($_SESSION["cart"] as $cart) {
                            $dishID = $cart['id'];
                            $quantity = $cart['quantity'];
                            $unitPrice = $cart['price'];
                            $discountAmount = isset($cart['discountAmount']) ? $cart['discountAmount'] : "NULL";
                            $lineTotal = $cart['total'];

                            $sql_insert_order_detail = "INSERT INTO order_dish (orderID, dishID, quantity, unitPrice, discountAmount, lineTotal, promotionID) 
                                                        VALUES ('$orderID', '$dishID', '$quantity', '$unitPrice', $discountAmount, '$lineTotal', '$promotionID')";

                            //echo "<p>Câu truy vấn SQL: $sql_insert_order_detail</p>";
                            if ($conn->query($sql_insert_order_detail) === TRUE) {
                                echo "<script>alert('Đã đặt hàng thành công!');</script>";
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