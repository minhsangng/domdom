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

    public function mUpdateOrderDish($orderID, $dishID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order_dish` AS OD JOIN `dish` AS D ON OD.dishID = D.dishID 
            SET OD.unitPrice = D.price, promotionID = (SELECT IFNULL(PD.promotionID, NULL) FROM `promotiondish` AS PD JOIN `promotion` AS P ON P.promotionID = PD.promotionID
            WHERE PD.dishID = $dishID AND P.quantity > 0 AND (NOW() BETWEEN P.startDate AND P.endDate) LIMIT 1) WHERE OD.orderID = $orderID AND OD.dishID = $dishID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mUpdateAmountOrderDish($orderID, $dishID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order_dish` AS OD
                LEFT JOIN `promotion` AS P ON OD.promotionID = P.promotionID
                SET 
                    OD.discountAmount = IF(OD.promotionID IS NULL, 0, OD.unitPrice * (P.discountPercentage / 100)),
                    OD.lineTotal = IF(OD.promotionID IS NULL, 
                        OD.unitPrice * OD.quantity, 
                        (OD.unitPrice * OD.quantity) - (OD.unitPrice * (P.discountPercentage / 100)) * OD.quantity)
                WHERE 
                    OD.orderID = $orderID 
                    AND OD.dishID = $dishID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mUpdateStatusOrder($orderID, $status)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "UPDATE `order` SET status = $status WHERE orderID = $orderID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }

    public function mInsertOrder($customerID, $paymentMethod, $storeID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `order` (customerID, paymentMethod, storeID) VALUES ($customerID, '$paymentMethod', $storeID)";

        return $conn->query($sql);
    }

    public function mInsertOrderDish($orderID, $dishID, $quantity)
    {
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

    public function mGetOrderIDNew()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT orderID FROM `order` ORDER BY orderID DESC LIMIT 1";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetPromotionIDNew($orderID, $dishID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT promotionID, quantity FROM `order_dish` WHERE orderID = $orderID AND dishID = $dishID";
        if ($conn != null)
            return $conn->query($sql);
        return 0;
    }
}