<?php
$ctrl = new cEmployees;
$ctrlMessage = new cMessage;

if (!isset($_SESSION["shifts"]))
    $_SESSION["shifts"] = [];
    
// Lấy dữ liệu ca làm từ cơ sở dữ liệu
if ($ctrl->cGetAllShift() != 0) {
    $result = $ctrl->cGetAllShift();
    $workShifts = [];
    while ($row = $result->fetch_assoc()) {
        $workShifts[] = $row; // Chứa các thông tin ca làm tất cả
    }
} else echo "Không có dữ liệu ca làm việc!";

if (isset($_POST["shift"])) {
    $userID = $_SESSION["user"][0];
    $selectedShifts = $_POST["shift"]; // Dữ liệu ca làm đã chọn
    $totalShifts = 0; // Đếm tổng số ca làm

    // Đếm tổng số ca làm được chọn
    foreach ($selectedShifts as $date => $shifts) {
        $totalShifts += count($shifts);
    }

    if ($totalShifts >= 4) {
        foreach ($selectedShifts as $date => $shifts) {
            foreach ($shifts as $shiftName) {
                // Lấy shiftID từ shiftName
                if ($ctrl->cGetShiftIDByName($shiftName) != 0) {
                    $result = $ctrl->cGetShiftIDByName($shiftName);
                    $row = $result->fetch_assoc();
                    $shiftID = $row["shiftID"];
                    $_SESSION["shifts"][] = [
                        "date" => $date,
                        "shiftName" => $shiftName,
                    ];
                    
                    // Thêm thông tin vào bảng employee_shift
                    $dateForDatabase = DateTime::createFromFormat("d-m-Y", $date)->format("Y-m-d");

                    $ctrl->cInsertEmployeeShift($shiftID, $userID, $dateForDatabase);
                    $ctrlMessage->successMessage("Đăng ký ca làm ");
                } else $ctrlMessage->falseMessage("Không tồn tại ca làm: $shiftName");
            }
        }
    } else $ctrlMessage->falseMessage("Vui lòng chọn ít nhất 4 ca làm 1 tuần!");
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-center items-center mb-4">
            <h2 class="text-xl font-semibold">Đăng ký ca làm việc</h2>
        </div>
        <div class="h-fit bg-blue-100 rounded-lg p-4">
            <form method="POST" action="">
                <div id="calendar">
                    <?php
                    $currentDate = new DateTime();
                    $startW = clone $currentDate;
                    $startW->modify('next Monday');
                    $endW = clone $startW;
                    $endW->modify('+6 days');

                    $days = [];
                    for ($i = 0; $i < 7; $i++) {
                        $day = clone $startW;
                        $day->modify("+$i days");
                        $days[] = $day;
                    }

                    // Hiển thị các ngày trong tuần và ca làm cho từng ngày
                    foreach ($days as $day) {
                        $dateString = $day->format('d-m-Y'); // Định dạng ngày
                        echo "<div class='day p-2 border-2 border-amber-100 rounded-md mb-2'>";
                        echo "<h3 class='font-bold border-b-2 border-amber-200 pb-2 mb-2 text-center'>{$day->format('l')}</h3>";
                        echo "<h4 class='mb-3 text-center'>{$day->format('d-m-Y')}</h4>";

                        foreach ($workShifts as $shift) {
                            $isChecked = "";
                            if (isset($_SESSION["shifts"])) {
                                foreach ($_SESSION["shifts"] as $registeredShift) {
                                    if ($registeredShift["date"] === $dateString && $registeredShift["shiftName"] === $shift["shiftName"]) {
                                        $isChecked = "checked";
                                        break;
                                    }
                                }
                            }
                            
                            echo "<div class='my-2'><label>";
                            echo "<input type='checkbox' name='shift[{$dateString}][]' value='{$shift['shiftName']}' {$isChecked}> {$shift['shiftName']}";
                            echo "</label><br> </div>";
                        }
                        echo "</div>";
                    }
                    ?>
                </div>

                <div id="registerButtonDiv" class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg" name="submitShifts">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>