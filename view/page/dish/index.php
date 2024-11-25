<?php
    session_start();
?>
<title>Danh sách sản phẩm | DOMDOM - Chuỗi cửa hàng thức ăn nhanh</title>

<section class="py-8 absolute top-16 left-16 w-1/2 h-screen">
    <div class="container mx-auto">
        <!-- <h2 class="text-2xl font-bold mb-4 breadcrumb-item">Danh mục</h2> -->
        <div class="grid grid-cols-2 gap-14">
            <?php
            $ctrl = new cDishes;
            if ($ctrl->cGetAllCategory() != 0) {
                $result = $ctrl->cGetAllCategory();

                $img_dish = "";

                while ($row = $result->fetch_assoc()) {
                    $img_dish = "images/dish/" . $row["image"];
                    if (!file_exists($img_dish)) {
                        $img_dish = "images/nodish.png";
                    }

                    echo "<div class='relative h-36'>
                    <a href='?p=dish&c=" . $row["dishCategory"] . "#ci'>
                <div class='absolute top-0 left-0 flex items-center w-64 h-40 mt-6 ml-6 bg-white border-8 border-gray-700 border-solid rounded-lg'>
                    <div class='w-1/3 h-40'></div>
                    <div class='w-2/3 h-32 pr-4 md:pt-3'>
                        <img alt='" . $row["dishCategory"] . "' class='w-full h-20 rounded border-2 border-red-100' src='" . $img_dish . "'/>
                    </div>
                </div>
                <div class='absolute top-0 left-0 z-20 w-12 h-12 mt-6 ml-6 bg-white rounded-full'>
                    <svg class='mt-2 ml-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='#e53e3e'
                        width='32px' height='32px'>
                        <path d='M0 0h24v24H0z' fill='none' />
                        <path
                            d='M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z' />
                    </svg>
                </div>
                <div class='absolute top-0 left-0 z-10 w-24 h-40 py-20 px-auto text-center text-lg text-wrap font-bold text-center text-white bg-amber-500 rounded-lg'>" . $row["dishCategory"] . "</div>
                <div class='absolute top-0 left-0 z-30 w-24 h-2 mt-40 ml-48 bg-amber-500'></div>
                </a>
            </div>";
                }
            }
            ?>
        </div>
    </div>
</section>
<section class="bg-white py-8">
    <div class="container mx-auto mt-4 bg-gray-100 py-4 px-4 rounded-md">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-2xl font-bold mb-4 border-b-2 border-slate-200 pb-2">
                <li class="breadcrumb-item">Sản phẩm</li>
                <?php
                if (isset($_GET["c"]))
                    echo "<li class='breadcrumb-item active' aria-current='page'>" . $_GET["c"] . "</li>";
                ?>
            </ol>
        </nav>
        <div class="grid grid-cols-6 gap-4">
            <?php
            $ctrl = new cDishes;
            if (isset($_GET["c"])) {
                $category = str_replace("%20", " ", $_GET["c"]);
                if ($ctrl->cGetDishByCategory($category) != 0) {
                    $result = $ctrl->cGetDishByCategory($category);
                }
            } else {
                if ($ctrl->cGetAllDish() != 0) {
                    $result = $ctrl->cGetAllDish();
                }
            }
            $img_dish = "";

            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/" . $row["image"];
                if (!file_exists($img_dish)) {
                    $img_dish = "images/nodish.png";
                }
            
                $price = str_replace(".00", "", number_format($row["price"], "2", ".", ","));
            
                echo "<div class='w-full bg-white shadow rounded-lg hover:scale-105 transition delay-150'>
                        <div class='h-40 w-full bg-gray-200 flex flex-col justify-between p-4 bg-cover bg-center border-2 border-red-100 rounded-t-lg' style='background-image: url(" . $img_dish . ")'>
                        </div>
                        <div class='px-4 pt-2 pb-4 flex flex-col items-center'>
                            <p class='text-gray-400 font-light text-xs text-center'>" . $row["dishCategory"] . "</p>
                            <h1 class='text-orange-600 font-bold text-center h-10 mt-1'>" . $row["dishName"] . "</h1>
                            <p class='text-center text-red-600 mt-1'>" . $price . " đ</p>
            
                            <form action='view/page/dish/cart.php' method='post'>
                                <input type='hidden' name='image' value='" . $row["image"] . "'> <!-- Tên hình -->
                                <input type='hidden' name='dishName' value='" . $row["dishName"] . "'> <!-- Tên sản phẩm -->
                                <input type='hidden' name='price' value='" . $row["price"] . "'> <!-- Giá -->
                                <input type='number' name='quantityofcart' value='" . $row["quantityofcart"] . "'> <!-- soluong -->
                                <button type='submit' name='addcart' class='py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50 mt-4 w-full flex items-center justify-center' >
                                    Thêm vào giỏ hàng
                                    <svg
                                      xmlns='http://www.w3.org/2000/svg'
                                      class='h-6 w-6 ml-2'
                                      fill='none'
                                      viewBox='0 0 24 24'
                                      stroke='currentColor'
                                      >
                                      <path
                                        stroke-linecap='round'
                                        stroke-linejoin='round'
                                        stroke-width='2'
                                        d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'
                                      />
                                    </svg>
                                </button>
                            </form>
                    </div>
                    </a>
                  </div>";
            }
            ?>
        </div>
    </div>
</section>
            
<script>
        function scrollProducts() {
            document.getElementById("ci").scrollIntoView({ behavior: 'smooth' });
        }
</script>