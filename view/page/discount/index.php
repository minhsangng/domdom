<title>Khuyến mãi | DOMDOM - Chuỗi cửa hàng thức ăn nhanh</title>

<style>
    .wheel {
        background: conic-gradient(#FF5733 0% 10%,
                #FFC300 10% 20%,
                #DAF7A6 20% 30%,
                #FF6F61 30% 40%,
                #4CAF50 40% 50%,
                #2196F3 50% 60%,
                #9C27B0 60% 70%,
                #FF9800 70% 80%,
                #E91E63 80% 90%,
                #F44336 90% 100%);
        transition: transform 4s cubic-bezier(0.33, 1, 0.68, 1);
    }

    .swal2-popup {
        width: 50% !important;
    }

    .swal2-html-container {
        color: red !important;
    }
</style>

<div class="flex flex-col justify-center items-center absolute top-44 left-16">
    <h1 class="font-bold text-3xl mb-4">🎉 Chương Trình Khuyến Mãi 🎉</h1>
    <p class="italic text-lg">Quay để nhận ngay ưu đãi hấp dẫn!</p>
    <div id="wheel" class="wheel size-72 rounded-full mx-auto my-4 border-red-600 border-8 shadow shadow-red-500"></div>
    <img src="images/logo.png" alt="Logo" class="absolute size-10 rounded-full" style="top: 14.8rem; right: 14.3rem;">
    <button id="spinButton" class="btn btn-danger px-4 py-2 rounded-xl">Quay Ngay!</button>
</div>

<div class="w-full py-20" style="background: linear-gradient(135deg, #ffcc00, var(--secondary-color));">
    <h2 class="text-center text-3xl font-bold w-1/3 my-0 mx-auto pb-4 rounded-md border-b-4 border-gray-300 border-dotted">ƯU ĐÃI ĐANG DIỄN RA</h2>
    <div class="flex-col justify-center items-center pt-20">
        <?php
        $ctrl = new cPromotions;

        if ($ctrl->cGetAllPromotion() != 0) {
            $result = $ctrl->cGetAllPromotion();
            
            $img_pomotion = "";

        while ($row = $result->fetch_assoc()) {
          $img_pomotion = "images/promotion/" . $row["image"];
          if (!file_exists($img_pomotion))
            $img_promotion = "images/nodish.png";

          echo "<div class='flex justify-between items-center relative z-1 mb-16 bg-white w-2/3 mx-auto rounded-2xl px-8 py-4 shadow transition-transform hover:-translate-y-3'>
                    <img src='" . $img_promotion . "' class='size-40 rounded-2xl border'/>
                    <div class='text-center'>
                        <h2 class='text-[#ff6347] mb-4 text-2xl font-bold'>" . $row["promotionName"] . "</h2>
                        <p class='text-xl my-2'>" . $row["description"] . "</p>
                        <p class='text-lg my-2'><strong>Thời gian áp dụng:</strong> Từ " . $row["startDate"] . " đến " . $row["endDate"] . "</p>
                        <p class='text-lg my-2'><strong>Địa điểm:</strong> Tại cửa hàng và đơn hàng trực tuyến.</p>
                        <a href='#' class='btn bg-[#ff6347] text-white rounded-xl text-xl mt-3 transition-all hover:bg-[#e5533d] hover:scale-105'>Đặt món ngay!</a>
                    </div>
                </div>";
        }
        } else echo "Không có dữ liệu!";
        ?>
    </div>
</div>

<script>
    const promotions = [
        "Giảm 10% cho đơn hàng đầu tiên!",
        "Mua 1 tặng 1 cho món ăn bất kỳ!",
        "Giảm 20% cho combo!",
        "Tặng nước ngọt khi mua burger!",
        "Giảm 15% cho đơn hàng trên 200k!",
        "Tặng 1 phần khoai tây chiên!",
        "Giảm 30% khi mua combo mì ý + coca!",
        "Giảm 25% cho đơn hàng online!",
        "Tặng voucher 50k cho lần mua tiếp theo!",
        "Giảm 5% cho khách hàng thân thiết!"
    ];

    const spinButton = document.getElementById("spinButton");
    const wheel = document.getElementById("wheel");

    spinButton.addEventListener("click", () => {
        const randomDegree = Math.floor(Math.random() * 360 + 720);
        wheel.style.transition = "transform 4s ease-out";
        wheel.style.transform = `rotate(${randomDegree}deg)`;

        setTimeout(() => {
            wheel.style.transition = "none";
            wheel.style.transform = `rotate(${randomDegree % 360}deg)`;

            const degreePerPromotion = 360 / promotions.length;
            const currentDegree = randomDegree % 360;
            const promotionIndex = Math.floor((currentDegree + (degreePerPromotion / 2)) / degreePerPromotion) % promotions.length;

            Swal.fire({
                title: "Chúc mừng bạn đã nhận được Voucher:",
                text: promotions[promotionIndex],
                icon: "success",
                confirmButtonText: "Đồng ý"
            });
        }, 4000);
    });
</script>