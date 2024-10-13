<?php
include("./model/mCategories.php");

class cCategories extends mCategories
{
    public function showCategoriesHeader($sql)
    {
        if ($this->showCategories($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                echo "<a class='dropdown-item' href='index.php?p=dish&c=".$row["categoryName"]."&#ci'>" . $row["categoryName"] . "</a>";
            }
        } else echo "Không có dữ liệu.";
    }

    public function showCategoriesHome($sql)
    {
        if ($this->showCategories($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
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
                        <a class='flex flex-col items-center' href='index.php?p=dish&c=".$row["categoryName"]."&#ci'>
                            <div class='relative'>
                            <img alt='' class='rounded-full size-52' style='border-width: 12px; border-left: 0; border-color: " . $border . ";' src='".$img_dish."'/>
                            </div>
                            <div class='title-product py-2 px-4 rounded-lg w-fit'>
                            <h2 class='text-2xl text-light-500 font-bold uppercase'>" . $row["categoryName"] . "</h2>
                            </div>
                        </a>
                    </div>";
            }
        } else echo "Không có dữ liệu.";
    }
    
    public function showCategoriesMenu($sql)
    {
        if ($this->showCategories($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
            
            $img_dish = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/".$row["image"];
                if (!file_exists($img_dish)) {
                    $img_dish = "images/nodish.png"; 
                }
                echo "<div class='bg-white p-4 shadow rounded'>
                    <a href='index.php?p=dish&c=".$row["categoryName"]."&#ci'>
                        <img alt='".$row["categoryName"]."' class='w-full h-24 rounded' src='".$img_dish."'/>
                        <h3 class='text-xl text-center font-bold mt-2'>".$row["categoryName"]."</h3>
                    </a>
                </div>";
            }
        } else echo "Không có dữ liệu.";
    }
}
