    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Thống kê doanhh thu từ bán hàng
                </h2>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="h-fit bg-gray-100 rounded-lg p-6">
                <table class="text-base w-full">
                    <thead>
                        <tr>
                            <th class="text-left text-gray-600">Ngày &amp; giờ</th>
                            <th class="text-left text-gray-600">Món ăn</th>
                            <th class="text-left text-gray-600">Số lượng</th>
                            <th class="text-left text-gray-600">Đơn giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM orders AS O JOIN order_dishes AS OD ON O.orderID = OD.orderID JOIN dishes AS D ON OD.dishID = D.dishID";
                        $result = $conn->query($sql);
                        $revenue = 0;

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                    <tr>
                                        <td class='py-2'>" . $row["orderDate"] . "</td>
                                        <td class='py-2'>" . $row["dishName"] . "</td>
                                        <td class='py-2>'>" . $row["quantity"] . "</td>
                                        <td class='py-2'>" . number_format($row["totalAmount"], 2, '.', ',') . "</td>
                                    </tr>
                                    ";
                            $revenue += $row["totalAmount"];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2">
                            <td colspan="3" class="font-bold text-lg">Tổng doanh thu:</td>
                            <td><?php echo number_format($revenue, 2, '.', ','); ?> đồng</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>