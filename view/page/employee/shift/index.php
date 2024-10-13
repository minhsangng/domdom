    <div class="grid grid-cols-1 h-fit md:grid-cols-1 gap-6 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Lịch làm việc
                </h2>
                <div class="currentMonth">
                    <form action="" method="post" class="revenueMonth flex items-center my-auto">
                        <input type="date" name="startM" id="startM" class="bg-gray-100 border-solid border-2 rounded-lg py-1 px-3" value="<?php echo $startW; ?>"> <span class="mx-2">đến</span>
                        <input type="date" name="endM" id="endM" class="bg-gray-100 border-solid border-2 rounded-lg py-1 px-3 mr-1" value="<?php echo $endW; ?>">
                        <button type="submit" name="btnxem" class="btn btn-primary ml-1 py-2 px-4 rounded-lg">Xem</button>
                    </form>
                </div>
                <div class="flex items-center">
                    <button class="btn bg-green-100 text-green-500 py-2 px-4 rounded-lg mr-1 hover:bg-green-500 hover:text-white">Xuất <i class="fa-solid fa-table"></i></button>
                    <button class="btn bg-blue-100 text-blue-500 py-2 px-4 rounded-lg ml-1 hover:bg-blue-500 hover:text-white">In <i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="h-fit bg-gray-100 rounded-lg p-6">
                <div id="calendar"></div>

                <div id="info" class="hidden">
                    <h2 class="font-bold text-xl py-1">Thông tin ca làm</h2>
                    <div id="details"></div>
                </div>

                <?php
                $sql = "SELECT * FROM employee_shifts AS ES JOIN users AS U ON ES.userID = U.userID JOIN shifts AS S ON S.shiftID = ES.shiftID";
                $result = $conn->query($sql);
                $workShifts = [];

                while ($row = $result->fetch_assoc()) {
                    $workShifts[$row["shiftDate"]][] = [
                        "employee" => $row["userName"],
                        "time" => $row["startTime"]
                    ];
                }

                $jsonWorkShifts = json_encode($workShifts);
                ?>
            </div>
        </div>

        <script>
            /* Workshifts */
            const workShifts = <?php echo $jsonWorkShifts; ?>;

            function createCalendar() {
                const calendar = document.getElementById("calendar");

                const startW = new Date("<?php echo $startW; ?>");
                const endW = new Date("<?php echo $endW; ?>");

                for (let day = new Date(startW); day <= endW; day.setDate(day.getDate() + 1)) {
                    const dateString = day.toISOString().split('T')[0];

                    const dayDiv = document.createElement("div");
                    dayDiv.classList.add("day");
                    dayDiv.textContent = day.getDate();

                    if (workShifts[dateString]) {
                        const dot = document.createElement("div");
                        dot.classList.add("dot");
                        dot.style.display = "block";
                        dayDiv.appendChild(dot);

                        dayDiv.onclick = () => showInfoShift(dateString);
                    }

                    calendar.appendChild(dayDiv);
                }
            }

            function showInfoShift(date) {
                const infoDiv = document.getElementById("info");
                const detailsDiv = document.getElementById("details");
                const shifts = workShifts[date];

                detailsDiv.innerHTML = `<p><strong>Ngày:</strong> ${date}</p>`;

                if (shifts) {
                    shifts.forEach(shift => {
                        detailsDiv.innerHTML += `<p>${shift.employee} (${shift.time})</p>`;
                    });
                } else {
                    detailsDiv.innerHTML += `<p>Không có thông tin ca làm cho ngày này.</p>`;
                }

                infoDiv.classList.remove("hidden");
            }

            createCalendar();
        </script>