<?php
$ctrl = new cPromotions;

echo "<script>
        window.addEventListener('load', () => {
            document.getElementById('promotion').classList.add('activeAd'); 
        });
    </script>";

$errors = [];

if (isset($_POST["btnthemkm"])) {
    $proName = $_POST["proName"];
    $des = $_POST["description"];
    $percent = $_POST["percent"];
    $start = $_POST["startDate"];
    $end = $_POST["endDate"];
    $image = $_FILES["image"];
    $status = 1;

    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $proName)) {
        $errors['proName'] = 'Tên khuyến mãi không hợp lệ!';
    }
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $des)) {
        $errors['description'] = 'Mô tả không hợp lệ!';
    }
    if (!preg_match("/^\d+$/", $percent) || $percent < 0 || $percent > 100) {
        $errors['percent'] = 'Phần trăm khuyến mãi không hợp lệ!';
    }
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $start)) {
        $errors['startDate'] = 'Ngày bắt đầu không hợp lệ!';
    }
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $end)) {
        $errors['endDate'] = 'Ngày kết thúc không hợp lệ!';
    }
    if (strtotime($start) >= strtotime($end)) {
        $errors['date'] = 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc!';
    }

    if (empty($errors)) {
        $imgName = '';

        if ($image["size"] > 0 && $image["error"] == 0){
            if ($image["type"] == "image/png" || $image["type"] == "image/jpeg") {
                $imgName = $image["name"];
                move_uploaded_file($image["tmp_name"], "../../../images/promotion1/".$imgName);
            } else {
                $errors['image'] = 'Không phải ảnh. Vui lòng chọn lại ảnh khác!';
            }
        }
        if (empty($errors)) {
            $ctrl->cInsertPromotion($proName, $des, $percent, $start, $end, $imgName, $status);
        }
    }
}

if (isset($_POST["btncapnhat"])) {

    echo "<script>
            window.addEventListener('load', () =>  {
                var modalUpdate = new bootstrap.Modal(document.getElementById('updateModal'));
                modalUpdate.show();
            });
        </script>";

    $proID = $_POST["btncapnhat"];

    $row = $ctrl->cGetPromotionById($proID);

    $_SESSION["proID"] = $row["promotionID"];
    $_SESSION["proName"] = $row["promotionName"];
    $_SESSION["description"] = $row["description"];
    $_SESSION["percent"] = $row["discountPercentage"];
    $_SESSION["startDate"] = $row["startDate"];
    $_SESSION["endDate"] = $row["endDate"];
    $_SESSION["status"] = $row["status"];
}

if (isset($_POST["btnsuakm"])) {
    $proID = $_SESSION["proID"];
    $proName = $_POST["proName"];
    $des = $_POST["description"];
    $percent = $_POST["percent"];
    $start = $_POST["startDate"];
    $end = $_POST["endDate"];
    $image = $_FILES["image"];
    $status = $_POST["status"];

    $imgName = '';

    if ($image["size"] > 0 && $image["error"] == 0) {
        if ($image["type"] == "image/png" || $image["type"] == "image/jpeg") {
            $imgName = $image["name"];
            move_uploaded_file($image["tmp_name"], "../../../images/promotion/".$imgName);
        } else {
            echo "<script>alert('Không phải ảnh. Vui lòng chọn lại ảnh khác!')</script>";
        }
    }
    $ctrl->cUpdatePromotion($proID, $proName, $des, $percent, $start, $end, $imgName, $status);
}

if (isset($_POST["btnxoa"])) {
    $proID = $_SESSION["proID"];
    $ctrl->cdeletePromotion($proID);
}

