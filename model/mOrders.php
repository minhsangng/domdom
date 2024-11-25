<?php

class mOrders
{
    public function mGetAllOrder()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `order` ORDER BY orderDate DESC";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetRevenueOrderByStore($storeID, $start, $end)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT *, GROUP_CONCAT(CONCAT(D.dishName, ' (x', OD.quantity, ')') SEPARATOR ', ') AS dishes FROM `order` AS O JOIN `order_dish` AS OD ON OD.orderID = O.orderID JOIN `dish` AS D ON D.dishID = OD.dishID WHERE O.orderDate >= '$start' AND O.orderDate <= '$end' AND O.storeID = $storeID GROUP BY O.orderID";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetAllOrderRangeOf($start, $end)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `order` WHERE orderDate>= '$start' AND orderDate <= '$end' ORDER BY orderDate DESC";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mUpdateOrder($orderID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order` SET sumOfQuantity = (SELECT SUM(quantity) FROM `order_dish` GROUP BY orderID HAVING orderID = $orderID), total = (SELECT SUM(lineTotal) FROM `order_dish` GROUP BY orderID HAVING orderID = $orderID) WHERE orderID = $orderID";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mUpdateOrderDish($orderID, $dishID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order_dish` SET unitPrice = (SELECT price FROM `dish` WHERE dishID = $dishID), lineTotal = (SELECT price FROM dish WHERE dishID = $dishID) * quantity * discountAmount =  WHERE orderID = $orderID";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mUpdateStatusOrder($orderID, $status) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order` SET status = $status WHERE orderID = $orderID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mInsertOrder($customerID, $paymentMethod) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `order` (customerID, paymentMethod) VALUES ($customerID, '$paymentMethod')";
        
        return $conn->query($sql);
    }
    
    public function mInsertOrderDish($orderID, $dishID, $quantity) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `order_dish` (orderID, dishID, quantity) VALUES ($orderID, $dishID, $quantity)";
        
        return $conn->query($sql);
    }
    
    public function mGetAllOrderFully()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `order` AS O JOIN `customer` AS C ON O.customerID = C.customerID JOIN `order_dish` AS OD ON OD.orderID = O.orderID JOIN `dish` AS D ON D.dishID = OD.dishID GROUP BY O.orderID";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
}