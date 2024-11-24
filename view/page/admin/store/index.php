<?php

if (isset($_POST["btnthemch"])) {
    $storeID = $_SESSION["storeID"];
    $storeName = $_POST["storeName"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $status = $_POST["status"];    
    $sql = "INSERT INTO store (storeName, address, contact, status) 
            VALUES ('$storeName', '$address', '$contact', 1)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Cửa hàng đã được thêm thành công');
                window.location.href = ''
              </script>";
    } else {
        echo "Thêm thất bại";
    }
}

if (isset($_POST["btncapnhat"])) {
    $storeID = $_POST["btncapnhat"];
    $sql = "SELECT * FROM store WHERE storeID = $storeID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["storeID"] = $row["storeID"];
        $_SESSION["storeName"] = $row["storeName"];
        $_SESSION["address"] = $row["address"];
        $_SESSION["contact"] = $row["contact"];
    } else {
        echo "<script>alert('Không tìm thấy cửa hàng!');</script>";
    }

    echo "<script>
         document.addEventListener('DOMContentLoaded', function() {
             var modalUpdate = new bootstrap.Modal(document.getElementById('updateModal')); 
             modalUpdate.show();
         });
       </script>";
}

if (isset($_POST["btnsuach"])) {

    $storeID = $_POST["storeID"];
    $storeName = $_POST["storeName"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    echo "storeID: $storeID, storeName: $storeName, address: $address, contact: $contact";

    $sql = "UPDATE store SET storeName='$storeName', address='$address', 
        contact='$contact' WHERE storeID=$storeID";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Cửa hàng đã được cập nhật thành công!');
            window.location.href = '';
        </script>";
    } else {
        echo "Cập nhật thất bại: " . $conn->error;
    }
}



//////////Khoa
if (isset($_POST["btnkhoa"])) {
    $storeID = $_POST["btnkhoa"];
    $status = $_POST["btnkhoa"];
    $newStatus = ($status == 1) ? 0 : 1; 
    $sqlUpdate = "UPDATE store SET status = 0 WHERE storeID = $storeID";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "<script>
                alert('Cửa hàng đã được khóa thành công!');
                setTimeout(function() {
                    window.location.href = '';}, 2000); 
              </script>";
    } else {
        echo "<script>alert('Khóa cửa hàng thất bại!');</script>";
    }
}




?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách cửa hàng
            </h2>
            <div class="flex items-center">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Thêm cửa hàng</button>
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
                            <th class="text-gray-600 border-2 py-2">Mã CH</th>
                            <th class="text-gray-600 border-2 py-2">Tên CH</th>
                            <th class="text-gray-600 border-2 py-2">Địa chỉ</th>
                            <th class="text-gray-600 border-2 py-2">Liên hệ</th>
                            <th class="text-gray-600 border-2 py-2">Quản lý</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `store`";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            $storeID = $row["storeID"];
                            $sql2 = "SELECT * FROM user WHERE userID = $storeID + 1";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();



                            echo "
                                <tr>
                                    <td class='py-2 border-2'>#CH0" . $row["storeID"] . "</td>
                                    <td class='py-2 border-2'>" . $row["storeName"] . "</td>
                                    <td class='py-2 border-2'>" . $row["address"] . "</td>
                                    <td class='py-2 border-2'>" . $row["contact"] . "</td>
                                    <td class='py-2 border-2'>" . $row2["userName"] . "</td>
                                    <td class='py-2 border-2'><span class='bg-green-100 text-green-500 py-1 px-2 rounded-lg'>" . ($row["status"] == 1 ? "Đang hoạt động" : "Ngưng hoạt động") . "</span></td>
                                    <td class='py-2 border-2 flex justify-center items-center'>
                                        <button class='btn btn-secondary mr-1' name='btncapnhat' value='" . $row["storeID"] . "'>Cập nhật</button>
                                        <button class='btn btn-danger ml-1' name='btnkhoa' value='".$row["status"]."' onclick='this.form.userID.value=".$row["userID"]."'>".($row["status"] == 1 ? "Khóa" : "Mở")."</button>                                          
                                    </td>
                                </tr>
                                ";
                        }
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
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm cửa hàng</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="storeName" class="w-full py-2"><b>Tên cửa hàng <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="storeName" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address" class="w-full py-2"><b>Địa chỉ <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="address" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="contact" class="w-full py-2"><b>Thông tin liên hệ <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="contact" required>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnthemch">Thêm</button>
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
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="updateModalLabel" style="color: #E67E22;">Cập nhật cửa hàng</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="storeName" class="w-full py-2"><b>Tên cửa hàng</b></label>
                                    <input type="text" class="w-full form-control" name="storeName" value="<?php echo $_SESSION["storeName"];?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address" class="w-full py-2"><b>Địa chỉ</b></label>
                                    <input type="text" class="w-full form-control" name="address" value="<?php echo $_SESSION["address"];?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="contact" class="w-full py-2"><b>Thông tin liên hệ</b></label>
                                    <input type="text" class="w-full form-control" name="contact" value="<?php echo $_SESSION["contact"];?>">
                                </td>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" name="btndong" data-bs-dismiss="modal" onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalUpdate = new bootstrap.Modal(document.querySelector('.modalUpdate')); modalUpdate.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuach">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>