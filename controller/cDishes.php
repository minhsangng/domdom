<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mDishes.php";
else $path = "./model/mDishes.php";

if (!class_exists("mDishes"))
    require_once($path);

class cDishes extends mDishes
{
    public function cGetAllCategory()
    {
        if ($this->mGetAllCategory() != 0) {
            $result = $this->mGetAllCategory();

            return $result;
        }
        return 0;
    }

    public function cGetCategoryNotId($category)
    {
        if ($this->mGetCategoryNotId($category) != 0) {
            $result = $this->mGetCategoryNotId($category);

            return $result;
        }
    }

    public function cGetAllDish()
    {
        if ($this->mGetAllDish() != 0) {
            $result = $this->mGetAllDish();
            
            return $result;
        } return 0;
    }

    public function cGetDishById($dishID)
    {
        if ($this->mGetDishById($dishID) != 0) {
            $result = $this->mGetDishById($dishID);

            return $result;
        } return 0;
    }
    
    public function cGetDishByName($name)
    {
        if ($this->mGetDishByName($name) != 0) {
            $result = $this->mGetDishByName($name);

            return $result;
        } return 0;
    }
    
    public function cGetDishByCategory($category) {
        if ($this->mGetDishByCategory($category) != 0) {
            $result = $this->mGetDishByCategory($category);
            return $result;
        } return 0;
    }

    public function cInsertDish($dishName, $dishCategory, $price, $prepare, $image)
    {
        if ($this->mInsertDish($dishName, $dishCategory, $price, $prepare, $image) != 0) {
            echo "<script>alert('Thêm món ăn thành công!')</script>";
        } else echo "<script>alert('Thêm món ăn thất bại!')</script>";
    }

    public function cUpdateDish($dishName, $dishCategory, $price, $prepare, $image, $dishID)
    {
        if ($this->mUpdateDish($dishName, $dishCategory, $price, $prepare, $image, $dishID) != 0) {
            echo "<script>alert('Cập nhật món ăn thành công!')</script>";
        }
    }

    public function cLockDish($status, $dishID)
    {
        if ($this->mLockDish($status, $dishID) != 0) {
            echo "<script>alert('" . ($status == 1 ? "Mở khóa" : "Khóa") . " món ăn thành công!')</script>";
        }
    }
}
