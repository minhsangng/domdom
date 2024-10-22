<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mCategories.php";
else $path = "./model/mCategories.php";

if (!class_exists("mCategories"))
    require_once($path);

class cCategories extends mCategories
{
    public function showCategoriesHeader($sql)
    {
        if ($this->mGetAllCategory()) {
            $result = $this->mGetAllCategory();
            
            while ($row = $result->fetch_assoc()) {
                echo "<a class='dropdown-item' href='index.php?p=dish&c=".$row["dishCategory"]."&#ci'>" . $row["dishCategory"] . "</a>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }

    public function showCategoriesHome()
    {
        if ($this->mGetAllCategory()) {
            $result = $this->mGetAllCategory();
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
                    <div class='text-center product-category'>
                        <a class='flex flex-col items-center' href='index.php?p=dish&c=".$row["dishCategory"]."&#ci'>
                            <div class='relative'>
                            <img alt='' class='rounded-full size-52' style='border-width: 12px; border-left: 0; border-color: " . $border . ";' src='".$img_dish."'/>
                            </div>
                            <div class='title-product py-2 px-4 rounded-lg w-fit'>
                            <h2 class='text-2xl text-light-500 font-bold uppercase'>" . $row["dishCategory"] . "</h2>
                            </div>
                        </a>
                    </div>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }
    
    public function showCategoriesMenu($sql)
    {
        if ($this->mGetAllCategory()) {
            $result = $this->mGetAllCategory();
            
            $img_dish = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/".$row["image"];
                if (!file_exists($img_dish)) {
                    $img_dish = "images/nodish.png"; 
                }
                echo "<div class='bg-white p-4 shadow rounded'>
                    <a href='index.php?p=dish&c=".$row["dishCategory"]."&#ci'>
                        <img alt='".$row["dishCategory"]."' class='w-full h-24 rounded' src='".$img_dish."'/>
                        <h3 class='text-xl text-center font-bold mt-2'>".$row["dishCategory"]."</h3>
                    </a>
                </div>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }
    
    public function cGetCategoryNotId($category) {
        if ($this->mGetCategoryNotId($category) != 0) {
            $result = $this->mGetCategoryNotId($category);
            
            return $result;
        }
    }
}
