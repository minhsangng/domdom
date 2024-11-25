
// Lấy dữ liệu ca làm
$currentDate = new DateTime();
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
            <div id="registerButtonDiv" class="mt-4">
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded-lg" onclick="registerShifts()">Đăng ký</button>
            </div>
        </div>
    </div>
</div>

<script>
    const workShifts = <?php echo $jsonWorkShifts; ?>;
    const selectedShifts = {}; // Lưu trạng thái ca làm đã chọn theo ngày

    function createCalendar() {
        const calendar = document.getElementById("calendar");
        const startW = new Date("<?php echo $startW; ?>");
        const endW = new Date("<?php echo $endW; ?>");

        calendar.innerHTML = ""; // Xóa lịch cũ trước khi tạo mới

        for (let day = new Date(startW); day <= endW; day.setDate(day.getDate() + 1)) {
            const dateString = day.toISOString().split('T')[0];

            const dayDiv = document.createElement("div");
            dayDiv.classList.add("day", "p-2", "border", "rounded-md", "mb-2");
            dayDiv.textContent = day.getDate();

            // Hiển thị ca làm đã chọn (nếu có)
            if (selectedShifts[dateString]) {
                const selectedShiftDiv = document.createElement("div");
                selectedShiftDiv.classList.add("text-sm", "text-green-500", "mt-2");
                selectedShiftDiv.textContent = `${selectedShifts[dateString].join(", ")}`;
                dayDiv.appendChild(selectedShiftDiv);
            }

            dayDiv.onclick = () => showInfoShift(dateString); // Hiển thị chi tiết ca làm khi nhấn vào ngày
            calendar.appendChild(dayDiv);
        }
    }

    function showInfoShift(date) {
        const infoDiv = document.getElementById("workshift");
        const detailsDiv = document.getElementById("details");
        let subDetails = "";

        workShifts.forEach((shift, index) => {
            const isChecked = selectedShifts[date] && selectedShifts[date].includes(shift.shiftName) ? "checked" : "";
            subDetails += `
                <div class='flex items-center mb-2'>
                    <input type='checkbox' id='${index}' name='input_${date}' value='${shift.shiftName}' ${isChecked}>
                    <label for='${index}'>${shift.shiftName} - (${shift.startTime.slice(0, -3)} - ${shift.endTime.slice(0, -3)})</label>
                </div>`;
        });

        detailsDiv.innerHTML = `
            <p class='mb-3'><strong>Ngày:</strong> ${date}</p>
            <form>
                ${subDetails}
            </form>
            <div class='mt-4'>
                <button type='button' class='bg-blue-500 text-white py-2 px-4 rounded-lg' onclick='saveShift("${date}")'>Lưu ca làm</button>
            </div>`;

        infoDiv.classList.remove("hidden"); // Hiển thị thông tin chi tiết
    }

    function saveShift(date) {
        const selectedShiftsForDay = Array.from(document.querySelectorAll(`input[name="input_${date}"]:checked`))
                                          .map(checkbox => checkbox.value);

        if (selectedShiftsForDay.length > 0) {
            selectedShifts[date] = selectedShiftsForDay; // Lưu ca làm đã chọn
           
            createCalendar(); // Cập nhật lịch để hiển thị trạng thái mới
            showRegisterButton();
        } else {
            alert("Vui lòng chọn ít nhất một ca làm!");
        }
    }

    function showRegisterButton() {
    // Đếm tổng số ca làm đã chọn
    const selectedShiftCount = Object.values(selectedShifts).reduce((count, shifts) => count + shifts.length, 0);

    const registerButtonDiv = document.getElementById("registerButtonDiv");
    if (selectedShiftCount >= 4) {
        registerButtonDiv.classList.remove("hidden"); // Hiển thị nút đăng ký nếu có ít nhất 4 ca làm
    }
}



    function registerShifts() {
        // Lấy tất cả các ngày và ca làm đã chọn
        const selectedDates = [];
        for (let date in selectedShifts) {
            const shifts = selectedShifts[date].join(",");
            selectedDates.push(`${date}/${shifts}`);
        }

        if (selectedDates.length >= 4) {
            // Gửi các ngày và ca làm đã chọn đến server (có thể sử dụng AJAX)
            const formData = new FormData();
            formData.append('btndkca', "<?php echo $_SESSION['userID']; ?>");
            formData.append('input', selectedDates);

            fetch('', { method: 'POST', body: formData })
                .then(response => response.text())
                .then(data => {
                    alert('Đăng ký thành công!');
                    // Cập nhật lại lịch sau khi đăng ký
                    createCalendar();
                });
        } else {
            alert("Vui lòng chọn ít nhất 4 ca làm!");
        }
    }

    // Khởi tạo lịch
    createCalendar();
</script>
