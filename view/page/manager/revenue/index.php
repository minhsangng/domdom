<?php
$storeID = $_SESSION["user"][1];
$isChecked = "";

if (isset($_POST["btnxem"])) {
    $revenue = $_POST["revenue"];
    $isChecked = $revenue;
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <form action="" method="post" class="revenueMonth">
            <div class="flex justify-between items-center mb-4">
                <div class="flex justify-start items-center w-1/3">
                    <label for="" class="font-bold w-full">Loại doanh thu: </label>
                    <select name="revenue" id="revenue" class="form-control">
                        <option value="0" <?php echo $isChecked == 0 ? "selected" : ""; ?>>Tất cả</option>
                        <option value="1" <?php echo $isChecked == 1 ? "selected" : ""; ?>>Bán hàng</option>
                        <option value="2" <?php echo $isChecked == 2 ? "selected" : ""; ?>>Nhân công</option>
                        <option value="3" <?php echo $isChecked == 3 ? "selected" : ""; ?>>Nguyên liệu</option>
                        <option value="4" <?php echo $isChecked == 4 ? "selected" : ""; ?>>Lợi nhuận</option>
                    </select>
                </div>
                <div class="currentMonth flex items-center">
                    <input type="date" name="startM" id="startM"
                        class="bg-gray-100 border-solid border-2 rounded-lg py-1 px-3" value="<?php echo $startM; ?>">
                    <span class="mx-2">đến</span>
                    <input type="date" name="endM" id="endM"
                        class="bg-gray-100 border-solid border-2 rounded-lg py-1 px-3 mr-1"
                        value="<?php echo $endM; ?>">
                    <button type="submit" name="btnxem" class="btn btn-primary ml-1 py-2 px-4 rounded-lg">Xem</button>
                </div>
            </div>
        </form>

        <hr>
        <?php
        if ($revenue == 1 || $revenue == 0) {

            echo "<div class='flex justify-between items-center my-4 w-full'>
                    <h2 class='text-xl font-semibold'>Doanhh thu bán hàng</h2>
                    <div class='flex items-center'>
                        <button
                            class='btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white'>Xuất
                            <i class='fa-solid fa-table'></i></button>
                        <button
                            class='btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white'>In
                            <i class='fa-solid fa-print'></i></button>
                    </div>
                </div>";

            echo "<div class='h-fit bg-gray-100 rounded-lg p-6'>
                    <table class='text-base w-full text-center'>
                        <thead>
                            <tr>
                                <th class='text-gray-600 border-2 py-2'>Ngày</th>
                                <th class='text-gray-600 border-2 py-2'>Tổng số đơn</th>
                                <th class='text-gray-600 border-2 py-2'>Tổng số lượng món</th>
                                <th class='text-gray-600 border-2 py-2'>Tổng giá trị hóa đơn</th>
                            </tr>
                        </thead>
                        <tbody>";
            $ctrl = new cOrders;
            if ($ctrl->cGetAllOrderRangeOf($startM, $endM) != 0) {
                $result = $ctrl->cGetAllOrderRangeOf($startM, $endM);
                $revenue = 0;

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td class='py-2 border-2'>" . date("d-m-Y", strtotime($row["orderDate"])) . "</td>
                        <td class='py-2 border-2'>" . $row["totalOrder"] . "</td>
                        <td class='py-2 border-2'>" . $row["totalQuantity"] . "</td>
                        <td class='py-2 border-2'>" . str_replace(".00", "", number_format(
                            $row["totalAmount"],
                            "2",
                            ".",
                            ","
                        )) . "</td>
                    </tr>
                    ";
                    $revenue += $row["totalAmount"];
                }

            } else
                echo "<tr>
                        <td colspan='4' class='py-2 border-2'>Không có dữ liệu trong thời gian này!</td>
                    </tr>";

            echo "
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan='3' class='font-bold text-lg text-left p-2 border-2'>
                            <p>Tổng doanh thu:</p>
                        </td>
                        <td class='text-center border-2'>
                            " . str_replace(".00", "", number_format($revenue, "2", ".", ",")) . " đồng
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>";
        }
        ?>
        <div class="flex justify-between items-center my-4 w-full">
            <h2 class="text-xl font-semibold">Chi phí nhân công</h2>
            <div class="flex items-center">
                <button
                    class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất
                    <i class="fa-solid fa-table"></i></button>
                <button
                    class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In
                    <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <table class="text-base w-full text-center">
                <thead>
                    <tr>
                        <th class="text-gray-600 border-2 py-2">Vai trò</th>
                        <th class="text-gray-600 border-2 py-2">Tổng nhân viên</th>
                        <th class="text-gray-600 border-2 py-2">Tổng giờ công</th>
                        <th class="text-gray-600 border-2 py-2">Lương</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ctrl = new cEmployees;
                    $revenueEmployee = 0;
                    
                    if ($ctrl->cGetAllEmployeeForRevenue() != 0) {
                        $result = $ctrl->cGetAllEmployeeForRevenue();
                        
                        $salary = 0;
                        
                        while ($row = $result->fetch_assoc()) {
                            $salary = $row["totalHours"] * 23000;
                            echo "<tr>
                                <td class='border-2 py-2'>".$row["roleName"]."</td>
                                <td class='border-2 py-2'>".$row["quantityEmployee"]."</td>
                                <td class='border-2 py-2'>".$row["totalHours"]."</td>
                                <td class='border-2 py-2'>".number_format($salary, 0, ".", ",")."</td>
                            </tr>";
                            
                            $revenueEmployee += $salary;
                        }
                    }
                    
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="font-bold text-lg text-left p-2 border-2">
                            <p>Tổng chi phí:</p>
                        </td>
                        <td class="text-center border-2"><?php echo number_format($revenueEmployee, 0, ".", ",");?> đồng</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="flex justify-between items-center my-4 w-full">
            <h2 class="text-xl font-semibold">Chi phí nguyên liệu</h2>
            <div class="flex items-center">
                <button
                    class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất
                    <i class="fa-solid fa-table"></i></button>
                <button
                    class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In
                    <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <table class="text-base w-full text-center">
                <thead>
                    <tr>
                        <th class="text-gray-600 border-2 py-2">Nguyên liệu</th>
                        <th class="text-gray-600 border-2 py-2">Đơn vị tính</th>
                        <th class="text-gray-600 border-2 py-2">Số lượng tồn</th>
                        <th class="text-gray-600 border-2 py-2">Số lượng nhập</th>
                        <th class="text-gray-600 border-2 py-2">Số lượng xuất</th>
                        <th class="text-gray-600 border-2 py-2">Giá</th>
                        <th class="text-gray-600 border-2 py-2">Tổng chi phí</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `ingredient`";
                    $result = $conn->query($sql);
                    $revenue = 0;

                    if ($result->num_rows > 0)
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td class='py-2 border-2'>" . $row["ingredientName"] . "</td>
                                    <td class='py-2 border-2'>" . $row["unitOfcalculaton"] . "</td>
                                    <td class='py-2 border-2'>" . 10 . "</td>
                                    <td class='py-2 border-2'>" . 50 . "</td>
                                    <td class='py-2 border-2'>" . 0 . "</td>
                                    <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                                    <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"] * 40, "2", ".", ",")) . "</td>
                                </tr>
                                ";
                            $revenue += $row["total"];
                        } else
                        echo "<tr>
                                <td colspan='4' class='py-2 border-2'>Không có dữ liệu trong thời gian này!</td>
                            </tr>";
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="font-bold text-lg text-left p-2 border-2">
                            <p>Tổng chi phí:</p>
                        </td>
                        <td class="text-center border-2">9,960,000 đồng</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="flex justify-between items-center my-4 w-full">
            <h2 class="text-xl font-semibold">Lợi nhuận (đồng)</h2>
            <div class="flex items-center">
                <button
                    class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất
                    <i class="fa-solid fa-table"></i></button>
                <button
                    class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In
                    <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <table class="text-base w-full text-center">
                <thead>
                    <tr>
                        <th class="text-gray-600 border-2 py-2">Doanh thu bán hàng</th>
                        <th class="text-gray-600 border-2 py-2">Chi phí nhân công</th>
                        <th class="text-gray-600 border-2 py-2">Chi phí nguyên liệu</th>
                        <th class="text-gray-600 border-2 py-2">Lợi nhuận</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-2 py-2">552,250,000</td>
                        <td class="border-2 py-2">230,000,000</td>
                        <td class="border-2 py-2">9,960,000</td>
                        <td class="border-2 py-2">312,290,000</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>