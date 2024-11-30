<?php
echo "<script>document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('create').classList.add('activeAd');
    });</script>";

if (!isset($_SESSION["product"])) {
    $_SESSION["product"] = [];
}

if (isset($_GET["p"])) {
    $productID = $_GET["p"];

    echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            focusQuantityInput(" . json_encode($productID) . ");
        });
    </script>";

    $quantity = isset($_POST["quantity"]) ? (int) $_POST["quantity"] : 1;

    $productExists = false;
    foreach ($_SESSION["product"] as $product) {
        if ($product["id"] == $productID) {
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $_SESSION["product"][$productID] = ["id" => $productID, "quantity" => $quantity];
    }

    if (isset($_POST["quantity"])) {
        foreach ($_POST["quantity"] as $productID => $quantity) {
            $productID = (int) $productID;
            $quantity = (int) $quantity;

            if (isset($_SESSION["product"][$productID])) {
                $_SESSION["product"][$productID]["quantity"] = $quantity;
            }
        }
    }
}

if (isset($_POST["btntt"])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            var modal = new bootstrap.Modal(document.querySelector('.modalPayment'));
            modal.show();
        });
    </script>";
}

$_SESSION["delivery"] = isset($_POST["delivery"]) ? $_POST["delivery"] : "";

if (isset($_POST["btnxn"])) {
    $method = "";
    if ($_POST["cash"] != "")
        $method = 0;
    else if ($_POST["vnpay"] != "")
        $method = 1;
    else if ($_POST["banking"] != "")
        $method = 2;

    echo $_POST["total"];
}

