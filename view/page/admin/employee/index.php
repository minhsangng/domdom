<?php
// Cập nhật thông tin nhân viên
if (isset($_POST["btncapnhat"])) {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalUpdate = new bootstrap.Modal(document.getElementById('updateModal')); 
        modalUpdate.show();
    });
  </script>";

    $userID = $_POST["btncapnhat"];
    $sql = "SELECT * FROM user WHERE userID = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row["userName"];
        $phone = $row["phoneNumber"];
        $email = $row["email"];
        $dateBirth = $row["dateBirth"];
        $sex = $row["sex"];
        $roleID = $row["roleID"];
    } else {
        echo "<script>alert('Không tìm thấy nhân viên!');</script>";
    }
}

if (isset($_POST["btnsuanv"])) {

    $userID = $_POST["userID"];
    $userName = $_POST["userName"];
    $dateBirth = $_POST["dateBirth"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $sex = $_POST["sex"];
    $role = $_POST["role"];

    $sqlUpdate = "UPDATE user SET 
        userName = '$userName', 
        dateBirth = '$dateBirth', 
        phoneNumber = '$phone', 
        email = '$email', 
        sex = '$sex', 
        roleID = $role 
        WHERE userID = $userID";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "<script>
                    alert('Cập nhật thành công!');
                  </script>";
    } else {
        echo "<script>alert('Cập nhật thất bại! Lỗi: " . $conn->error . "');</script>";
    }
}

// Trạng thái nhân viên
if (isset($_POST["btnkhoa"])) {
    $status = $_POST["btnkhoa"];
    $userID = $_POST["userID"];

    $newStatus = ($status == 1) ? 0 : 1;

    $sql = "UPDATE user SET status = '$newStatus' WHERE userID = '$userID'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật trạng thái tài khoản thành công!'); </script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật trạng thái tài khoản.');</script>";
    }
}

