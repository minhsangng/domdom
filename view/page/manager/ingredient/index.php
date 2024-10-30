<?php
/* $ctrl = new cIngredients; */

if (isset($_POST["btnmo"])) {

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
                var modalIngredient = new bootstrap.Modal(document.getElementById('ingredientModal')); 
                modalIngredient.show();
            });
        </script>";
}

if (isset($_POST["btnnl"])) {
    echo "<script>alert('Đã lưu nguyên liệu cần mua');</script>";
}

?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách món ăn
            </h2>
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
            <form action="" method="POST">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã món</th>
                            <th class="text-gray-600 border-2 py-2">Tên món</th>
                            <th class="text-gray-600 border-2 py-2">Số lượng</th>
                            <!-- <th class="text-gray-600 border-2 py-2">Chức năng</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Số sản phẩm mỗi trang
                        $productsPerPage = 5;
                        // Xác định trang hiện tại
                        if (isset($_GET['page_num']) && is_numeric($_GET['page_num'])) {
                            $currentPage = intval($_GET['page_num']);
                        } else {
                            $currentPage = 1;
                        }
                        // Tính toán vị trí bắt đầu lấy dữ liệu từ cơ sở dữ liệu
                        $startFrom = ($currentPage - 1) * $productsPerPage;
                        // Tổng số sản phẩm
                        $totalProducts = $table->num_rows;
                        // Tính toán số trang
                        $totalPages = ceil($totalProducts / $productsPerPage);
                        // Thực hiện truy vấn với vị trí bắt đầu và số lượng sản phẩm trên mỗi trang
                        
                        $sql = "SELECT * FROM dish LIMIT $startFrom, $productsPerPage";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td class='py-2 border-2'>#MA0" . $row["dishID"] . "</td>
                                    <td class='py-2 border-2'>" . $row["dishName"] . "</td>
                                    <td class='py-2 border-2'><input type='number' value='0' class='w-16 py-1 px-3'></td>
                                    
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type='submit' class='mt-2 btn btn-danger' name='btnmo' value=''>Xác nhận</button>
            </form>
            <?php
            $ctrl = new cIngredients;
            echo '<div class="pagination">';
            // Tính tổng số trang
            $totalPages = ceil($ctrl->cGetTotalIngredient() / $productsPerPage);

            // Hiển thị liên kết đến từng trang
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='index.php?i=ingredient&paging=product_list&page_num=$i'";
                if ($i == $currentPage) {
                    echo " class='active'";
                }
                echo ">$i</a>";
            }
            echo '</div>';
            ?>
        </div>
    </div>

    <div class="modal modalIngredient fade" id="ingredientModal" tabindex="-1" aria-labelledby="ingredientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" class="form-container w-full" method="POST">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="ingredientModalLabel"
                            style="color: #E67E22;">Tính toán nguyên liệu</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="ingreName" class="w-full py-2"><b>Tên NL <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="ingreName" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price" class="w-full py-2"><b>Giá mua <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="price" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="unit" class="w-full py-2"><b>Đơn vị tính <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="unit" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="unit" class="w-full py-2"><b>Số lượng cần mua <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="unit" required>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnnl">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>