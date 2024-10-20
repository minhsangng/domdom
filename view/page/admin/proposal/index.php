<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Danh sách đề xuất
                </h2>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="h-fit bg-gray-100 rounded-lg p-6">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Tên NV</th>
                            <th class="text-gray-600 border-2 py-2">Loại đề xuất</th>
                            <th class="text-gray-600 border-2 py-2">Nội dung</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM proposal";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td class='py-2 border-2'>" . $row[""] . "</td>
                                    <td class='py-2 border-2'>" . $row["typeOfProposal"] . "</td>
                                    <td class='py-2 border-2'>" . $row["content"] . "</td>
                                    <td class='py-2 border-2'><span class='bg-".($row["status"] == "Đã duyệt" ? "green" : "red")."-100 text-".($row["status"] == "Đdã duyệt" ? "green" : "red")."-500 py-1 px-2 rounded-lg'>".$row["status"]."</span></td>
                                    <td class='py-2 border-2 flex justify-center'>
                                        <button class='btn btn-secondary mr-1'>Từ chối</button>
                                        <button class='btn btn-danger ml-1'>Duyệt</button>
                                    </td>
                                </tr>";
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
                            <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm nguyên liệu</h2>
                        </div>
                        <div class="modal-body">
                            <table class="w-full">
                                <tr>
                                    <td>
                                        <label for="name" class="w-full py-2"><b>Tên NL <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="cate" class="w-full py-2"><b>Loại NL <span class="text-red-500">*</span></b></label>
                                        <select name="cate" id="cate" class="w-full form-control">
                                            <option value="1">NL tươi</option>
                                            <option value="2">Đông lạnh</option>
                                            <option value="3">Nước ngọt</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="price" class="w-full py-2"><b>Giá mua <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="price" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="desc" class="w-full py-2"><b>Đơn vị tính <span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" name="desc" required>
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