if (!empty($errors)) {
    echo "<script>
        window.addEventListener('load', () => {
            var insertModal = new bootstrap.Modal(document.getElementById('insertModal'));
            insertModal.show();
        });
    </script>";
}
?>
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách khuyến mãi
            </h2>
            <div class="flex items-center">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Thêm khuyến mãi</button>
            </div>
            <div class="flex items-center">
                <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <form action="" method="POST">
                <table class="text-sm w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã KM</th>
                            <th class="text-gray-600 border-2 py-2">Tên KM</th>
                            <th class="text-gray-600 border-2 py-2">Mô tả</th>
                            <th class="text-gray-600 border-2 py-2">Phần trăm</th>
                            <th class="text-gray-600 border-2 py-2">Ngày bắt đầu</th>
                            <th class="text-gray-600 border-2 py-2">Ngày kết thúc</th>
                            <th class="text-gray-600 border-2 py-2">Hình ảnh</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($ctrl->cGetAllPromotion() != 0) {
                            $result = $ctrl->cGetAllPromotion();
                            while ($row = $result->fetch_assoc()) {
                                echo "
                        <tr>
                            <td class='py-2 border-2'>#KM0" . ($row["promotionID"] < 10 ? "0" . $row["promotionID"] : $row["promotionID"]) . "</td>
                            <td class='py-2 border-2'>" . $row["promotionName"] . "</td>
                            <td class='py-2 border-2 w-40'>" . $row["description"] . "</td>
                            <td class='py-2 border-2'>" . str_replace(".00", "%", $row["discountPercentage"]) . "</td>
                            <td class='py-2 border-2'>" . $row["startDate"] . "</td>
                            <td class='py-2 border-2'>" . $row["endDate"] . "</td>
                            <td class='py-2 border-2'><img src='../../../images/promotion1/" . $row["image"] . "' alt='" . $row["promotionName"] . "' class='size-24' /></td>
                            <td class='py-2 border-2 text-" . ($row["status"] == 1 ? "green" : "red") . "-500'>" . ($row["status"] == 1 ? "Đang áp dụng" : "Ngưng áp dụng") . "</td>
                            <td class='py-2 border-2 flex justify-center items-center h-28'>
                                <button class='btn btn-secondary mr-1' name='btncapnhat' value='" . $row["promotionID"] . "'>Cập nhật</button>
                                <button class='btn btn-danger ml-1' name='btnxoa'>Xóa</button>
                            </td>
                        </tr>";
                            }
                        } else echo "<tr><td colspan='9' class='text-center pt-2'>Chưa có dữ liệu!</td></tr>";
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="modal modalInsert fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" class="form-container w-full" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm khuyến mãi</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="proName" class="w-full py-2"><b>Tên KM <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="proName" required value="<?php echo isset($proName) ? $proName : ''; ?>">
                                    <?php if (isset($errors['proName'])) {
                                        echo '<div class="text-red-500">' . $errors['proName'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="description" class="w-full py-2"><b>Mô tả <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="description" required value="<?php echo isset($des) ? $des : ''; ?>">
                                    <?php if (isset($errors['description'])) {
                                        echo '<div class="text-red-500">' . $errors['description'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="percent" class="w-full py-2"><b>Phần trăm KM<span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="percent" required value="<?php echo isset($percent) ? $percent : ''; ?>">
                                    <?php if (isset($errors['percent'])) {
                                        echo '<div class="text-red-500">' . $errors['percent'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="startDate" class="w-full py-2"><b>Ngày bắt đầu<span class="text-red-500">*</span></b></label>
                                    <input type="date" class="w-full form-control" name="startDate" required value="<?php echo isset($start) ? $start : ''; ?>">
                                    <?php if (isset($errors['startDate'])) {
                                        echo '<div class="text-red-500">' . $errors['startDate'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="endDate" class="w-full py-2"><b>Ngày kết thúc<span class="text-red-500">*</span></b></label>
                                    <input type="date" class="w-full form-control" name="endDate" required value="<?php echo isset($end) ? $end : ''; ?>">
                                    <?php if (isset($errors['endDate'])) {
                                        echo '<div class="text-red-500">' . $errors['endDate'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php if (isset($errors['date'])) {
                                        echo '<div class="text-red-500">' . $errors['date'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh<span class="text-red-500">*</span></b></label>
                                    <input type="file" class="w-full form-control" name="image" required>
                                    <?php if (isset($errors['image'])) {
                                        echo '<div class="error">' . $errors['image'] . '</div>';
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnthemkm">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modalUpdate fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full" enctype="multipart/form-data">
                    <div class="modal-header justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="updateModalLabel" style="color: #E67E22;">Cập nhật khuyến mãi</h2>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <label for="proName" class="w-full py-2"><b>Tên KM </b></label>
                                    <input type="text" class="w-full form-control" name="proName" value="<?php echo $_SESSION["proName"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="description" class="w-full py-2"><b>Mô tả </b></label>
                                    <input type="text" class="w-full form-control" name="description" value="<?php echo $_SESSION["description"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="percent" class="w-full py-2"><b>Phần trăm KM </b></label>
                                    <input type="number" class="w-full form-control" name="percent" value="<?php echo $_SESSION["percent"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="startDate" class="w-full py-2"><b>Ngày bắt đầu </b></label>
                                    <input type="date" class="w-full form-control" name="startDate" value="<?php echo $_SESSION["startDate"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="endDate" class="w-full py-2"><b>Ngày kết thúc </b></label>
                                    <input type="date" class="w-full form-control" name="endDate" value="<?php echo $_SESSION["endDate"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh </b></label>
                                    <input type="file" class="w-full form-control" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="status" class="w-full py-2"><b>Trạng thái </b></label>
                                    <select type="text" class="w-full form-control" name="status">
                                        <?php
                                        $status = $_SESSION["status"];

                                        echo "<option value='" . $status . "' selected>" . ($_SESSION["status"] == 1 ? "Đang áp dụng" : "Ngưng áp dụng") . "</option>";
                                        $result = $ctrl->cGetPromotionNotStatus($status);
                                        while ($row = $result->fetch_assoc())
                                            echo "<option value='" . $row["status"] . "'>" . ($row["status"] == 1 ? "Đang áp dụng" : "Ngưng áp dụng") . "</option>";
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" name="btndong" data-bs-dismiss="modal" onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalUpdate = new bootstrap.Modal(document.querySelector('.modalUpdate')); modalUpdate.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuakm">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


