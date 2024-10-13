    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex flex-col justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Bảng chấm công tháng <?php echo date("m"); ?></h2>
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Tổng giờ làm</th>
                            <th>Vai trò</th>
                            <th>Lương</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT U.userID, U.userName, R.roleName, COUNT(*) AS Quantity, TIMEDIFF(S.endTime, S.startTime) AS Hour FROM users AS U JOIN employee_shifts AS ES JOIN shifts AS S ON S.shiftID = ES.shiftID JOIN roles AS R ON R.roleID = U.roleID GROUP BY U.userID";
                        $result = $conn->query($sql);
                        $salary = 0;
                        $bonusSalary = 1;

                        if ($result->num_rows != 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row["Hour"] > 100) 
                                    $bonusSalary = 1.5;
                                    
                                $salary = $row["Quantity"] * $row["Hour"] * 23000 * $bonusSalary;
                                echo "<tr>
                                        <td>".$row["userID"]."</td>
                                        <td>".$row["userName"]."</td>
                                        <td>".$row["Quantity"] * $row["Hour"]."</td>
                                        <td>".$row["roleName"]."</td>
                                        <td>".number_format($salary, 2, '.', ',')."</td>
                                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>