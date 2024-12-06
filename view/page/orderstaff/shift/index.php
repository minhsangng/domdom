<?php
if (isset($_POST["btndkca"])) {
    $userID = $_POST["btndkca"];
    $arrDay = $_POST["input"];
    $arr = explode("/", $arrDay);
    $date = $arr[0];
    $shiftName = $arr[1];
    
    $sql = "SELECT shiftID FROM shift WHERE shiftName = '$shiftName'";
    $result = $conn->query($sql)->fetch_assoc();
    
    $shiftID = $result["shiftID"];
    
    $sql = "INSERT INTO employee_shift (userID, shiftID, date) VALUES ($userID, $shiftID, '$date')";
    $result = $conn->query($sql);
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('Đăng ký ca làm thành công');
        });
    </script>";
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-center items-center mb-4">
            <h2 class="text-xl font-semibold">Đăng ký ca làm việc</h2>
        </div>
        <div class="h-fit bg-blue-100 rounded-lg p-4">
            <div id="calendar"></div>

            <div id="workshift" class="hidden">
                <h2 class="font-bold text-xl py-1">Thông tin ca làm</h2>
                <div id="details"></div>
            </div>

            <?php
            $currentDate = new DateTime();
            $currentWeekDay = $currentDate->format('w');

            $startW = clone $currentDate;
            $startW->modify('next Monday');

            $endW = clone $startW;
            $endW->modify('+6 days');

            $startW = $startW->format('Y-m-d');
            $endW = $endW->format('Y-m-d');

            $sql = "SELECT * FROM `shift`";
            $result = $conn->query($sql);
            $workShifts = [];

            while ($row = $result->fetch_assoc()) {
                $workShifts[] = [
                    "shiftName" => $row["shiftName"],
                    "startTime" => $row["startTime"],
                    "endTime" => $row["endTime"]
                ];
            }
            $jsonWorkShifts = json_encode($workShifts);
            ?>
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

                const dayDiv = document.createElement("div");
                dayDiv.classList.add("day");
                dayDiv.textContent = day.getDate();

                dayDiv.onclick = () => showInfoShift(dateString);


                calendar.appendChild(dayDiv);
            }
        }

        function showInfoShift(date) {
            const infoDiv = document.getElementById("workshift");
            const detailsDiv = document.getElementById("details");
            let subDetails = "";

                workShifts.forEach((shift, index) => {
                    subDetails += `
                        <div class='flex items-center mb-2'>
                            <input type='radio' class='size-4 mr-2' id='${index}' name='input' value='${date}/${shift.shiftName}' class="mr-4"><label for='${index}'>${shift.shiftName} - (${shift.startTime.slice(0, -3)} - ${shift.endTime.slice(0, -3)})</label></input>
                        </div>`;
                });

                detailsDiv.innerHTML = `<p class='mb-3'><strong>Ngày:</strong> ${date}</p><form method='POST'>` + subDetails + `
                    <div class='mt-4'>
                        <button type='submit' class='bg-blue-500 text-white py-2 px-4 rounded-lg' name='btndkca' value='<?php echo $_SESSION["userID"]; ?>'>Đăng ký</button>
                    </div>
                </form>`;


            infoDiv.classList.remove("hidden");
        }


        createCalendar();
    </script>