<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $proposalID = $_POST['proposalID'];
    $status = $_POST['status'];
    $sql = "UPDATE proposal SET statusP = $status WHERE proposalID = $proposalID";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật trạng thái thành công');</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại: " . $conn->error . "');</script>";
    }
}
?>
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
                            <th class="text-gray-600 border-2 py-2">Người đề xuất</th>
                            <th class="text-gray-600 border-2 py-2">Loại đề xuất</th>
                            <th class="text-gray-600 border-2 py-2">Nội dung</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    $sql = "SELECT * FROM proposal AS P JOIN user AS U ON P.userID = U.userID";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        if ($row["statusP"] == 1) {
            $statusLabel = "Đã duyệt";
            $statusClass = "bg-green-100 text-green-500";
        } elseif ($row["statusP"] == 2) {
            $statusLabel = "Từ chối";
            $statusClass = "bg-yellow-100 text-yellow-500"; 
        } else {
            $statusLabel = "Chờ duyệt";
            $statusClass = "bg-red-100 text-red-500";
        }

        echo "
            <tr id='proposal-".$row["proposalID"]."'>
                <td class='py-2 border-2'>" . $row["userName"] . "</td>
                <td class='py-2 border-2'>" . $row["typeOfProposal"] . "</td>
                <td class='py-2 border-2'>" . $row["content"] . "</td>
                <td class='py-2 border-2'>
                    <span class='$statusClass py-1 px-2 rounded-lg'>$statusLabel</span>
                </td>
                <td class='py-2 border-2 flex justify-center'>
                    <!-- Form Từ chối -->
                    <form action='' method='POST' style='display: inline-block;'>
                        <input type='hidden' name='proposalID' value='".$row["proposalID"]."'>
                        <input type='hidden' name='status' value='2'> <!-- Từ chối -->
                        <button type='submit' class='btn btn-secondary mr-1' " . ($row["statusP"] != 0 ? "disabled" : "") . ">Từ chối</button>
                    </form>
                    <!-- Form Duyệt -->
                    <form action='' method='POST' style='display: inline-block;'>
                        <input type='hidden' name='proposalID' value='".$row["proposalID"]."'>
                        <input type='hidden' name='status' value='1'> <!-- Duyệt -->
                        <button type='submit' class='btn btn-danger ml-1' " . ($row["statusP"] != 0 ? "disabled" : "") . ">Duyệt</button>
                    </form>
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