// Thêm nhân viên
if (isset($_POST["btnthemnv"])) {
    $userName = $_POST["userName"];
    $dateBirth = $_POST["dateBirth"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $sex = $_POST["sex"];
    $role = $_POST["role"];
    $pass = md5($_POST["pass"]);
    $image = $_FILES["image"]["name"];

    if ($image) {
        $targetDir = "images/user/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    $sql = "INSERT INTO user (userName, dateBirth, phoneNumber, email, sex, roleID, password, image) 
            VALUES ('$userName', '$dateBirth', '$phone', '$email', '$sex', '$role', '$pass', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm nhân viên thành công!'); </script>";
    } else {
        echo "<script>alert('Thêm nhân viên thất bại.');</script>";
    }
}

?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">
                Danh sách nhân viên
            </h2>
            <div class="flex items-center">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Thêm nhân viên</button>
            </div>
            <div class="flex items-center">
                <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white" id="export">Xuất <i class="fa-solid fa-table"></i></button>
                <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white" id="print">In <i class="fa-solid fa-print"></i></button>
            </div>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <form action="" method="POST">
                <table class="text-sm w-full text-center" id="table">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Mã NV</th>
                            <th class="text-gray-600 border-2 py-2 w-28">Họ tên</th>
                            <th class="text-gray-600 border-2 py-2">Số điện thoại</th>
                            <th class="text-gray-600 border-2 py-2">Email</th>
                            <th class="text-gray-600 border-2 py-2">Ngày sinh</th>
                            <th class="text-gray-600 border-2 py-2">Giới tính</th>
                            <th class="text-gray-600 border-2 py-2">Vai trò</th>
                            <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                            <th class="text-gray-600 border-2 py-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `user` AS U JOIN `role` AS R ON U.roleID = R.roleID WHERE R.roleID != 1";
                        $result = $conn->query($sql);
                        $employeeData = [];

                        while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td class='py-2 border-2'>#NV0" . ($row["userID"] < 10 ? "0" . $row["userID"] : $row["userID"]) . "</td>
                                        <td class='py-2 border-2'>" . $row["userName"] . "</td>
                                        <td class='py-2 border-2'>" . $row["phoneNumber"] . "</td>
                                        <td class='py-2 border-2'>" . $row["email"] . "</td>
                                        <td class='py-2 border-2'>" . date("d-m-Y", strtotime($row["dateBirth"])) . "</td>
                                        <td class='py-2 border-2'>" . ($row["sex"] == 1 ? "Nam" : "Nữ") . "</td>
                                        <td class='py-2 border-2'>" . $row["roleName"] . "</td>
                                        <td class='py-2 border-2'><span class='bg-" . ($row["status"] == 1 ? "green" : "red") . "-100 text-" . ($row["status"] == 1 ? "green" : "red") . "-500 py-1 px-2 rounded-lg'>" . ($row["status"] == 1 ? "Đang làm" : "Đã nghỉ") . "</span></td>
                                        <td class='py-2 border-2 flex justify-center items-center'>
                                            <button class='btn btn-secondary mr-1' value='" . $row["userID"] . "' name='btncapnhat'>Cập nhật</button>
                                            <button class='btn btn-danger ml-1' name='btnkhoa' value='" . $row["status"] . "' onclick='this.form.userID.value=" . $row["userID"] . "'>" . ($row["status"] == 1 ? "Khóa" : "Mở") . "</button>                                          
                                        </td>
                                    </tr>
                                    ";
                                    
                                    $employeeData[] = [
                                        "Mã nhân viên" => $row["userID"],
                                        "Tên nhân viên" => $row["userName"],
                                        "Số điện thoại" => $row["phoneNumber"],
                                        "Email" => $row["email"],
                                        "Ngày sinh" => $row["dateBirth"],
                                        "Giới tính" => $row["sex"] == 1 ? "Nam" : "Nữ",
                                        "Vai trò" => $row["roleName"],
                                        "Trạng thái" => $row["status"] == 1 ? "Đang làm" : "Đã nghỉ"
                                    ];
                        }
                        
                        $data = json_encode($employeeData);
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
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm nhân viên</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="userName" class="w-full py-2"><b>Tên nhân viên <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="userName">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="dateBirth" class="w-full py-2"><b>Ngày sinh <span class="text-red-500">*</span></b></label>
                                    <input type="date" class="w-full form-control" name="dateBirth">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone" class="w-full py-2"><b>Số điện thoại <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="phone">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" class="w-full py-2"><b>Email <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="email">
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
                                    <label for="pass" class="w-full py-2"><b>Mật khẩu đăng nhập <span class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="pass">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sex" class="w-full py-2"><b>Giới tính <span class="text-red-500">*</span></b></label>
                                    <input type="radio" class="mr-1" name="sex" value="1" id="male"><label for="male" class="mr-4">Nam</label>
                                    <input type="radio" class="mr-1" name="sex" value="0" id="female"><label for="female">Nữ</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="role" class="w-full py-2"><b>Vai trò <span class="text-red-500">*</span></b></label>
                                    <input type="radio" class="mr-1" name="role" value="2" id="qlch"><label for="qlch" class="mr-4">QL cửa hàng</label>
                                    <input type="radio" class="mr-1" name="role" value="3" id="nvnd"><label for="nvnd" class="mr-4">NV nhận đơn</label>
                                    <input type="radio" class="mr-1" name="role" value="4" id="nvb"><label for="nvb">NV bếp</label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnthemnv">Thêm</button>
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
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="updateModalLabel" style="color: #E67E22;">Cập nhật nhân viên</h2>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label for="userName" class="w-full py-2"><b>Tên nhân viên</b></label>
                                    <input type="text" class="w-full form-control" name="userName" value="<?php echo $userName; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="dateBirth" class="w-full py-2"><b>Ngày sinh</b></label>
                                    <input type="date" class="w-full form-control" name="dateBirth" value="<?php echo $dateBirth; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone" class="w-full py-2"><b>Số điện thoại</b></label>
                                    <input type="text" class="w-full form-control" name="phone" value="<?php echo $phone; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" class="w-full py-2"><b>Email</b></label>
                                    <input type="text" class="w-full form-control" name="email" value="<?php echo $email; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sex" class="w-full py-2"><b>Giới tính</b></label>
                                    <input type="radio" class="mr-1" name="sex" value="1" <?php echo ($sex == 1) ? 'checked' : ''; ?> id="male"><label for="male" class="mr-4">Nam</label>
                                    <input type="radio" class="mr-1" name="sex" value="0" <?php echo ($sex == 0) ? 'checked' : ''; ?> id="female"><label for="female">Nữ</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="role" class="w-full py-2"><b>Vai trò</b></label>
                                    <input type="radio" class="mr-1" name="role" value="2" <?php echo ($roleID == 2) ? 'checked' : ''; ?> id="qlch"><label for="qlch" class="mr-4">QL cửa hàng</label>
                                    <input type="radio" class="mr-1" name="role" value="3" <?php echo ($roleID == 3) ? 'checked' : ''; ?> id="nvnd"><label for="nvnd" class="mr-4">NV nhận đơn</label>
                                    <input type="radio" class="mr-1" name="role" value="4" <?php echo ($roleID == 4) ? 'checked' : ''; ?> id="nvb"><label for="nvb">NV bếp</label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuanv">Cập nhật</button>
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
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách nhân viên");

        XLSX.writeFile(workbook, "Danh sách nhân viên.xlsx");
    });

    /* In  */
    document.getElementById("print").addEventListener("click", () => {
        var actionColumn = document.querySelectorAll("#table tr td:last-child, #table tr th:last-child");

        actionColumn.forEach(function(cell) {
            cell.style.display = "none";
        });

        var content = document.getElementById("table").outerHTML;

        var printWindow = window.open("", "", "height=500,width=800");

        printWindow.document.write("<html><head><title>In danh sách nhân viên</title>");
        printWindow.document.write("<style>table {width: 100%; border-collapse: collapse;} table, th, td {border: 1px solid black; padding: 10px;} </style>");
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h1>Danh sách nhân viên</h1>");
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