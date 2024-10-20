<?php

class mIngredients
{
    public function mGetAllIngredient()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient";
        
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetIngredientById($ingreID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient WHERE ingredientID = $ingreID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetIngredientNotType($type)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient WHERE typeIngredient != '$type' GROUP BY typeIngredient";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mInsertIngredient($ingreName, $unit, $price, $type)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO ingredient (ingredientName, unitOfcalculaton, price, typeIngredient) VALUES ('$ingreName', '$unit', $price, '$type')";
        
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mUpdateIngredient($ingreName, $unit, $price, $type, $ingreID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `ingredient` SET ingredientName = '$ingreName', unitOfcalculaton = '$unit', price = $price, typeIngredient = '$type' WHERE ingredientID = $ingreID";
        
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
}
