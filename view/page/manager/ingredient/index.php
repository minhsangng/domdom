<?php
if (isset($_POST["btnLuuNL"])) {
    $totalQuantity = $_POST["TotalQuantity"];
    $ingredient = $_POST["Ingre"];
    $userID = $_SESSION["userID"];

    $ctrl = new cImportOrder;
   if( $ctrl->cInsertNeedIngredient($userID, $ingredient, $totalQuantity)) {
    header("Location:index.php?i=ingredient");
   }
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
            <form action="" method="POST">
                <table class="text-base w-full text-center" id="table">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2 w-40">Mã món</th>
                            <th class="text-gray-600 border-2 py-2">Tên món</th>
                            <th class="text-gray-600 border-2 py-2 w-52">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ingredientData = [];
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
                        
                        $sql = "SELECT * FROM dish LIMIT $startFrom, $productsPerPage";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td class='py-2 border-2'>#MA0" . ($row["dishID"] < 10 ? "0".$row["dishID"] : $row["dishID"]) . "</td>
                                    <td class='py-2 border-2'>" . $row["dishName"] . "</td>
                                    <td class='py-2 border-2'><input type='number' value='".$quantity."' class='w-16 py-1 px-3 rounded-md'></td>
                                </tr>";
                                
                            $ingredientData[] = [
                                "Mã món" => $row["dishID"],
                                "Tên món" => $row["dishName"],
                                "Số lượng cần" => $quantity
                            ];
                        }
                        
                        $data = json_encode($ingredientData);
                        ?>
                        <tr>
                            <td colspan="2"></td>
                            <td class="py-2"><button type="submit" class="btn btn-danger" name="btnmo" value="<?php echo $row["dishID"]; ?>">Xác nhận</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
        /* Xuất */
        document.getElementById("export").addEventListener("click", function() {
            let data = <?php echo $data; ?>;

            let worksheet = XLSX.utils.json_to_sheet(data);

            let workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách nguyên liệu cần");

            XLSX.writeFile(workbook, "Danh sách nguyên liệu cần.xlsx");
        });

        /* In  */
        document.getElementById("print").addEventListener("click", () => {
            var actionColumn = document.querySelectorAll("#table tr td:last-child, #table tr th:last-child");

            var content = document.getElementById("table").outerHTML;

            var printWindow = window.open("", "", "height=500,width=800");

            printWindow.document.write("<html><head><title>In danh sách nguyên liệu cần</title>");
            printWindow.document.write("<style>table {width: 100%; border-collapse: collapse;} table, th, td {border: 1px solid black; padding: 10px;} </style>");
            printWindow.document.write("</head><body>");
            printWindow.document.write("<h1>Danh sách nguyên liệu cần</h1>");
            printWindow.document.write(content);
            printWindow.document.write("</body></html>");

            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        });
    </script>