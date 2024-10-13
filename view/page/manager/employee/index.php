    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Danh sách nhân viên
                </h2>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="h-fit bg-gray-100 rounded-lg p-6">
                <table class="text-sm w-full">
                    <thead>
                        <tr>
                            <th class="text-left text-gray-600">Mã NV</th>
                            <th class="text-left text-gray-600">Họ tên</th>
                            <th class="text-left text-gray-600">Số điện thoại</th>
                            <th class="text-left text-gray-600">Địa chỉ</th>
                            <th class="text-left text-gray-600">Trạng thái</th>
                            <th class="text-left text-gray-600">Vai trò</th>
                            <th class="text-left text-gray-600">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM users";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td class='py-2'>#020" . $row["userID"] . "</td>
                                    <td class='py-2'>" . $row["userName"] . "</td>
                                    <td class='py-2'>" . $row["phone"] . "</td>
                                    <td class='py-2'>" . $row["address"] . "</td>
                                    <td class='py-2'>" . $row["status"] . "</td>
                                    <td class='py-2'><span class='bg-green-100 text-green-500 py-1 px-2 rounded-lg'>" . $row["role"] . "</span></td>
                                    <td class='py-2 flex'>
                                        <button class='btn btn-secondary mr-1'>Sửa</button>
                                        <button class='btn btn-danger ml-1'>Xóa</button>
                                    </td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>