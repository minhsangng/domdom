<?php
include("./model/mDishes.php");

class cDishes extends mDishes
{
    public function showDishesHome($sql)
    {
        if ($this->showDishes($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
            
            $img_dish = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/".$row["image"];
                if (!file_exists($img_dish))
                    $img_dish = "images/nodish.png";
                echo "<div class='bg-white p-4 shadow rounded'>
                    <img alt='".$row["dishName"]."' class='w-full h-44 rounded' src='".$img_dish."'/>
                    <h3 class='text-lg font-bold mt-2'>".$row["dishName"]."</h3>
                    <p class='text-yellow-500 font-bold my-2'>".$row["price"]."</p>
                    <button class='btn btn-outline-danger w-full'><i class='fa-solid fa-cart-plus mr-2'></i>Thêm</button>
                </div>";
            }
        } else echo "Không có dữ liệu.";
    }
    
    public function showDishesByCategory($sql)
    {
        if ($this->showDishes($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
            
            $img_dish = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/".$row["image"];
                if (!file_exists($img_dish))
                    $img_dish = "images/nodish.png";
                    
                $price = str_replace(".00", "", number_format($row["price"], "2", ".", ","));
                echo "<div class='bg-white p-4 shadow rounded'>
                    <img alt='".$row["dishName"]."' class='w-full h-44 rounded' src='".$img_dish."'/>
                    <h3 class='text-lg font-bold mt-2'>".$row["dishName"]."</h3>
                    <p class='font-bold my-2' style='color: var(--fourth-color);'>".$price." đ</p>
                    <button class='btn btn-outline-danger w-full'><i class='fa-solid fa-cart-plus mr-2'></i>Thêm</button>
                </div>";
            }
        } else echo "Không có dữ liệu.";
    }
}
