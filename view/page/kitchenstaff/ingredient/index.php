<?php
// Thêm ở đầu file để theo dõi các nguyên liệu cần nhập
session_start();
if (!isset($_SESSION['imported_ingredients'])) {
    $_SESSION['imported_ingredients'] = array();
}

// Thêm ID vào session khi nhập thành công
if (isset($_POST['btnnhap'])) {
    $ingredientID = $_POST['btnnhap'];
    $quantity = $_POST['quantity'][$ingredientID];
    if ($quantity > 0) {
        $_SESSION['imported_ingredients'][$ingredientID] = $quantity;
    }
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách nguyên liệu cần mua
            </h2>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <form action="" method="POST">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã NL</th>
                            <th class="text-gray-600 border-2 py-2">Tên NL</th>
                            <th class="text-gray-600 border-2 py-2">Đơn vị tính</th>
                            <th class="text-gray-600 border-2 py-2">Giá mua (đồng)</th>
                            <th class="text-gray-600 border-2 py-2">Loại NL</th>
                            <th class="text-gray-600 border-2 py-2">Số lượng cần nhập</th>
                            <th class="text-gray-600 border-2 py-2">Số lượng thực tế</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ctrl = new cIngredients;

                        if ($ctrl->cGetAllIngredient() != 0) {
                            $result = $ctrl->cGetAllIngredient();

                            if ($result->num_rows > 0)
                                while ($row = $result->fetch_assoc()) {
                                    // Chỉ hiển thị những nguyên liệu chưa được nhập
                                    if (!array_key_exists($row["ingredientID"], $_SESSION['imported_ingredients'])) {
                                        echo "
                                        <tr>
                                            <td class='py-2 border-2'>#NL0" . ($row["ingredientID"] < 10 ? "0" . $row["ingredientID"] : $row["ingredientID"]) . "</td>
                                            <td class='py-2 border-2'>" . $row["ingredientName"] . "</td>
                                            <td class='py-2 border-2'>" . $row["unitOfcalculaton"] . "</td>
                                            <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                                            <td class='py-2 border-2'>" . $row["typeIngredient"] . "</td>
                                            <td class='py-2 border-2'>" . $row["quantity"] . "</td>
                                            <td class='py-2 border-2'>
                                                <input type='number' name='quantity[" . $row["ingredientID"] . "]' class='w-14 rounded-lg px-2 py-1'>
                                            </td>
                                            <td class='py-2 border-2'>
                                                <button type='submit' class='btn btn-primary ml-1' name='btnnhap' value='" . $row["ingredientID"] . "'>Nhập</button>
                                            </td>
                                        </tr>";
                                    }
                                }
                        } else
                            echo "<tr><td colspan='8' class='text-center pt-2'>Chưa có dữ liệu!</td></tr>";
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</div>

<?php
if (isset($_POST['btnnhap'])) {
    $ingredientID = $_POST['btnnhap'];
    $quantity = $_POST['quantity'][$ingredientID];

    if ($quantity > 0) {
        if ($ctrl->cUpdateNeedIngredientQuantity($ingredientID, $quantity)) {
            echo "<div class='bg-white p-6 rounded-lg shadow-lg mt-6'>
                    <h2 class='text-xl font-semibold mb-4'>Danh sách nguyên liệu đã nhập</h2>
                    <div class='h-fit bg-gray-100 rounded-lg p-6'>
                        <table class='text-base w-full text-center'>
                            <thead>
                                <tr>
                                    <th class='text-gray-600 border-2 py-2'>Mã NL</th>
                                    <th class='text-gray-600 border-2 py-2'>Tên NL</th>
                                    <th class='text-gray-600 border-2 py-2'>Đơn vị tính</th>
                                    <th class='text-gray-600 border-2 py-2'>Số lượng đã nhập</th>
                                </tr>
                            </thead>
                            <tbody>";

            // Sửa phần hiển thị bảng đã nhập
            foreach ($_SESSION['imported_ingredients'] as $importedID => $importedQuantity) {
                $ingredient = $ctrl->cGetIngredientById($importedID);
                if ($ingredient) {  // Thêm kiểm tra kết quả
                    echo "<tr>
                            <td class='py-2 border-2'>#NL0" . ($importedID < 10 ? "0" . $importedID : $importedID) . "</td>
                            <td class='py-2 border-2'>" . $ingredient["ingredientName"] . "</td>
                            <td class='py-2 border-2'>" . $ingredient["unitOfcalculaton"] . "</td>
                            <td class='py-2 border-2'>" . $importedQuantity . "</td>
                        </tr>";
                }
            }

            echo "</tbody></table></div></div>";
        } else {
            echo "<script>alert('Có lỗi xảy ra!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập số lượng hợp lệ!');</script>";
    }
}
?>