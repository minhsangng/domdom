<?php

if (isset($_POST["btndd"])) {
    $esID = $_POST["btndd"];

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
                        $ctrl = new cEmployees;
                        $storeID = $_SESSION["user"][1];

                        if ($ctrl->cGetEmployeeAttendance($storeID) != 0) {
                            $result = $ctrl->cGetEmployeeAttendance($storeID);

                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td class='py-2 border-2'>#NV0" . ($row["userID"] < 10 ? "0" . $row["userID"] : $row["userID"]) . "</td>
                                        <td class='py-2 border-2'>" . $row["userName"] . "</td>
                                        <td class='py-2 border-2'>" . $row["shiftName"] . "</td>
                                        <td class='py-2 border-2'><span class='bg-" . ($row["status"] == 1 ? "green" : "red") . "-100 text-" . ($row["status"] == 1 ? "green" : "red") . "-500 px-3 py-1 rounded-lg'>" . ($row["status"] == 1 ? "Đã chấm công" : "Chưa chấm công") . "</span></td>
                                        <td class='py-2 border-2'><button type='submit' value='" . $row["employeeshiftID"] . "' name='btndd' class='btn btn-danger'>Chấm công</button></td>
                                    </tr>
                                    ";
                            }
                        } else echo "Không có dữ liệu!";
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>