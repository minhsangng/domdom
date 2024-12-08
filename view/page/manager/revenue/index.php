<?php
session_start();
$storeID = $_SESSION["managerstoreID"];
?>
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center w-fit">
                    <select name="" id="" class="form-control">
                        <option value="#0">Tất cả</option>
                        <option value="#DT">Doanh thu</option>
                        <option value="#NVL">Nguyên vật liệu</option>
                    </select>
                </div>
                <div class="currentMonth">
                    <form action="" method="post" class="revenueMonth flex items-center my-auto">
                        <input type="date" name="startM" id="startM" class="bg-gray-100 border-solid border-2 rounded-lg py-1 px-3" value="<?php echo $startM; ?>"> <span class="mx-2">đến</span>
                        <input type="date" name="endM" id="endM" class="bg-gray-100 border-solid border-2 rounded-lg py-1 px-3 mr-1" value="<?php echo $endM; ?>">
                        <button type="submit" name="btnxem" class="btn btn-primary ml-1 py-2 px-4 rounded-lg">Xem</button>
                    </form>
                </div>
            </div>
            
            <hr>

            <div class="flex justify-between items-center my-4 w-full">
                <h2 class="text-xl font-semibold">Doanhh thu bán hàng</h2>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="h-fit bg-gray-100 rounded-lg p-6">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Ngày</th>
                            <th class="text-gray-600 border-2 py-2">Món ăn</th>
                            <th class="text-gray-600 border-2 py-2">Tổng số lượng</th>
                            <th class="text-gray-600 border-2 py-2">Tồng hóa đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ctrl = new cOrders;
                            if ($ctrl->cGetRevenueOrderByStore(storeID: $storeID, start: $startM, end: $endM) != 0) {
                                $result = $ctrl->cGetRevenueOrderByStore($storeID, $startM, $endM);
                                $revenueType = 0;
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                        <tr>
                                            <td class='py-2 border-2'>" . date("d-m-Y", strtotime($row["orderDate"])) . "</td>
                                            <td class='py-2 border-2'>" . $row["dishes"] . "</td>
                                            <td class='py-2 border-2'>" . $row["sumOfQuantity"] . "</td>
                                            <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["total"], "2", ".", ",")) . "</td>
                                        </tr>
                                        ";
                                    $revenueType += $row["finalAmount"];
                                }

                            } else
                                echo "<tr>
                                    <td colspan='4' class='py-2 border-2'>Không có dữ liệu trong thời gian này!</td>
                                </tr>";
                                echo "</tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan='3' class='font-bold text-lg text-left p-2 border-2'>
                                                    <p>Tổng doanh thu:</p>
                                                </td>
                                                <td class='text-center border-2'>
                                                    " . str_replace(".00", "", number_format($revenue, "2", ".", ",")) . " đồng
                                                </td>
                                            </tr>
                                        </tfoot>"
                               ?>
                </table>
            </div>
            <div class="flex justify-between items-center my-4 w-full">
                <h2 class="text-xl font-semibold">Chi phí nhân công</h2>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
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
                        <tr>
                            <td class="border-2 py-2">Quản lý cửa hàng</td>
                            <td class="border-2 py-2">5</td>
                            <td class="border-2 py-2">200</td>
                            <td class="border-2 py-2">100,000,000</td>
                        </tr>
                        <tr>
                            <td class="border-2 py-2">Nhân viên nhân đơn</td>
                            <td class="border-2 py-2">5</td>
                            <td class="border-2 py-2">220</td>
                            <td class="border-2 py-2">70,000,000</td>
                        </tr>
                        <tr>
                            <td class="border-2 py-2">Quản lý cửa hàng</td>
                            <td class="border-2 py-2">5</td>
                            <td class="border-2 py-2">220</td>
                            <td class="border-2 py-2">60,000,000</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="font-bold text-lg text-left p-2 border-2">
                                <p>Tổng chi phí:</p>
                            </td>
                            <td class="text-center border-2">230,000,000 đồng</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="flex justify-between items-center my-4 w-full">
                <h2 class="text-xl font-semibold">Chi phí nguyên liệu</h2>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
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
                                            <td class='py-2 border-2'>" . $row["ingredientName"]. "</td>
                                            <td class='py-2 border-2'>" . $row["unitOfcalculaton"] . "</td>
                                            <td class='py-2 border-2'>" . 10 . "</td>
                                            <td class='py-2 border-2'>" . 50 . "</td>
                                            <td class='py-2 border-2'>" . 0 . "</td>
                                            <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                                            <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"]*40, "2", ".", ",")) . "</td>
                                        </tr>
                                        ";
                                $revenue += $row["total"];
                            }
                        else
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
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
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