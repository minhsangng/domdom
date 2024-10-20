<title>Danh sách sản phẩm | DOMDOM - Chuỗi cửa hàng thức ăn nhanh</title>

<section class="bg-gray-100 py-8">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4 breadcrumb-item">Danh mục</h2>
        <div class="grid grid-cols-6 gap-4">
            <?php
            $ctrl = new cCategories;
            $ctrl->showCategoriesMenu("SELECT * FROM dish GROUP BY dishCategory");
            ?>
        </div>
    </div>
</section>
<section class="bg-white py-8">
    <div class="container mx-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-xl font-bold mb-4">
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
                $ctrl->showDishesHome($category);
            } else $ctrl->showDishMenu();
            
            ?>
        </div>
    </div>
</section>