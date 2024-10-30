<?php

if (isset($_POST["btncc"])) {
    $esID = $_POST["btncc"];
       
    $sql = "UPDATE employee_shift SET status = 1 WHERE employeeshiftID = $esID";
    $result = $conn->query($sql);
    
}

?>    
    
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Danh sách nhân viên
                </h2>
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
                                <th class="text-gray-600 border-2 py-2">Mã NV</th>
                                <th class="text-gray-600 border-2 py-2">Họ tên</th>
                                <th class="text-gray-600 border-2 py-2">Ca làm việc</th>
                                <th class="text-gray-600 border-2 py-2">Trạng thái</th>
                                <th class="text-gray-600 border-2 py-2">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `user` AS U JOIN `role` AS R ON U.roleID = R.roleID JOIN employee_shift AS ES ON ES.userID = U.userID JOIN shift AS S ON S.shiftID = ES.shiftID WHERE ES.date = CURDATE()";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0)
                            while ($row = $result->fetch_assoc()) {
                                if ($row["roleID"] == 3 || $row["roleID"] == 4) {
                                    echo "
                                    <tr>
                                        <td class='py-2 border-2'>#NV0" . ($row["userID"] < 10 ? "0" . $row["userID"] : $row["userID"]) . "</td>
                                        <td class='py-2 border-2'>".$row["userName"]."</td>
                                        <td class='py-2 border-2'>".$row["shiftName"]."</td>
                                        <td class='py-2 border-2'><span class='bg-".($row["status"] == 1 ? "green" : "red")."-100 text-".($row["status"] == 1 ? "green" : "red")."-500 px-3 py-1 rounded-lg'>".($row["status"] == 1 ? "Có mặt" : "Vắng")."</span></td>
                                        <td class='py-2 border-2'><button type='submit' value='".$row["employeeshiftID"]."' name='btncc' class='btn btn-danger'>Chấm công</button></td>
                                    </tr>
                                    ";
                                }
                            }
                            else echo "<tr><td class='py-2' colspan='5'>Không có dữ liệu!</td></tr>";
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
                    <table class="w-full">
                            <tr>
                                <td>
                                    <label for="userName" class="w-full py-2"><b>Tên nhân viên</b></label>
                                    <input type="text" class="w-full form-control" name="userName" value="<?php echo $_SESSION["userName"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="dateBirth" class="w-full py-2"><b>Ngày sinh</b></label>
                                    <input type="date" class="w-full form-control" name="dateBirth" value="<?php echo $_SESSION["dateBirth"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone" class="w-full py-2"><b>Số điện thoại</b></label>
                                    <input type="text" class="w-full form-control" name="phone"  value="<?php echo $_SESSION["phone"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" class="w-full py-2"><b>Email</b></label>
                                    <input type="text" class="w-full form-control" name="email"  value="<?php echo $_SESSION["email"]; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh</b></label>
                                    <input type="file" class="w-full form-control" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="pass" class="w-full py-2"><b>Mật khẩu đăng nhập</b></label>
                                    <input type="text" class="w-full form-control" name="pass">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sex" class="w-full py-2"><b>Giới tính</b></label>
                                    <input type="radio" class="mr-1" name="sex" value="1" id="male"><label for="male" class="mr-4">Nam</label>
                                    <input type="radio" class="mr-1" name="sex" value="0" id="female"><label for="female">Nữ</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="role" class="w-full py-2"><b>Vai trò</b></label>
                                    <input type="radio" class="mr-1" name="role" value="2" id="qlch"><label for="qlch" class="mr-4">QL cửa hàng</label>
                                    <input type="radio" class="mr-1" name="role" value="3" id="nvnd"><label for="nvnd" class="mr-4">NV nhận đơn</label>
                                    <input type="radio" class="mr-1" name="role" value="4" id="nvb"><label for="nvb">NV bếp</label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" name="btndong" data-bs-dismiss="modal" onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalUpdate = new bootstrap.Modal(document.querySelector('.modalUpdate')); modalUpdate.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuanv">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>