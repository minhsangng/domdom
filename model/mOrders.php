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
        $sql = "SELECT O.orderDate, COUNT(O.orderID) AS totalOrder, SUM(O.sumOfQuantity) AS totalQuantity, SUM(O.finalAmount) AS totalAmount FROM `order` AS O WHERE O.orderDate >= '$start' AND O.orderDate <= '$end' GROUP BY O.orderDate";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mUpdateOrder($orderID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order` SET sumOfQuantity = (SELECT SUM(quantity) FROM `order_dish` GROUP BY orderID HAVING orderID = $orderID), 
            total = (SELECT SUM(unitPrice * quantity) FROM `order_dish` WHERE orderID = $orderID), 
            discountAmount = (SELECT SUM(discountAmount * quantity) FROM `order_dish` GROUP BY orderID HAVING orderID = $orderID), finalAmount = (SELECT SUM(lineTotal) FROM `order_dish` GROUP BY orderID HAVING orderID = $orderID) WHERE orderID = $orderID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mUpdateStatusOrder($orderID, $status, $storeID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order` SET status = $status WHERE orderID = $orderID AND storeID = $storeID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mInsertOrder($customerID, $total, $sumOfQuantity, $promotionID, $paymentMethod, $storeID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `order` (customerID, total, sumOfQuantity, promotionID, paymentMethod, storeID) VALUES ($customerID, $total, $sumOfQuantity, $promotionID, '$paymentMethod', $storeID)";

        return $conn->query($sql);
    }
    
    public function mInsertOrderPartyPackage($customerID, $total, $sumOfQuantity, $promotionID, $paymentMethod, $storeID, $partyPackageID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `order` (customerID, total, sumOfQuantity, promotionID, paymentMethod, storeID, partyPackageID) VALUES ($customerID, $total, $sumOfQuantity, $promotionID, '$paymentMethod', $storeID, $partyPackageID)";

        return $conn->query($sql);
    }

    public function mInsertOrderDish($orderID, $dishID, $quantity)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `order_dish` (orderID, dishID, quantity) VALUES ($orderID, $dishID, $quantity)";

        return $conn->query($sql);
    }

    public function mGetAllOrderFully($storeID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `order` AS O JOIN `customer` AS C ON O.customerID = C.customerID JOIN `order_dish` AS OD ON OD.orderID = O.orderID JOIN `dish` AS D ON D.dishID = OD.dishID WHERE O.storeID = $storeID GROUP BY O.orderID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mGetOrderIDNew()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT orderID FROM `order` ORDER BY orderID DESC LIMIT 1";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
}