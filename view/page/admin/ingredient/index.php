<?php
$ctrl = new cIngredients;

if (isset($_POST["btnthemnl"])) {
    $ingreName = $_POST["ingreName"];
    $unit = $_POST["unit"];
    $price = $_POST["price"];
    $type = $_POST["typeIngre"];

    $ctrl->cInsertIngredient($ingreName, $unit, $price, $type);
}

if (isset($_POST["btncapnhat"])) {

    echo "<script>
            window.onload = function openModal() {
                var modalUpdate = new bootstrap.Modal(document.getElementById('updateModal')); 
                modalUpdate.show();
            };
        </script>";

    $ingreID = $_POST["btncapnhat"];
    
    $row = $ctrl->cGetIngredientById($ingreID);

    $_SESSION["ingreID"] = $row["ingredientID"];
    $_SESSION["ingreName"] = $row["ingredientName"];
    $_SESSION["unit"] = $row["unitOfcalculaton"];
    $_SESSION["price"] = $row["price"];
    $_SESSION["type"] = $row["typeIngredient"];
}

if (isset($_POST["btnsuanl"])) {
    $ingreID = $_SESSION["ingreID"];
    $ingreName = $_POST["ingreName"];
    $unit = $_POST["unit"];
    $price = $_POST["price"];
    $type = $_POST["typeIngre"];

    $ctrl->mUpdateIngredient($ingreName, $unit, $price, $type, $ingreID);
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách nguyên liệu
            </h2>
            <div class="flex items-center">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Thêm nguyên liệu</button>
            </div>
            <div class="flex items-center">
                <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <form action="" method="POST">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã NL</th>
                            <th class="text-gray-600 border-2 py-2">Tên NL</th>
                            <th class="text-gray-600 border-2 py-2">Đơn vị tính</th>
                            <th class="text-gray-600 border-2 py-2">Giá mua</th>
                            <th class="text-gray-600 border-2 py-2">Loại NL</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ctrl = new cIngredients;
                        $ctrl->cGetAllIngredient();
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="modal modalInsert fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" class="form-container w-full" method="POST">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm nguyên liệu</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="ingreName" class="w-full py-2"><b>Tên NL <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="ingreName" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="typeIngre" class="w-full py-2"><b>Loại NL <span class="text-red-500">*</span></b></label>
                                    <select name="typeIngre" class="w-full form-control">
                                        <option value="NL tươi">NL tươi</option>
                                        <option value="Đông lạnh">Đông lạnh</option>
                                        <option value="Nước ngọt">Nước ngọt</option>
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
                                    <label for="unit" class="w-full py-2"><b>Đơn vị tính <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="unit" required>
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
                        <button type="submit" class="btn btn-primary" name="btnthemnl">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modalUpdate fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full">
                    <div class="modal-header justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="updateModalLabel" style="color: #E67E22;">Cập nhật nguyên liệu</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="ingreName" class="w-full py-2"><b>Tên NL <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="ingreName" value="<?php echo $_SESSION["ingreName"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="typeIngre" class="w-full py-2"><b>Loại NL <span class="text-red-500">*</span></b></label>
                                    <select name="typeIngre" class="w-full form-control">
                                        <?php
                                            $type = $_SESSION["type"];
                                            echo "<option value='" . $type . "' selected>" . $type . "</option>";

                                            $result = $ctrl->cGetIngredientNotType($type);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["typeIngredient"] . "'>" . $row["typeIngredient"] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price" class="w-full py-2"><b>Giá mua <span class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="price" value="<?php echo $_SESSION["price"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="unit" class="w-full py-2"><b>Đơn vị tính <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="unit">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" name="btndong" data-bs-dismiss="modal" onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalUpdate = new bootstrap.Modal(document.querySelector('.modalUpdate')); modalUpdate.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuanl">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>