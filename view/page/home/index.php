<title>Trang chủ | FireFlies - Chuỗi cửa hàng thức ăn nhanh</title>

<style>
  .container form {
    min-height: 100% !important;
  }
</style>

<div class="search absolute top-52 left-16">
  <form action="#ci" method="post" class="form-search">
    <section class="content-home">
      <h1 class="text-center my-4 leading-relaxed text-5xl">THÈM MÓN GÌ, <br> <span id="text">NGẠI CHI MÀ KHÔNG NÓI?</span></h1>
      <div class="content w-full flex justify-center text-xl">
        <div class=" flex items-center w-full h-14 rounded-lg shadow-red-200 shadow-md bg-white pr-4 pl-2">
          <div class="grid place-items-center h-full w-12 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>

          <input
            class="peer h-full w-full outline-none text-base text-gray-700 pr-2"
            type="search"
            id="search"
            name="search"
            value="<?php echo $_POST["search"]; ?>"
            placeholder="Nhập món gì đó.." />
        </div>
    </section>
  </form>
</div>

<?php
$input = "";
if (isset($_POST["search"])) {
  $input = $_POST["search"];

  if ($input != "") {
    echo "<section class='w-3/4 mx-auto mt-16 mb-12'>
            <h2 class='border-b border-gray-500 text-2xl font-bold px-2 py-4'>KẾT QUẢ DÀNH CHO: " . $input . "</h2>";
    $ctrl = new cDishes;

    if ($ctrl->cGetDishByName($input) != 0) {
      $result = $ctrl->cGetDishByName($input);
      $n = $result->num_rows;

      if ($n > 0) {

        echo "<div class='grid grid-cols-4 gap-x-14 gap-y-10 my-4'>";
        while ($row = $result->fetch_assoc()) {
          echo "
                <div class='card w-full'>
                  <a href='?i=" . $row["dishID"] . "'>
                    <img src='images/dish/" . $row["image"] . "' class='card-img-top h-44' alt=''>
                    <div class='card-body flex justify-between items-center'>
                      <h5 class='card-title font-bold w-1/2'>" . $row["dishName"] . "</h5>
                      <button class='btn btn-outline-danger w-1/2'>Đặt ngay</button>
                    </div>
                  </a>
              </div>
              ";
        }
        echo "</div>";
      }
    } else echo "Không có dữ liệu!";

    if ($n == 0 && $m == 0) {
      echo "<div class='grid grid-cols-1 w-full my-4'><h5 class='font-bold'>Xin lỗi! Chúng tôi không tìm thấy kết quả bạn cần!</h5></div>";
      $_POST["search"] = "";
    }

    echo "</section>";
  }
} else
  $_POST["search"] = "";
?>

<main class="container">
  <section class="products overflow-hidden">
    <div class="container mx-auto text-center pt-16 my-4">
      <h1 class="text-3xl font-bold mb-6">DANH MỤC SẢN PHẨM</h1>
      <hr class="border-t-2" style="width: 40%; margin: 0 auto 40px; border-color: var(--fourth-color);">
      <div class="grid grid-cols-6 gap-x-5 gap-y-2">
        <?php
        $ctrl = new cDishes;
        if ($ctrl->cGetAllCategory() != 0) {
          $result = $ctrl->cGetAllCategory();
          $count = 0;
          $border = "";
          $img_dish = "";

          while ($row = $result->fetch_assoc()) {
            $count++;
            if ($count % 2 == 0)
              $border = "#FFA726";
            else $border = "#EF5350";
            $img_dish = "images/dish/" . $row["image"];
            if (!file_exists($img_dish))
              $img_dish = "images/nodish.png";
            echo "
                    <div class='text-center product-category group'>
                        <a class='flex flex-col items-center' href='index.php?p=dish&c=" . $row["dishCategory"] . "&#ci'>
                            <div class='relative'>
                            <img alt='' class='rounded-full size-52' style='border-width: 12px; border-left: 0; border-color: " . $border . ";' src='" . $img_dish . "'/>
                            </div>
                            <div class='title-product py-2 px-4 rounded-lg w-96 group-hover:translate-y-0 delay-150 ease-linear'>
                            <h2 class='text-2xl text-center text-amber-600 font-bold uppercase'>" . $row["dishCategory"] . "</h2>
                            </div>
                        </a>
                    </div>";
          }
        } else "Không có dữ liệu!";


        ?>
      </div>
    </div>
  </section>
  <section class="my-16">
    <h2 class="text-center text-3xl font-bold mb-6">KHUYẾN MÃI ĐANG DIỄN RA</h2>
    <hr class="border-t-2" style="width: 40%; margin: 0 auto 40px; border-color: var(--fourth-color);">
    <div class="grid grid-cols-3 gap-5-10 gap-x-24 my-28 w-full">
      <?php
      $ctrl = new cPromotions;
      if ($ctrl->cGetAllPromotion() != 0) {
        $result = $ctrl->cGetAllPromotion();

        $count = 0;
        $bg = "";
        $color = "";
        $img_pomotion = "";

        while ($row = $result->fetch_assoc()) {
          $count++;
          $img_pomotion = "images/promotion/" . $row["image"];
          if (!file_exists($img_pomotion))
            $img_pomotion = "images/nodish.png";

          if ($count % 2 == 0) {
            $bg = "#EF5350";
            $color = "rgb(255, 255, 255)";
          } else {
            $bg = "rgba(255, 255, 255, 0.8)";
            $color = "#EF5350";
          }

          echo "
                    <div class='rounded-3xl pb-6 flex flex-col items-center h-fit relative hover:scale-110 delay-150 ease-linear transition-all' style='background-color: " . $bg . "; color: " . $color . ";'>
                        <img alt='" . $row["promotionName"] . "' class='rounded-full size-48 absolute bottom-32 border-dark-300 border-2' src='" . $img_pomotion . "'/>
                        <h2 class='text-lg font-semibold mt-32 mb-2'>" . $row["promotionName"] . "</h2>
                        <p class='text-md text-center px-2'>" . $row["description"] . "</p>
                    </div>";
        }
      } else echo "Không có dữ liệu!";
      ?>
    </div>
  </section>
</main>
