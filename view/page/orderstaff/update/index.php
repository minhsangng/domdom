<?php
if (isset($_POST["btnchuyen"])) {
    $arr = explode("/", $_POST["btnchuyen"]);
    $id = $arr[0];
    $status = $arr[1];

    if ($status < 4)
        $newStatus = $status + 1;
    else
        $newStatus = 0;

    $ctrl = new cOrders;
    $result = $ctrl->cUpdateStatusOrder($id, $newStatus);

    $ctrlMessage = new cMessage;
    if ($result != 0)
        $ctrlMessage->successMessage("Cập nhật trạng thái");
    else
        $ctrlMessage->errorMessage("Cập nhật trạng thái");
}
?>

<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-center items-center mb-4">
            <h2 class="text-lg font-semibold">
                Danh sách đơn hàng
            </h2>
        </div>

        <div class="h-fit bg-gray-100 rounded-lg p-6">
            <?php
            $ctrl = new cOrders;

            if ($ctrl->cGetAllOrderFully() != 0) {
                $result = $ctrl->cGetAllOrderFully();

                echo "
                        <table class='w-full text-base text-center'>
                            <thead>
                                <tr>
                                    <th class='text-gray-600 border-2 py-2'>Mã đơn</th>
                                    <th class='text-gray-600 border-2 py-2'>Ngày &amp; giờ</th>
                                    <th class='text-gray-600 border-2 py-2'>Tổng giá trị</th>
                                    <th class='text-gray-600 border-2 py-2'>Trạng thái</th>
                                </tr>
                            </thead>
                        <tbody>
                        ";
                while ($row = $result->fetch_assoc()) {
                    $amount = str_replace(".00", "", number_format($row["total"], "2", ".", ","));
                    $orderID = $row["orderID"];
                    $cusName = $row["fulName"];
                    $orderName = $row["dishName"];
                    $orderQuantity = $row["quantity"];
                    $orderDate = $row["orderDate"];
                    $status = $row["status"];
                    $newStatus = 0;

                    switch ($status) {
                        case 0:
                            $newStatus = "Chờ nhận đơn";
                            break;
                        case 1:
                            $newStatus = "Đang chế biến";
                            break;
                        case 2:
                            $newStatus = "Chế biến xong";
                            break;
                        case 3:
                            $newStatus = "Hoàn thành";
                            break;
                        case 4:
                            $newStatus = "Đã hủy";
                            break;
                    }

                    echo "
                <tr data-id='" . $orderID . "' data-cus='" . $cusName . "' data-name='" . $orderName . "' data-quan='" . $orderQuantity . "' data-date='" . $orderDate . "' data-amount='" . $amount . "' data-status='" . $status . "' class='cursor-pointer'>
                    <td class='border-2 py-2'>#DH0" . ($row["orderID"] < 10 ? "0" . $row["orderID"] : $row["orderID"]) . "</td>
                    <td class='border-2 py-2'>" . $row["orderDate"] . "</td>
                    <td class='border-2 py-2'>" . str_replace(".00", "", $amount) . "</td>
                    <td class='border-2 py-2'>
                        <span class='bg-" . ($status == 4 ? "red" : "green") . "-100 text-" . ($status == 4 ? "red" : "green") . "-500 py-1 px-2 rounded-lg w-fit'>" . $newStatus . "</span>
                    </td>
                </tr>
            ";
                }
                echo "</tbody>
            </table>";
            } else {
                echo "<p class='text-center py-2 font-semibold'>Chưa có dữ liệu!</p>";
            }
            ?>
        </div>
    </div>
</div>

<div class="modal modalOrder fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h2 class="modal-title fs-5 font-bold text-3xl" id="orderModalLabel" style="color: #E67E22;"></h2>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll("tr.cursor-pointer");

        rows.forEach(function(row) {
            row.addEventListener("click", function() {
                const orderID = this.getAttribute("data-id");
                const cusName = this.getAttribute("data-cus");
                const orderName = this.getAttribute("data-name");
                const orderQuantity = this.getAttribute("data-quan");
                const orderDate = this.getAttribute("data-date");
                const amount = this.getAttribute("data-amount");
                const status = this.getAttribute("data-status");
                let modalBody = document.querySelector("#orderModal .modal-body");
                let modalFooter = document.querySelector("#orderModal .modal-footer");
                const arrStatus = ["Chờ nhận đơn", "Đang chế biến", "Chế biến xong", "Hoàn thành", "Đã hủy"];
                let newStatus = arrStatus[status];

                document.getElementById("orderModalLabel").textContent = "Chi tiết đơn hàng #DH0" + (orderID < 10 ? "0" + orderID : orderID);
                modalBody.innerHTML = `<form action="" class="form-container w-full">
                        <table class='w-full'>
                            <tr>
                                <td class='flex'>
                                    <label class='font-bold mr-2'>Họ tên:</label>
                                    <p>${cusName}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class='flex'>
                                    <label class='font-bold mr-2'>Ngày &amp; giờ đặt:</label>
                                    <p>${orderDate}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class='flex'>
                                    <label class='font-bold mr-2'>Món:</label>
                                    <p>${orderName} - Số lượng: ${orderQuantity}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class='flex'>
                                    <label class='font-bold mr-2'>Tổng giá trị đơn:</label>
                                    <p>${amount}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class='flex'>
                                    <label class='font-bold mr-2'>Trạng thái:</label>
                                    <p>${newStatus}</p>
                                </td>
                            </tr>
                        </table>
                    </form>`;

                modalFooter.innerHTML = `
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger" name="btnchuyen" value="${orderID}/${status}">Chuyển</button>`;

                const orderModal = new bootstrap.Modal(document.getElementById("orderModal"));
                orderModal.show();
            });
        });
    });
</script>