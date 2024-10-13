    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Danh sách món ăn
                </h2>
                <div class="flex items-center">
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Thêm món ăn</button>
                </div>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="h-fit bg-gray-100 rounded-lg p-6">
                <table class="text-sm w-full">
                    <thead>
                        <tr>
                            <th class="text-left text-gray-600">Mã món</th>
                            <th class="text-left text-gray-600">Tên món</th>
                            <th class="text-left text-gray-600">Phân loại</th>
                            <th class="text-left text-gray-600">Giá bán</th>
                            <th class="text-left text-gray-600">Nguyên liệu</th>
                            <th class="text-left text-gray-600">Trạng thái</th>
                            <th class="text-left text-gray-600">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM dishes AS D JOIN categories AS C ON D.categoryID = C.categoryID";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            if ($row["businessStatus"] == "Đang kinh doanh") {
                                echo "
                                    <tr>
                                        <td class='py-2'>#010" . $row["dishID"] . "</td>
                                        <td class='py-2'>" . $row["dishName"] . "</td>
                                        <td class='py-2'>" . $row["categoryName"] . "</td>
                                        <td class='py-2'>" . $row["price"] . "</td>
                                        <td class='py-2'>" . $row[""] . "</td>
                                        <td class='py-2'><span class='bg-green-100 text-green-500 py-1 px-2 rounded-lg'>" . $row["businessStatus"] . "</span></td>
                                        <td class='py-2 flex'>
                                            <button class='btn btn-secondary mr-1'>Sửa</button>
                                            <button class='btn btn-danger ml-1'>Xóa</button>
                                        </td>
                                    </tr>
                                    ";
                            } else {
                                echo "
                                    <tr>
                                        <td class='py-2'>#010" . $row["dishID"] . "</td>
                                        <td class='py-2'>" . $row["dishName"] . "</td>
                                        <td class='py-2'>" . $row["categoryName"] . "</td>
                                        <td class='py-2'>" . $row["price"] . "</td>
                                        <td class='py-2'>" . $row[""] . "</td>
                                        <td class='py-2'><span class='bg-green-100 text-green-500 py-1 px-2 rounded-lg'>" . $row["businessStatus"] . "</span></td>
                                        <td class='py-2 flex'>
                                            <button class='btn btn-secondary mr-1'>Sửa</button>
                                            <button class='btn btn-danger ml-1'>Xóa</button>
                                        </td>
                                    </tr>
                                    ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal modalInsert fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" class="form-container w-full">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm món ăn</h2>
                        </div>
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <td>
                                        <label for="name" class="w-full py-2"><b>Tên món ăn <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="cate" class="w-full py-2"><b>Loại món ăn <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="cate" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="price" class="w-full py-2"><b>Giá bán <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="price" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="desc" class="w-full py-2"><b>Mô tả <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="desc" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="prepare" class="w-full py-2"><b>Chế biến <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="prepare" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="image" class="w-full py-2"><b>Hình ảnh <span class="text-red-500">*</span></b></label>
                                        <input type="file" class="w-full form-control" name="image" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>