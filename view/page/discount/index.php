<title>Khuyến mại | DOMDOM - Chuỗi cửa hàng thức ăn nhanh</title>

<div class="w-full">
    <div class="flex justify-center items-center pt-20 pb-60 px-20 bg-white">
        <?php
        $ctrl = new cPromotions;
        $ctrl->showPromotionsList("SELECT * FROM promotion");
        ?>
    </div>
</div>