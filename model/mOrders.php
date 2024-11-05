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
    
    public function mGetAllOrderRangeOf($start, $end)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `order` WHERE orderDate>= '$start' AND orderDate <= '$end' ORDER BY orderDate DESC";
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