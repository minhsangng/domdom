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
        document.addEventListener('DOMContentLoaded', function() {
            var modalUpdate = new bootstrap.Modal(document.getElementById('updateModal')); 
            modalUpdate.show();
        });
    </script>";

    $dishID = $_POST["btncapnhat"];
    
    if ($ctrl->cGetDishById($dishID) != 0) {
    $result = $ctrl->cGetDishById($dishID);
    $row = $result->fetch_assoc();

    $_SESSION["dishID"] = $row["dishID"];
    $_SESSION["dishName"] = $row["dishName"];
    $_SESSION["category"] = $row["dishCategory"];
    $_SESSION["price"] = $row["price"];
    $_SESSION["image"] = $row["image"];
    $_SESSION["availabilityStatus"] = $row["availabilityStatus"];
    }
}

if (isset($_POST["btnhet"])) {
    $dishID = $_SESSION["dishID"];
        $availibility = ($_SESSION["availabilityStatus"] == 1 ? 0 : 1);

    $ctrl->cUpdateDishAvailabilityStatus($availibility, $dishID);
}

?>
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách món ăn
            </h2>
            <div class="flex items-center">
                <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white" id="export">Xuất <i class="fa-solid fa-table"></i></button>
                <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white" id="print">In <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="text-base w-full text-center" id="dishTable">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã món</th>
                            <th class="text-gray-600 border-2 py-2">Tên món</th>
                            <th class="text-gray-600 border-2 py-2">Phân loại</th>
                            <th class="text-gray-600 border-2 py-2">Giá bán (đ)</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ctrl = new cDishes;
                        if ($ctrl->cGetAllDish() != 0) {
                            $result = $ctrl->cGetAllDish();
                            $dishData = [];

                            while ($row = $result->fetch_assoc()) {
                                echo "
                    <tr>
                        <td class='py-2 border-2'>#010" . $row["dishID"] . "</td>
                        <td class='py-2 border-2'>" . $row["dishName"] . "</td>
                        <td class='py-2 border-2'>" . $row["dishCategory"] . "</td>
                        <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                        <td class='py-2 border-2'><span class='bg-" . ($row["availabilityStatus"] == 1 ? "green" : "red") . "-100 text-" . ($row["availabilityStatus"] == 1 ? "green" : "red") . "-500 py-1 px-2 rounded-lg'>" . ($row["availabilityStatus"] == 1 ? "Còn hàng" : "Hết hàng") . "</span></td>
                        <td class='py-2 border-2 flex justify-center'>
                            <button type='submit' class='btn btn-danger mr-1' name='btncapnhat' value='" . $row["dishID"] . "'>Cập nhật</button>
                        </td>
                    </tr>";
                                $dishData[] = [
                                    "Mã món" => $row["dishID"],
                                    "Tên món" => $row["dishName"],
                                    "Danh mục" => $row["dishCategory"],
                                    "Giá bán" => str_replace(".00", "", number_format($row["price"], "2", ".", ",")),
                                    "Trạng thái" => ($row["businessStatus"] == 1 ? "Đang kinh doanh" : "Ngưng kinh doanh")
                                ];
                            }
                        }
                        $data = json_encode($dishData);
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
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="name" class="w-full py-2"><b>Tên món ăn</b></label>
                                    <input type="text" class="w-full form-control" name="name" value="<?php echo $_SESSION["dishName"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cate" class="w-full py-2"><b>Loại món ăn</b></label>
                                    <input type="text" name="cate" id="cate" class="w-full form-control" value="<?php echo $_SESSION["category"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price" class="w-full py-2"><b>Giá bán</b></label>
                                    <input type="number" class="w-full form-control" name="price" min="<?php echo $_SESSION["price"]; ?>" max="<?php echo $_SESSION["price"]; ?>" value="<?php echo $_SESSION["price"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="availability" class="w-full py-2"><b>Trạng thái sẵn có</b></label>
                                    <input type="text" class="w-full form-control" name="availability" value="<?php echo ($_SESSION["availabilityStatus"] == 1 ? "Còn hàng" : "Hết hàng");?>">
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label for="prepare" class="w-full py-2"><b>Quy trình chế biến</b></label>
                                    <textarea class="w-full form-control h-fit" row="10" name="prepare"><?php echo $_SESSION["prepare"]; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh</b></label>
                                    <img src="../../../images/dish/<?php echo $_SESSION["image"];?>" alt="<?php echo $_SESSION["dishName"];?>" class="w-full h-48 rounded-md">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btnhet" value="<?php echo $_SESSION["dishID"]; ?>"><?php echo ($_SESSION["availabilityStatus"] == 1 ? "Hết hàng" : "Còn hàng");?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    /* Xuất */
    document.getElementById("export").addEventListener("click", function() {
        let data = <?php echo $data; ?>;

        let worksheet = XLSX.utils.json_to_sheet(data);

        let workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách món ăn");

        XLSX.writeFile(workbook, "DishList.xlsx");
    });

    /* In  */
    document.getElementById("print").addEventListener("click", () => {
        var actionColumn = document.querySelectorAll("#dishTable tr td:last-child, #dishTable tr th:last-child");

        actionColumn.forEach(function(cell) {
            cell.style.display = "none";
        });

        var content = document.getElementById("dishTable").outerHTML;

        var printWindow = window.open("", "", "height=500,width=800");

        printWindow.document.write("<html><head><title>In danh sách món ăn</title>");
        printWindow.document.write("<style>table {width: 100%; border-collapse: collapse;} table, th, td {border: 1px solid black; padding: 10px;} </style>");
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h1>Danh sách món ăn</h1>");
        printWindow.document.write(content);
        printWindow.document.write("</body></html>");

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();

        actionColumn.forEach(function(cell) {
            cell.style.display = "block";
        });
    });
</script>