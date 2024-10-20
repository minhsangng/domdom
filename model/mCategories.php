<?php

class mCategories
{
    public function mGetAllCategory()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM dish GROUP BY dishCategory";
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
}
