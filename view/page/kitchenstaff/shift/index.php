<?php
    // Lấy dữ liệu ca làm từ cơ sở dữ liệu
    $sql = "SELECT * FROM `shift`";
    $result = $conn->query($sql);
    $workShifts = [];
    while ($row = $result->fetch_assoc()) {
        $workShifts[] = $row; // Chứa các thông tin ca làm tất cả
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['shift'])) {
        $userID = $_SESSION['userID'];
        $selectedShifts = $_POST['shift']; // Dữ liệu ca làm đã chọn
        $totalShifts = 0; // Đếm tổng số ca làm

        // Đếm tổng số ca làm được chọn
        foreach ($selectedShifts as $date => $shifts) {
            $totalShifts += count($shifts);
        }

        if ($totalShifts >= 4) {
            foreach ($selectedShifts as $date => $shifts) {
                foreach ($shifts as $shiftName) {
                    // Lấy shiftID từ shiftName
                    $query = "SELECT shiftID FROM shift WHERE shiftName = '$shiftName'";
                    $result = $conn->query($query);

                    if ($result && $row = $result->fetch_assoc()) {
                        $shiftID = $row['shiftID'];

                        // Thêm thông tin vào bảng employee_shift

                        $dateForDatabase = DateTime::createFromFormat('d-m-Y', $date)->format('Y-m-d');

                        $insertQuery = "INSERT INTO employee_shift (userID, shiftID, date) VALUES ($userID, $shiftID, '$dateForDatabase')";
                        $conn->query($insertQuery);
                    } else {
                        echo "<script>alert('Ca làm không tồn tại: $shiftName');</script>";
                    }
                }
            }
            echo "<script>alert('Đăng ký ca làm thành công!');</script>";
        } else {
            echo "<script>alert('Vui lòng chọn ít nhất 4 ca làm!');</script>";
        }
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
                        echo "<div class='day p-2 border rounded-md mb-2'>";
                        echo "<strong>{$day->format('l')}</strong><br>";
                        echo "{$day->format('d-m-Y')}<br>";
                        
                        foreach ($workShifts as $shift) {
                            echo "<div class='my-2'><label>";
                            echo "<input type='checkbox' name='shift[{$dateString}][]' value='{$shift['shiftName']}'> {$shift['shiftName']}";
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
