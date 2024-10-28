<style>
    #content {
        height: 100% !important;
    }
</style>

<?php
echo "<script>document.addEventListener('re-load', () => {
        document.getElementById('create').classList.add('activeAd');
    });</script>";
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
                        /* session_destroy(); */
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
                        } else echo "Không có dữ liệu!";
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
                                <a href='?i=create&c=" . $row["dishCategory"] . "&p=" . $row["dishID"] . "' class='text-center flex flex-col items-center'>
                                    <img alt='" . $row["dishName"] . "' class='mb-2 rounded-md size-28' src='" . $img_dish . "'/>
                                    <h2 class='text-base font-bold my-1'>" . $row["dishName"] . "</h2>
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
                        <h2 class="text-xl font-bold">Best Sellers</h2>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <?php
                        $sql = "SELECT *, SUM(OD.quantity) AS MaxQuantity FROM `order` AS O JOIN `order_dish` AS OD ON O.orderID = OD.orderID JOIN `dish` AS D ON D.dishID = OD.dishID GROUP BY OD.dishID ORDER BY MaxQuantity DESC LIMIT 4";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card px-auto py-3 rounded'>
                                <a href='?i=create&p=" . $row["dishID"] . "' class='text-center flex flex-col items-center'>
                                    <img alt='" . $row["dishName"] . "' class='mb-2 rounded-md size-28' src='../../../images/dish/" . $row["image"] . "'/>
                                    <h2 class='text-base font-bold my-1'>" . $row["dishName"] . "</h2>
                                    <p class='text-sm text-red-400'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . " đ</p>
                                </a>
                            </div>";
                        }
                        if (!isset($_SESSION["products"]))
                            $_SESSION["products"] = [];

                        if (isset($_GET["p"])) {
                            $id = (int)$_GET["p"];
                            if (!in_array($id, $_SESSION["products"])) {
                                $_SESSION["products"][] = $id;
                            }
                        } else $id = 0;
                        ?>
                    </div>
                </div>
            </div>
            <div class="w-2/5 pl-4">
                <div class="card p-4 rounded mb-8">
                    <h2 class="text-xl font-bold pb-2 mb-3 border-b">Hình thức mua hàng</h2>
                    <div class="flex items-center mb-4">
                        <input class="mr-2 size-4" id="dinein" name="delivery" type="radio" />
                        <label class="text-base" for="dinein">Tại quán</label>
                        <input class="ml-4 mr-2 size-4" id="takeaway" name="delivery" type="radio" />
                        <label class="text-base" for="takeaway">Mang đi</label>
                    </div>
                </div>
                <div class="card p-4 rounded">
                    <form action="" method="POST" class="m-0">
                        <h2 class="text-xl font-bold pb-2 mb-3 border-b">Thông tin đơn hàng</h2>
                        <?php
                        if (isset($_POST["btnxoa"])) {
                            $_SESSION["products"] = array_diff($_SESSION["products"], [$_POST["btnxoa"]]);
                            $_SESSION["products"] = array_values($_SESSION["products"]);
                        }

                        $total = 0;
                        if (isset($_SESSION["products"])) {
                            foreach ($_SESSION["products"] as $p) {
                                $ctrl = new cDishes;
                                
                                if ($ctrl->cGetDishById($p) != 0) {
                                $result = $ctrl->cGetDishById($p);

                                if ($row = $result->fetch_assoc()) {
                                    echo "<div class='flex justify-between items-center mb-2'>
                                        <span class='font-bold' style='width:calc(100%/2);'>" . $row["dishName"] . "</span>
                                        <input type='number' style='width:calc(50%%/2);' min='1' value='1' class='w-10 text-right quantityInput' data-id='" . $p . "' data-name='" . $row["dishName"] . "' data-price='" . $row["price"] . "'' onchange='totalUpdate()'>
                                        <button name='btnxoa' style='width:calc(50%/2);' value='" . $row["dishID"] . "' class='btn btn-secondary'>Xóa</button>
                                    </div>";

                                    $total += $row["price"];
                                }
                                }
                            }
                        }
                        if ($_SESSION["products"] == NULL)
                            echo "<div class='flex justify-between items-center my-2'>
                                <img src='../../../images/nodish.png' class='h-40 w-full'>    
                            </div>";
                        ?>
                        <div class="flex justify-between items-center pt-2 mb-4 border-t">
                            <span class="text-lg font-bold">Tổng thanh toán:</span>
                            <span class="text-lg font-bold finalTotal"><?php echo str_replace(".00", "", number_format($total, "2", ".", ",")) . " đ"; ?></span>
                        </div>
                        <button class="btn btn-danger w-full p-2 rounded">Thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function totalUpdate() {
        let total = 0;
        let quantities = document.querySelectorAll(".quantityInput");

        quantities.forEach(input => {
            let dishID = input.getAttribute("data-id");
            let dishName = input.getAttribute("data-name");
            let dishPrice = input.getAttribute("data-price");
            let quantity = parseInt(input.value);

            total += parseFloat(dishPrice * quantity);

            document.querySelector(".finalTotal").textContent = total.toLocaleString() + " đ";
        });
    }
</script>