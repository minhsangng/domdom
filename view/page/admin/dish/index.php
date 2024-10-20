<?php
$ctrl = new cDishes;
function removeVietnameseAccents($str)
{
    $unicode = array(
        'a' => ['á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ'],
        'd' => ['đ'],
        'e' => ['é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'],
        'i' => ['í', 'ì', 'ỉ', 'ĩ', 'ị'],
        'o' => ['ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'],
        'u' => ['ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'],
        'y' => ['ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'],
        'A' => ['Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ'],
        'D' => ['Đ'],
        'E' => ['É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ'],
        'I' => ['Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'],
        'O' => ['Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ'],
        'U' => ['Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự'],
        'Y' => ['Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ']
    );

    foreach ($unicode as $nonAccent => $accentedChars) {
        $str = str_replace($accentedChars, $nonAccent, $str);
    }

    $str = str_replace(' ', '', $str);

    return strtolower($str);
}

if (isset($_POST["btnthemmon"])) {
    $dishName = $_POST["name"];
    $category = $_POST["cate"];
    $price = $_POST["price"];
    $unit = $_POST["unit"];
    $ingredient = $_POST["ingredient"];
    $quantity = $_POST["quantity"];
    $prepare = $_POST["prepare"];
    $image = $_FILES["image"];

    if (isset($dishName) && isset($category) && isset($price) && isset($unit) && isset($ingredient) && isset($quantity) && isset($prepare) && $image["size"] > 0 && $image["error"] == 0) {
        $imgName = removeVietnameseAccents($dishName) . ".png";

        move_uploaded_file($image["tmp_name"], "../../../images/dish/" . $imgName);

        $ctrl->cInsertDish($dishName, $category, $price, $prepare, $imgName);
    }
}

if (isset($_POST["btncapnhat"])) {

    echo "<script>
        window.onload = function openModal() {
            var modalUpdate = new bootstrap.Modal(document.getElementById('updateModal')); 
            modalUpdate.show();
        };
    </script>";
    
    $dishID = $_POST["btncapnhat"];

    $row = $ctrl->cGetDishById($dishID);
    
    $_SESSION["dishID"] = $row["dishID"];
    $_SESSION["dishName"] = $row["dishName"];
    $_SESSION["category"] = $row["dishCategory"];
    $_SESSION["price"] = $row["price"];
    $_SESSION["prepare"] = $row["preparationProcess"];
    $_SESSION["img"] = $row["image"];
}

if (isset($_POST["btnsuamon"])) {
    $dishID = $_SESSION["dishID"];
    $dishName = $_POST["name"];
    $category = $_POST["cate"];
    $price = $_POST["price"];
    $unit = $_POST["unit"];
    $ingredient = $_POST["ingredient"];
    $quantity = $_POST["quantity"];
    $prepare = $_POST["prepare"];
    $status = $_POST["status"];
    $image = $_FILES["image"];
    
    $imgName = removeVietnameseAccents($dishName).".png";
    
    if ($image["size"] > 0 && $image["error"] == 0)
        if ($image["type"] == "image/png" || $image["type"] == "image/jpg")
            move_uploaded_file($image["tmp_name"], "../../../images/dish/" . $imgName);
        else echo "<script>alert('Không phải ảnh. Vui lòng chọn lại ảnh khác!')</script>";
        
    $ctrl->cUpdateDish($dishName, $category, $price, $prepare, $imgName, $dishID);
}

if (isset($_POST["btnkhoa"])) {
    $dishID = $_POST["btnkhoa"];
    $sql = "SELECT businessStatus FROM dish WHERE dishID = $dishID";
    $result = $conn->query($sql);
    $status = $result->fetch_assoc()["businessStatus"];
    
    $newStatus = ($status == 1) ? 0 : 1;
    
    $ctrl->cLockDish($newStatus, $dishID);
}
?>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã món</th>
                            <th class="text-gray-600 border-2 py-2">Tên món</th>
                            <th class="text-gray-600 border-2 py-2">Phân loại</th>
                            <th class="text-gray-600 border-2 py-2">Giá bán</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ctrl = new cDishes;
                        $ctrl->cGetAllDish();
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="modal modalUpdate fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full" enctype="multipart/form-data">
                    <div class="modal-header justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="updateModalLabel" style="color: #E67E22;">Cập nhật món ăn</h2>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <label for="name" class="w-full py-2"><b>Tên món ăn <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="name" value="<?php echo $_SESSION["dishName"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cate" class="w-full py-2"><b>Loại món ăn <span class="text-red-500">*</span></b></label>
                                    <select name="cate" id="cate" class="w-full form-control">
                                        <?php
                                            $category = $_SESSION["category"];
                                            echo "<option value='".$category."' selected>".$category."</option>";
                                            
                                            $ctrl = new cCategories;
                                            $result = $ctrl->cGetCategoryNotId($category);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='".$row["dishCategory"]."'>".$row["dishCategory"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price" class="w-full py-2"><b>Giá bán <span class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="price" value="<?php echo $_SESSION["price"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ingredient" class="w-full py-2"><b>Nguyên liệu <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="ingredient">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="unit" class="w-full py-2"><b>Đơn vị tính <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="unit">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="quantity" class="w-full py-2"><b>Số lượng NL <span class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="quantity">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="prepare" class="w-full py-2"><b>Quy trình chế biến <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="prepare" value="<?php echo $_SESSION["prepare"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh <span class="text-red-500">*</span></b></label>
                                    <input type="file" class="w-full form-control" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="status" class="w-full py-2"><b>Trạng thái kinh doanh <span class="text-red-500">*</span></b></label>
                                    <select type="text" class="w-full form-control" name="status">
                                        <option value="1">Đang kinh doanh</option>
                                        <option value="0">Ngừng kinh doanh</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" name="btndong" data-bs-dismiss="modal" onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalUpdate = new bootstrap.Modal(document.querySelector('.modalUpdate')); modalUpdate.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuamon">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modalInsert fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full" enctype="multipart/form-data">
                    <div class="modal-header justify-center">
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
                                    <select name="cate" id="cate" class="w-full form-control">
                                        <option value="Gà rán">Gà rán</option>
                                        <option value="Burger/cơm">Burger/cơm</option>
                                        <option value="Mì ý">Mì ý</option>
                                        <option value="Ăn kèm">Ăn kèm</option>
                                        <option value="Tráng miệng">Tráng miệng</option>
                                        <option value="Thức uống">Thức uống</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price" class="w-full py-2"><b>Giá bán <span class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="price" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ingredient" class="w-full py-2"><b>Nguyên liệu <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="ingredient" required>
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
                                    <label for="quantity" class="w-full py-2"><b>Số lượng NL <span class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="quantity" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="prepare" class="w-full py-2"><b>Quy trình chế biến <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="prepare" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh <span class="text-red-500">*</span></b></label>
                                    <input type="file" class="w-full form-control" name="image">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalInsert = new bootstrap.Modal(document.querySelector('.modalInsert')); modalInsert.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnthemmon">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>