?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="w-full px-8 flex">
            <div class="w-3/5 pr-4">
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Danh mục</h2>
                    </div>
                    <div class="grid grid-cols-6 gap-2">
                        <?php
                        $ctrl = new cDishes;
                        if ($ctrl->cGetAllCategory() != 0) {
                            $result = $ctrl->cGetAllCategory();

                            $img_dish = "";

                            while ($row = $result->fetch_assoc()) {
                                $img_dish = "../../../images/dish/" . $row["image"];
                                if (!file_exists($img_dish))
                                    $img_dish = "../../../images/nodish.png";
                                echo "<div class='card px-auto py-3 rounded'>
                                <a href='?i=create&c=" . $row["dishCategory"] . "' class='flex flex-col items-center'>
                                    <img alt='" . $row["dishCategory"] . "' class='mb-2 size-20 rounded-md' src='" . $img_dish . "'/>
                                    <h2 class='text-sm font-bold text-center'>" . $row["dishCategory"] . "</h2>
                                </a>
                            </div>";
                            }
                        } else
                            echo "Không có dữ liệu!";
                        ?>
                    </div>
                    <div class="flex mt-3 pt-3 border-t">
                        <?php
                        $category = str_replace("%20", " ", $_GET["c"]);
                        $ctrl = new cDishes;

                        if ($ctrl->cGetDishByCategory($category)) {
                            $result = $ctrl->cGetDishByCategory($category);

                            $img_dish = "";

                            echo "<div class='grid grid-cols-4 gap-2 w-full'>";
                            while ($row = $result->fetch_assoc()) {
                                $img_dish = "../../../images/dish/" . $row["image"];
                                if (!file_exists($img_dish))
                                    $img_dish = "../../../images/nodish.png";
                                echo "<div class='card px-auto py-3 rounded'>
                                <a href='index.php?i=create&c=" . $row["dishCategory"] . "&p=" . $row["dishID"] . "' class='text-center flex flex-col items-center'>
                                    <img alt='" . $row["dishName"] . "' class='mb-2 rounded-md size-28' src='" . $img_dish . "'/>
                                    <h2 class='text-base font-bold my-1 h-12'>" . $row["dishName"] . "</h2>
                                    <p class='text-sm text-red-400'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . " đ</p>
                                </a>
                            </div>";
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Món ưa dùng</h2>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <?php
                        $ctrl = new cDishes;

                        if ($ctrl->cGetDishTop() != 0) {
                            $result = $ctrl->cGetDishTop();

                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='card px-auto py-3 rounded'>
                                    <a href='index.php?i=create&p=" . $row["dishID"] . "' class='text-center flex flex-col items-center'>
                                        <img alt='" . $row["dishName"] . "' class='mb-2 rounded-md size-28' src='../../../images/dish/" . $row["image"] . "'/>
                                        <h2 class='text-base font-bold my-1 h-12'>" . $row["dishName"] . "</h2>
                                        <p class='text-sm text-red-400'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . " đ</p>
                                    </a>
                                </div>";
                            }
                        } else
                            echo "Không có dữ liệu!";
                        ?>
                    </div>
                </div>
            </div>
            <div class="w-2/5 pl-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Thông tin đơn hàng</h2>
                </div>
                <div class="card p-4 rounded mb-8">
                    <form action="" method="POST" class="formmethod mb-0">
                        <h2 class="text-lg font-bold pb-2 mb-3 border-b">Hình thức mua hàng</h2>
                        <div class="flex items-center">
                            <input class="mr-2 size-4" id="dinein" value="1" name="delivery" <?php echo $_SESSION["delivery"] == 1 ? "checked" : ""; ?> type="radio" />
                            <label class="text-base" for="dinein">Tại quán</label>
                            <input class="ml-4 mr-2 size-4" id="takeaway" value="2" name="delivery" <?php echo $_SESSION["delivery"] == 2 ? "checked" : ""; ?> type="radio" />
                            <label class="text-base" for="takeaway">Mang đi</label>
                        </div>
                    </form>
                </div>
                <div class="card p-4 rounded">
                    <h2 class="text-lg font-bold pb-2 mb-3 border-b">Món ăn</h2>
                    <?php
                    $ctrl = new cDishes;

                    if (isset($_POST["btnxoa"])) {
                        foreach ($_SESSION["product"] as $index => $product) {
                            if ($product["id"] == $_POST["btnxoa"]) {
                                unset($_SESSION["product"][$index]);
                                break;
                            }
                        }

                        $_SESSION["product"] = array_values($_SESSION["product"]);
                    }

                    $total = 0;

                    if (isset($_SESSION["product"])) {
                        echo "<form action='' method='POST' class='m-0 form'>";
                        foreach ($_SESSION["product"] as $product) {
                            $productID = (int) $product["id"];
                            $quantity = $product["quantity"];

                            $ctrl = new cDishes;

                            if ($ctrl->cGetDishById($productID) != 0) {
                                $result = $ctrl->cGetDishById($productID);
                                $row = $result->fetch_assoc();

                                echo "<div class='flex justify-between items-center mb-2'>
                                        <span class='font-bold w-4/6'>" . $row["dishName"] . "</span>
                                        <input type='number' name='quantity[" . $productID . "]' value='" . $quantity . "' class='w-1/6 text-center quantityInput mr-2' data-id='" . $productID . "' data-name='" . $row["dishName"] . "' data-price='" . $row["price"] . "'>
                                        <button type='submit' name='btnxoa' value='" . $productID . "' class='btn btn-secondary w-1/6 ml-2'><i class='fa-solid fa-trash-can'></i></button>
                                    </div>";

                                $total += $row["price"] * $quantity;
                            }
                        }
                        echo "</form>";
                    }

                    if ($_SESSION["product"] == NULL)
                        echo "<div class='flex justify-between items-center my-2'>
                                <img src='../../../images/nodish.png' class='h-40 w-full'>    
                            </div>";
                    ?>
                    <form action="" method="POST">
                        <div class="flex justify-between items-center pt-2 mb-4 border-t">
                            <span class="text-lg font-bold">Tổng thanh toán:</span>
                            <span
                                class="text-lg font-bold finalTotal"><?php echo str_replace(".00", "", number_format($total, "2", ".", ",")) . " đ"; ?></span>
                        </div>
                        <button class="btn btn-danger w-full p-2 rounded" name="btntt" type="submit">Thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modalPayment fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 50%;">
        <div class="modal-content h-full">
            <form action="" method="POST">
                <div class="modal-header justify-center">
                    <h2 class="modal-title fs-5 font-bold text-3xl text-[#E67E22]" id="paymentModalLabel">Thông tin
                        thanh toán</h2>
                </div>
                <div class="modal-body flex">
                    <div class="w-2/3 mr-2 p-2 border rounded-lg">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <th colspan="2" class=" text-[#EF5350]">Hình thức thanh toán</th>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-3 py-1 w-32 flex items-start">Tiền mặt</td>
                                    <td class="divMoney"><input type="text" class="form-control m-0 pr-3 money"
                                            name="cash" id="" placeholder="Số tiền thanh toán" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-3 py-1 w-32 flex items-start">Ví điện tử</td>
                                    <td class="divMoney"><input type="text" class="form-control m-0 pr-3 money"
                                            name="vnpay" id="" placeholder="Số tiền thanh toán" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-3 py-1 w-32 flex items-start">Ngân hàng</td>
                                    <td class="divMoney"><input type="text" class="form-control m-0 pr-3 money"
                                            name="banking" id="" placeholder="Số tiền thanh toán" autocomplete="off">
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="2" class="mt-4 text-[#EF5350]">Khuyến mãi</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="py-1"><input type="text" class="form-control m-0"
                                            name="promotionID" id="" value="" placeholder="Nhập mã khuyến mãi (nếu có)">
                                        <p class="promotionID text-gray-500 italic text-sm mt-2"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-1/3 ml-2 p-2 border rounded-lg">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <th colspan="2" class=" text-[#EF5350]">Thanh toán</th>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-2 py-1">Tổng đơn</td>
                                    <td><input type="text" name="total" class="totalOrder w-24"
                                            value="<?php echo str_replace(".00", "", number_format($total, "2", ".", ",")) . " đ"; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-2 py-1">Khuyến mãi</td>
                                    <td><input type="text" class="promotion w-24" value="0"></td>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-2 py-1">Phải trả</td>
                                    <td><input type="text" class="total w-24"
                                            value="<?php echo str_replace(".00", "", number_format($total, "2", ".", ",")) . " đ"; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-2 py-1">Khách trả</td>
                                    <td><input type="text" class="customerPay w-24" value="0"></td>
                                </tr>
                                <tr>
                                    <td class="font-bold pl-2 py-1">Tiền thối</td>
                                    <td><input type="text" class="change w-24" value="0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger" name="btnxn">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    function totalUpdate() {
        let total = 0;
        let quantities = document.querySelectorAll(".quantityInput");

        quantities.forEach(input => {
            let dishPrice = parseFloat(input.getAttribute("data-price"));
            let quantity = parseInt(input.value);

            total += dishPrice * quantity;

            document.querySelector(".finalTotal").textContent = total.toLocaleString() + " đ";
        });
    }

    document.querySelectorAll(".quantityInput").forEach(input => {
        input.addEventListener("change", () => {
            totalUpdate();
            input.form.submit();
        });
    });

    function focusQuantityInput(productID) {
        const input = document.querySelector(`input[data-id='${productID}']`);
        if (input)
            input.focus();
    }

    var formmethod = document.querySelector(".formmethod");
    var radioBtn = document.querySelectorAll('input[type="radio"][name="delivery"]');

    radioBtn.forEach(btn => {
        btn.addEventListener("change", (event) => {
            if (event.target.checked) {
                formmethod.submit();
            }
        });
    });

    let inputMoney = document.querySelectorAll(".money");
    let totalOrder = document.querySelector(".totalOrder");
    let total = document.querySelector(".total");
    let promotion = document.querySelector(".promotion");
    let change = document.querySelector(".change");
    let customerPay = document.querySelector(".customerPay");

    totalOrderValue = parseInt(totalOrder.value.replace(/,/g, "").replace(/ đ/g, ""));
    totalOrder.value = totalOrderValue.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND"
    });

    totalValue = parseInt(total.value.replace(/,/g, "").replace(/ đ/g, ""));
    total.value = totalValue.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND"
    });

    customerPayValue = parseInt(customerPay.value.replace(/,/g, "").replace(/ đ/g, ""));
    customerPay.value = customerPayValue.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND"
    });

    changeValue = parseInt(change.value.replace(/,/g, "").replace(/ đ/g, ""));
    change.value = changeValue.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND"
    });

    function updateChange() {
        let totalValue = parseFloat(total.value.replace(/,/g, "").replace(/ đ/g, "")) || 0;
        let customerPayValue = parseFloat(customerPay.value.replace(/,/g, "").replace(/ đ/g, "")) || 0;

        let changeValue = 0;
        if (customerPayValue >= totalValue) {
            changeValue = customerPayValue - totalValue;
        }

        change.value = changeValue.toLocaleString("vi-VN", {
            style: "currency",
            currency: "VND"
        });
    }

    inputMoney.forEach(input => {
        input.addEventListener("focus", () => {
            inputMoney.forEach(i => {
                i.value = "";
            });

            const existingSuggestion = document.querySelector(".suggestion-container");
            if (existingSuggestion) {
                existingSuggestion.remove();
            }

            const divContainer = document.createElement("div");
            divContainer.classList.add("suggestion-container", "w-full", "h-fit", "mt-2");

            const prices = [1, 2, 5, 10, 20, 50, 100, 200, 500];

            prices.forEach(price => {
                const priceButton = document.createElement("button");
                priceButton.classList.add("btn", "btn-light", "m-1", "rounded");
                priceButton.setAttribute("type", "button");
                priceButton.textContent = price;

                priceButton.addEventListener("click", () => {
                    let inputPrice = parseFloat(input.value) || 0;
                    inputPrice += price * 1000;
                    input.value = inputPrice;
                    customerPay.value = inputPrice.toLocaleString("vi-VN", {
                        style: "currency",
                        currency: "VND"
                    });

                    let inputTotal = parseFloat(total.value.replace(/,/g, "").replace(/ đ/g, "")) * 1000;
                    let inputCus = parseFloat(customerPay.value.replace(/,/g, "").replace(/ đ/g, "")) * 1000;
                    let inputChange = 0;

                    if (inputCus >= inputTotal) {
                        inputChange = (inputCus - inputTotal);
                    } else inputChange = 0;

                    change.value = inputChange.toLocaleString("vi-VN", {
                        style: "currency",
                        currency: "VND"
                    });
                });

                divContainer.appendChild(priceButton);
            });

            const deleteButton = document.createElement("button");
            deleteButton.classList.add("btn", "btn-light", "m-1", "rounded");
            deleteButton.setAttribute("type", "button");
            deleteButton.textContent = "Nhập lại";
            divContainer.appendChild(deleteButton);

            deleteButton.addEventListener("click", () => {
                input.value = "";
                customerPayValue = parseInt(0);
                customerPay.value = customerPayValue.toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND"
                });
                changeValue = parseInt(0);
                change.value = changeValue.toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND"
                });
            });

            const inputContainer = input.parentNode;
            if (!inputContainer.querySelector(".suggestion-container")) {
                inputContainer.appendChild(divContainer);
            }
        });
    });
</script>