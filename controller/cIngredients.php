<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mIngredients.php";
else $path = "./model/mIngredients.php";

if (!class_exists("mIngredients"))
    require_once($path);

class cIngredients extends mIngredients
{
    public function cGetAllIngredient()
    {
        if ($this->mGetAllIngredient() != 0) {
            $result = $this->mGetAllIngredient();
            
            return $result;
        } return 0;
    }

    public function cGetAllIngredientLimit($startFrom, $productsPerPage)
    {
        if ($this->mGetAllIngredient() != 0) {
            $result = $this->mGetAllIngredientLimit($startFrom, $productsPerPage);
            
            return $result;
        } return 0;
    }

    public function cGetAllStoreIngredient($ingredientID)
    {
        if ($this->mGetAllStoreIngredient($ingredientID) != 0) {
            $result = $this->mGetAllStoreIngredient($ingredientID);
            
            return $result;
        } return 0;
    }

    public function cGetTypeIngredient()
    {
        if ($this->mGetTypeIngre() != 0) {
            $result = $this->mGetTypeIngre();
            
            return $result;
        } return 0;
    }
    
    public function cGetUnitIngredient()
    {
        if ($this->mGetUnitIngredient() != 0) {
            $result = $this->mGetUnitIngredient();
            
            return $result;
        } return 0;
    }

    public function cGetQuantityFreshIngredient($quantities)
    {
        if ($this->mGetQuantityFreshIngredient($quantities) != 0) {
            $result = $this->mGetQuantityFreshIngredient($quantities);
            
            return $result;
        } return 0;
    }

    public function cGetQuantityDryIngredient($quantities, $userID)
    {
        if ($this->mGetQuantityDryIngredient($quantities, $userID) != 0) {
            $result = $this->mGetQuantityDryIngredient($quantities, $userID);
            
            return $result;
        } return 0;
    }

    public function cGetUnit()
    {
        if ($this->mGetUnit() != 0) {
            $result = $this->mGetUnit();
            
            return $result;
        } return 0;
    }
    
    public function cGetIngredientNotType($type) {
        if ($this->mGetIngredientNotType($type) != 0) {
            $result = $this->mGetIngredientNotType($type);
            
            return $result;
        } return 0;
    }
    
    public function cGetIngredientById($ingreID) {
        if ($this->mGetIngredientById($ingreID) != 0) {
            $result = $this->mGetIngredientById($ingreID);
            
            return $result->fetch_assoc();
        } return 0;
    }
    
    public function cGetIngredientNotUnit($unit) {
        if ($this->mGetIngredientNotUnit($unit) != 0) {
            $result = $this->mGetIngredientNotUnit($unit);
            
            return $result;
        } return 0;
    }

    public function cGetUnitByIngredient($ingredient) {
        if ($this->mGetUnitByIngredient($ingredient) != 0) {
            $result = $this->mGetUnitByIngredient($ingredient);
            
            return $result;
        } return 0;
    }

    public function cGetTotalIngredient() {
        if ($this->mGetTotalIngredient() != 0) {
            $result = $this->mGetTotalIngredient();
           
            return $result;
        } return 0;
    }
    
    public function cInsertIngredient($ingreName, $unit, $price, $type)
    {
        if ($this->mInsertIngredient($ingreName, $unit, $price, $type) != 0) {
            echo "<script>alert('Thêm nguyên liệu thành công');</script>";
        } else echo "<script>alert('Thêm nguyên liệu thất bại. Vui lòng nhập lại!');</script>";
    }
    
    public function cUpdateIngredient($ingreName, $unit, $price, $type, $ingreID) {
        if ($this->mUpdateIngredient($ingreName, $unit, $price, $type, $ingreID) != 0) {
            echo "<script>alert('Cập nhật nguyên liệu thành công!')</script>";
        }
    }

    public function cLockIngredient($status, $ingredientID)
    {
        if ($this->mLockIngredient($status, $ingredientID) != 0) {
            echo "<script>alert('" . ($status == 1 ? "Mở khóa" : "Khóa") . " nguyên liệu thành công!')</script>";
        }
    }
    
    public function cGetRevenueIngredientByStore($storeID, $startDate, $endDate) {
        if ($this->mGetRevenueIngredientByStore($storeID, $startDate, $endDate) != 0) {
            $result = $this->mGetRevenueIngredientByStore($storeID, $startDate, $endDate);
           
            return $result;
        } return 0;
    }
}