<?php

?>
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-center items-center mb-4">
            <h2 class="text-xl font-semibold">
                Thông tin công việc trong tháng
            </h2>
        </div>
        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <form action="" method="POST">
                <table class="text-base w-full text-center">
                    <thead>
                        <tr>
                            <th class="text-gray-600 border-2 py-2">Lịch làm việc</th>
                            <th class="text-gray-600 border-2 py-2">Giờ công</th>
                            <th class="text-gray-600 border-2 py-2">Lương (đồng)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $startW = date("Y-m-d", strtotime("monday this week"));
                        $endW = date("Y-m-d", strtotime("sunday this week"));

                        $userID = $_SESSION["user"][2];
                        $ctrl = new cEmployees;

                        if ($ctrl->cGetEmployeeShiftInfo($userID, $startW, $endW) != 0) {

                            $result = $ctrl->cGetEmployeeShiftInfo($userID, $startW, $endW);
                            $totalHours = 0;
                            $salary = 0;

                            echo "<td class='border-2 py-2'>";
                            while ($row = $result->fetch_assoc()) {
                                $startTime = DateTime::createFromFormat("H:i:s", $row["startTime"]);
                                $endTime = DateTime::createFromFormat("H:i:s", $row["endTime"]);

                                $interval = $startTime->diff($endTime);
                                $hoursWorked = $interval->h + ($interval->i / 60);

                                $totalHours += $hoursWorked;

                                $salary = $totalHours * 23000;

                                $start = $row["startTime"];
                                $end = $row["endTime"];

                                echo "<p class='mb-1'>Ngày: " . date("d-m-Y", strtotime($row["date"])) . ": " . $row["shiftName"] . " (" . substr($row["startTime"], 0, -3) . " - " . substr($row["endTime"], 0, -3) . ")</p>";
                            }
                            echo "</td>";
                            echo "<td class='border-2 py-2'>" . $totalHours . "</td>";
                            echo "<td class='border-2 py-2'>" . number_format($salary, "0", "", ",") . "</td>";
                        } else
                            echo "<tr><td colspan='3' class='pt-2'>Hiện tại chưa có lịch làm việc</td></tr>";
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>