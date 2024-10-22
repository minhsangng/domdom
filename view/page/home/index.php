<title>Trang chủ | FireFlies - Chuỗi cửa hàng thức ăn nhanh</title>

<style>
  .container form {
    min-height: 100% !important;
  }
</style>

<main class="container">
  <section class="products overflow-hidden">
    <div class="container mx-auto text-center pt-16 my-4">
      <h1 class="text-4xl font-bold mb-6">DANH MỤC SẢN PHẨM</h1>
      <hr class="border-t-2" style="width: 40%; margin: 0 auto 40px; border-color: var(--fourth-color);">
      <div class="grid grid-cols-6 gap-x-5 gap-y-2">
        <?php
        $ctrl = new cCategories();
        $ctrl->showCategoriesHome();
        ?>
      </div>
    </div>
  </section>
  <section class="my-16">
    <h2 class="text-center text-4xl font-bold mb-6">KHUYẾN MÃI ĐANG DIỄN RA</h2>
    <hr class="border-t-2" style="width: 40%; margin: 0 auto 40px; border-color: var(--fourth-color);">
    <div class="grid grid-cols-3 gap-5-10 gap-x-24 my-28 w-full">
        <?php
        $ctrl = new cPromotions();
        $ctrl->showPromotionsHome();
        ?>
    </div>
  </section>
</main>