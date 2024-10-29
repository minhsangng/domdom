<?php
$ctrl = new cIngredients;

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
                            <th class="text-gray-600 border-2 py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM ingredient";
                        $result = $conn->query($sql);
            
                        if ($result->num_rows > 0)
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td class='py-2 border-2'>#NL0" . ($row["ingredientID"] < 10 ? "0".$row["ingredientID"] : $row["ingredientID"]) . "</td>
                                        <td class='py-2 border-2'>" . $row["ingredientName"] . "</td>
                                        <td class='py-2 border-2'>" . $row["unitOfcalculaton"] . "</td>
                                        <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                                        <td class='py-2 border-2'>" . $row["typeIngredient"] . "</td>
                                        <td class='py-2 border-2'></td>
                                        <td class='py-2 border-2'><input type='number' class='w-14 rounded-lg px-2 py-1'></td>
                                        <td class='py-2 border-2'><button class='btn btn-primary ml-1' name='btnkhoa'>Nhập</button></td>
                                    </tr>";
                            }
                        else echo "<tr><td colspan='7' class='text-center pt-2'>Chưa có dữ liệu!</td></tr>";
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
