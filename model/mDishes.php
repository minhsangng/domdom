<?php

class mDishes
{
    public function mGetAllCategory()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish GROUP BY dishCategory ORDER BY dishCategory DESC";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetCategoryNotId($category)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish WHERE dishCategory != '$category' GROUP BY dishCategory";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    public function mGetAllDish()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetDishTop()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT *, SUM(OD.quantity) AS MaxQuantity FROM `order` AS O JOIN `order_dish` AS OD ON O.orderID = OD.orderID JOIN `dish` AS D ON D.dishID = OD.dishID GROUP BY OD.dishID ORDER BY MaxQuantity DESC LIMIT 4";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetDishById($dishID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish WHERE dishID = $dishID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetDishByName($name)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish WHERE dishName LIKE '%".$name."%'";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetDishByCategory($category)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish WHERE dishCategory = '$category'";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mInsertDish($dishName, $dishCategory, $price, $prepare, $image) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO dish (dishName, dishCategory, price, preparationProcess, image) VALUES ('$dishName', '$dishCategory', $price, '$prepare', '$image')";
        
        return $conn->query($sql);
    }
    
    public function mUpdateDish($dishName, $dishCategory, $price, $prepare, $image, $dishID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE dish SET dishName = '$dishName', dishCategory = '$dishCategory', price = $price, preparationProcess = '$prepare', image = '$image' WHERE dishID = $dishID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mUpdateDishAvailabilityStatus($availability, $dishID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE dish SET availabilityStatus = $availability WHERE dishID = $dishID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mLockDish($status, $dishID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE dish SET businessStatus = $status WHERE dishID = $dishID";
        
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
}