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

    public function mGetAllIngredientLiMit($startFrom, $productsPerPage)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient LIMIT $startFrom, $productsPerPage";

        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetAllStoreIngredient($ingredientID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient i JOIN store_ingredient si ON i.ingredientID = si.ingredientID JOIN store s ON s.storeID = si.storeID WHERE i.ingredientID = $ingredientID";

        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetIngredientById($ingreID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient WHERE ingredientID = '$ingreID'";
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

    public function mGetIngredientNotUnit($unit)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM ingredient WHERE unitOfcalculaton != '$unit' GROUP BY unitOfcalculaton";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetTypeIngre()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT ingredientID, typeIngredient FROM ingredient  GROUP BY typeIngredient";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetUnit()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT ingredientID, unitOfcalculaton FROM ingredient  GROUP BY unitOfcalculaton";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetUnitByIngredient($ingredient)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT unitOfcaculaton FROM ingredient WHERE ingredientName = $ingredient";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetQuantityFreshIngredient($quantities){
        $db = new Database;
        $conn = $db->connect();
        $count=0;
        $sql_parts = [];
        foreach ($quantities as $dishID => $quantity) {
            $dishID+=1;
            $sql_parts[] = "WHEN di.dishID = $dishID THEN $quantity";
            $count++;
        }
        $sql_case = implode(' ', $sql_parts);
        $sql = "SELECT di.ingredientID, i.ingredientName, i.unitOfcalculaton, SUM(di.quantity * CASE $sql_case ELSE 0 END) AS TotalQuantity FROM ingredient i inner join dish_ingredient di on i.ingredientID = di.ingredientID WHERE i.typeIngredient = 'Tươi' GROUP BY i.ingredientID HAVING TotalQuantity != 0";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetQuantityDryIngredient($quantities, $userID){
        $db = new Database;
        $conn = $db->connect();
        $count=0;
        $sql_parts = [];
        foreach ($quantities as $dishID => $quantity) {
            $dishID+=1;
            $sql_parts[] = "WHEN di.dishID = $dishID THEN $quantity";
            $count++;
        }
        $sql_case = implode(' ', $sql_parts);
        $sql = "SELECT *, SUM(di.quantity * CASE $sql_case ELSE 0 END) AS TotalQuantity FROM ingredient i inner join dish_ingredient di on i.ingredientID = di.ingredientID inner join store_ingredient si on i.ingredientID = si.ingredientID inner join user u on u.storeID = si.storeID WHERE i.typeIngredient = 'Khô' AND u.userID = $userID GROUP BY i.ingredientID HAVING TotalQuantity != 0";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetTotalIngredient()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT COUNT(*) as total FROM ingredient";
        if ($conn != null) {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $totalProducts = $row['total'];
            return $totalProducts;
        } else {
            return 0;
        }
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

    public function mUpdateIngredient($ingreName, $unit, $price, $type, $ingreID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `ingredient` SET ingredientName = '$ingreName', unitOfcalculaton = '$unit', price = $price, typeIngredient = '$type' WHERE ingredientID = $ingreID";

        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mLockIngredient($status, $ingredientID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE ingredient SET status = $status WHERE ingredientID = '$ingredientID'";

        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
}
