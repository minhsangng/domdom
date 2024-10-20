<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") !== false)
    $path = "../../../model/mDishes.php";
else $path = "./model/mDishes.php";

if (!class_exists("mDishes"))
    require_once($path);

class cDishes extends mDishes
{
    public function showDishesHome($category)
    {
        if ($this->mGetDishByCategory($category) != 0) {
            $result = $this->mGetDishByCategory($category);
            
            $img_dish = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/".$row["image"];
                if (!file_exists($img_dish))
                    $img_dish = "images/nodish.png";
                echo "<div class='bg-white p-4 shadow rounded'>
                    <img alt='".$row["dishName"]."' class='w-full h-36 rounded' src='".$img_dish."'/>
                    <h3 class='text-lg font-bold mt-2'>".$row["dishName"]."</h3>
                    <p class='text-yellow-500 font-bold my-2'>".str_replace(".00", "", number_format($row["price"], "2", ".", ","))." đ</p>
                    <button class='btn btn-outline-danger w-full'><i class='fa-solid fa-cart-plus mr-2'></i>Thêm</button>
                </div>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }
    
    public function showDishMenu()
    {
        if ($this->mGetAllDish() != 0) {
            $result = $this->mGetAllDish();
            
            $img_dish = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_dish = "images/dish/".$row["image"];
                if (!file_exists($img_dish))
                    $img_dish = "images/nodish.png";
                    
                $price = str_replace(".00", "", number_format($row["price"], "2", ".", ","));
                echo "<div class='bg-white p-4 shadow rounded'>
                    <img alt='".$row["dishName"]."' class='w-full h-36 rounded' src='".$img_dish."'/>
                    <h3 class='text-lg font-bold mt-2'>".$row["dishName"]."</h3>
                    <p class='font-bold my-2' style='color: var(--fourth-color);'>".$price." đ</p>
                    <button class='btn btn-outline-danger w-full'><i class='fa-solid fa-cart-plus mr-2'></i>Thêm</button>
                </div>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }
    
    public function cGetAllDish() {
        if ($this->mGetAllDish() != 0) {
            $result = $this->mGetAllDish();
            
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td class='py-2 border-2'>#010" . $row["dishID"] . "</td>
                        <td class='py-2 border-2'>" . $row["dishName"] . "</td>
                        <td class='py-2 border-2'>" . $row["dishCategory"] . "</td>
                        <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                        <td class='py-2 border-2'><span class='bg-" . ($row["businessStatus"] == 1 ? "green" : "red") . "-100 text-" . ($row["businessStatus"] == 1 ? "green" : "red") . "-500 py-1 px-2 rounded-lg'>" . ($row["businessStatus"] == 1 ? "Đang kinh doanh" : "Ngưng kinh doanh") . "</span></td>
                        <td class='py-2 border-2 flex justify-center'>
                            <button type='submit' class='btn btn-secondary mr-1' name='btncapnhat' value='" . $row["dishID"] . "'>Cập nhật</button>
                            <button type='submit' class='btn btn-danger ml-1' name='btnkhoa' value='".$row["dishID"]."'>" . ($row["businessStatus"] == 1 ? "Khóa" : "Mở khóa")."</button>
                        </td>
                    </tr>";
            }
        }
    }
    
    public function cGetDishById($dishID) {
        if ($this->mGetDishById($dishID) != 0) {
            $result = $this->mGetDishById($dishID);
            
            return $result->fetch_assoc();
        }
    }
    
    public function cInsertDish($dishName, $dishCategory, $price, $prepare, $image) {
        if ($this->mInsertDish($dishName, $dishCategory, $price, $prepare, $image) != 0) {
            echo "<script>alert('Thêm món ăn thành công!')</script>";
        } else echo "<script>alert('Thêm món ăn thất bại!')</script>";
    }
    
    public function cUpdateDish($dishName, $dishCategory, $price, $prepare, $image, $dishID) {
        if ($this->mUpdateDish($dishName, $dishCategory, $price, $prepare, $image, $dishID) != 0) {
            echo "<script>alert('Cập nhật món ăn thành công!')</script>";
        }
    }
    
    public function cLockDish($status, $dishID) {
        if ($this->mLockDish($status, $dishID) != 0) {
            echo "<script>alert('".($status == 1 ? "Mở khóa" : "Khóa")." món ăn thành công!')</script>";
        }
    }
}
