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

    public function mGetAllOrderByID($orderID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `order` WHERE orderID = '$orderID'";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }

    public function mGetOrderPackage($orderID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT *
                FROM `order` o
                JOIN `partypackage` p ON o.partyPackageID = p.partyPackageID
                WHERE o.orderID = '$orderID' and o.status != '4'";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetOrderDishes($orderID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT *
                FROM `order` o
                JOIN `order_dish` od ON od.orderID = o.orderID
                JOIN `dish` d ON od.dishID = d.dishID
                WHERE o.orderID = '$orderID' and o.status != '4'";
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
        $sql = "UPDATE `order` SET status = '$status' WHERE orderID = '$orderID'";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mUpdateOrderDish($orderID, $quantityUpdate, $notes, $total, $dishID) {
        $db = new Database;
        $conn = $db->connect();
        $dem = 0;
        $total*=1000;
        foreach($quantityUpdate as $index => $quantity) {
            $sql = "UPDATE `order` o
            JOIN `order_dish` od ON o.orderID = od.orderID
            SET o.total = '$total', 
                od.quantity = '$quantity', 
                o.note = '$notes', 
                o.finalAmount = '$total'
            WHERE o.orderID = '$orderID' AND od.dishID = '$dishID[$index]'";
    
            if($conn->query($sql))
            $dem++;
        }
        if ($dem >0)
            return true;
        else {
            return false;
        }
    }

    public function mUpdateOrderPartyPackage($orderID, $notes) {
        $db = new Database;
        $conn = $db->connect();

        $sql = "UPDATE `order`
        SET note = '$notes'
        WHERE orderID = '$orderID'";

        if($conn->query($sql)) {
            return true;
        }else {
            return false;
        }

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

    public function mDeleteOrderDish($orderID, $dishID) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "DELETE FROM order_dish WHERE orderID = $orderID AND dishID = $dishID";
        
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
}