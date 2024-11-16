<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách đề xuất
            </h2>
            <div class="flex items-center">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Tạo đề xuất</button>
            </div>
            <div class="flex items-center">
                <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white" id="export">Xuất <i class="fa-solid fa-table"></i></button>
                <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white" id="print">In <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <table class="text-base w-full text-center">
                <thead>
                    <tr>
                        <th class="text-gray-600 border-2 py-2">Loại đề xuất</th>
                        <th class="text-gray-600 border-2 py-2">Nội dung</th>
                        <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userID = $_SESSION["user"][2];
                    $sql = "SELECT * FROM proposal AS P JOIN user AS U ON P.userID = U.userID WHERE P.userID = $userID";
                    $result = $conn->query($sql);
                    $proposalData = [];

                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td class='py-2 border-2'>" . $row["typeOfProposal"] . "</td>
                                <td class='py-2 border-2'>" . $row["content"] . "</td>
                                <td class='py-2 border-2'><span class='bg-" . ($row["status"] == 1 ? "green" : "red") . "-100 text-" . ($row["status"] == 1 ? "green" : "red") . "-500 py-1 px-2 rounded-lg'>" . ($row["status"] == 1 ? "Đã duyệt" : "Chờ duyệt") . "</span></td>
                            </tr>";
                        $proposalData[] = [
                            "Loại đề xuất" => $row["typeOfProposal"],
                            "Nội dung đề xuất" => $row["content"],
                            "Trạng thái" => $row["status"] == 1 ? "Đã duyệt" : "Chờ duyệt"
                        ];
                    }

                    $data = json_encode($proposalData);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal modalInsert fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full" enctype="multipart/form-data">
                    <div class="modal-header justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Tạo đề xuất</h2>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <table class="w-full" id="table">
                                <tr>
                                    <td>
                                        <label for="type" class="w-full py-2"><b>Loại đề xuất <span class="text-red-500">*</span></b></label>
                                        <select name="type" id="type" class="w-full form-control">
                                            <option value="Đề xuất món ăn">Đề xuất món ăn</option>
                                            <option value="Đề xuất công việc">Đề xuất công việc</option>
                                            <option value="Đề xuất khác">Đề xuất khác</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="content" class="w-full py-2"><b>Nội dung<span class="text-red-500">*</span></b></label>
                                        <input type="text" class="w-full form-control" content="name" required>
                                    </td>
                                </tr>
                            </table>
                        </form>
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
<script>
    /* Xuất */
    document.getElementById("export").addEventListener("click", function() {
        let data = <?php echo $data; ?>;

        let worksheet = XLSX.utils.json_to_sheet(data);

        let workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách đề xuất");

        XLSX.writeFile(workbook, "Danh sách đề xuất.xlsx");
    });

    /* In  */
    document.getElementById("print").addEventListener("click", () => {
        var actionColumn = document.querySelectorAll("#table tr td:last-child, #table tr th:last-child");

        var content = document.getElementById("table").outerHTML;

        var printWindow = window.open("", "", "height=500,width=800");

        printWindow.document.write("<html><head><title>In danh sách đề xuất</title>");
        printWindow.document.write("<style>table {width: 100%; border-collapse: collapse;} table, th, td {border: 1px solid black; padding: 10px;} </style>");
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h1>Danh sách đề xuất</h1>");
        printWindow.document.write(content);
        printWindow.document.write("</body></html>");

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    });
</script>