<?php
$ctrl = new cEmployees;
$ctrlMessage = new cMessage;

$staff = "";

if (isset($_POST["staff"]))
    $staff = $_POST["staff"];

if (isset($_POST["btnxoa"])) {
    $employee = explode("/", $_POST["btnxoa"]);
    $name = $employee[0];
    $time = $employee[1];
    $date = $employee[2];

    if ($ctrl->cGetEmployeeIDByName($name) != 0) {
        $result = $ctrl->cGetEmployeeIDByName($name);
        $row = $result->fetch_assoc();
        $userID = $row["userID"];

        if ($ctrl->cDeleteEmployeeShift($userID, $date) != 0) {
            $ctrl->cDeleteEmployeeShift($userID, $date);
            $ctrlMessage->successMessage("Xóa ca làm");
        } else $ctrlMessage->errorMessage("Xóa ca làm");
    }
}

if (isset($_POST["btnthemnv"])) {
    $userID = (int)$_POST["user"];
    $shiftID = (int)$_POST["shift"];
    $date = $_POST["btnthemnv"];

    /* if ($ctrl->cInsertEmployeeShift($shiftID, $userID, $date) != 0) { */
        $ctrl->cInsertEmployeeShift($shiftID, $userID, $date);
        $ctrlMessage->successMessage("Thêm ca làm");
    /* } else $ctrlMessage->errorMessage("Thêm ca làm"); */
    
    /* print($reuslt = $ctrl->cInsertEmployeeShift($shiftID, $userID, $date)); */
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Bảng phân ca</h2>
            <form action="" method="POST" class="my-auto" id="staffForm">
                <select name="staff" id="" class="form-control w-fit" onchange="document.getElementById('staffForm').submit()">
                    <option value="" <?php echo ($staff != 3 && $staff != 4) ? "selected" : ""; ?>>Tất cả nhân viên</option>
                    <option value="3" <?php echo $staff == 3 ? "selected" : ""; ?>>Nhân viên nhận đơn</option>
                    <option value="4" <?php echo $staff == 4 ? "selected" : ""; ?>>Nhân viên bếp</option>
                </select>
            </form>
            <div class="flex items-center">
                <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
            </div>
        </div>

        <div class="h-fit bg-blue-100 rounded-lg p-4">
            <div id="calendar"></div>

            <?php

            $currentDate = new DateTime();
            $currentWeekDay = $currentDate->format("w");

            $startW = clone $currentDate;
            $startW->modify("-" . ($currentWeekDay - 1) . " days");

            $endW = clone $startW;
            $endW->modify("+13 days");

            $startW = $startW->format("Y-m-d");
            $endW = $endW->format("Y-m-d");

            if ($staff != "")
                $sql = "SELECT * FROM `employee_shift` AS ES JOIN `user` AS U ON ES.userID = U.userID JOIN `shift` AS S ON S.shiftID = ES.shiftID WHERE U.roleID = $staff AND ES.date BETWEEN '$startW' AND '$endW'";
            else
                $sql = "SELECT * FROM `employee_shift` AS ES JOIN `user` AS U ON ES.userID = U.userID JOIN `shift` AS S ON S.shiftID = ES.shiftID WHERE ES.date BETWEEN '$startW' AND '$endW'";

            $result = $conn->query($sql);
            $workShifts = [];

            while ($row = $result->fetch_assoc()) {
                $workShifts[$row["date"]][] = [
                    "employee" => $row["userName"],
                    "time" => $row["shiftName"]
                ];
            }

            $jsonWorkShifts = json_encode($workShifts);
            ?>
            <div class="modal modalInsert fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" class="w-full" method="POST">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5 font-bold text-3xl" id="insertModalLabel" style="color: #E67E22;">Thêm ca làm</h2>
                            </div>
                            <div class="modal-body">
                                <div id="employeeList" class="flex items-center">
                                    <strong class="w-1/3">Chọn nhân viên:</strong>
                                    <?php
                                    $sql = "SELECT * FROM `user` WHERE roleID IN (3, 4)";
                                    $result = $conn->query($sql);

                                    echo '<select name="user" id="" class="w-2/3 form-control">';
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row["userID"] . '">' . $row["userName"] . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </div>
                                <div id="shiftOptions" class="mt-4">
                                    <strong>Chọn ca làm:</strong>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="shiftMo" name="shift" value="1">
                                        <label for="shiftMo" class="form-check-label">Ca sáng (8:00 - 14:00)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="shiftEv" name="shift" value="2">
                                        <label for="shiftEv" class="form-check-label">Ca chiều (14:00 - 20:00)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary" name="btnthemnv" id="btnthem">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const workShifts = <?php echo $jsonWorkShifts; ?>;

        function createCalendar() {
            const calendar = document.getElementById("calendar");

            const startW = new Date("<?php echo $startW; ?>");
            const endW = new Date("<?php echo $endW; ?>");

            for (let day = new Date(startW); day <= endW; day.setDate(day.getDate() + 1)) {
                const dateString = day.toISOString().split('T')[0];
                const dayNumber = day.getDate();

                const dayDiv = document.createElement("div");
                dayDiv.classList.add("day", "bg-white", "p-3", "rounded-lg", "shadow-md", "mb-2", "text-sm", "h-44");
                dayDiv.innerHTML = `<h3 class='bg-orange-400 p-2 w-8 rounded-full text-center text-white font-bold mb-2'>${dayNumber}</h3>`;

                const detailsDiv = document.createElement("div");

                if (workShifts[dateString]) {
                    workShifts[dateString].forEach(shift => {
                        const shiftInfo = document.createElement("div");
                        shiftInfo.classList.add("flex", "items-center", "mb-2");
                        shiftInfo.innerHTML = `<form method='POST' class='m-0 w-full'>
                        <button type='submit' name='btnxoa' value='${shift.employee}/${shift.time}/${dateString}' class='bg-gray-300 p-1 text-center mr-2 rounded-full'>
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <span>${shift.employee} (${shift.time})</span>
                    </form>`;
                        detailsDiv.appendChild(shiftInfo);
                    });
                }

                const addEmployeeDiv = document.createElement("div");
                addEmployeeDiv.classList.add("flex", "items-center", "mb-2");
                addEmployeeDiv.innerHTML = `
                <button class='bg-gray-300 p-1 text-center mr-2 rounded-full' value='${dateString}'  onclick='openModal(this)' data-bs-toggle="modal" data-bs-target="#insertModal">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <span class='text-gray-600'>Thêm ca làm</span>
            `;
                detailsDiv.appendChild(addEmployeeDiv);

                dayDiv.appendChild(detailsDiv);
                calendar.appendChild(dayDiv);
            }
        }

        function openModal(button) {
            document.getElementById("btnthem").value = button.value;
        }

        createCalendar();
    </script>