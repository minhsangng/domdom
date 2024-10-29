<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mOrders.php";
else $path = "./model/mOrders.php";

if (!class_exists("mOrders"))
    require_once($path);

class cOrders extends mOrders
{
    public function cGetAllOrder() {
        if ($this->mGetAllOrder() != 0) {
            $result = $this->mGetAllOrder();
            
            return $result;
        } return 0;
    }

    public function cGetAllOrderByID($orderID) {
        $result = [];
        $orderData = $this->mGetAllOrderByID($orderID);
        if ($orderData != 0 && $orderData->num_rows > 0) {
            $order = $orderData->fetch_assoc();
            if (!is_null($order['partyPackageID'])) {
                $packageData = $this->mGetOrderPackage($orderID);
                if ($packageData != 0 && $packageData->num_rows > 0) {
                    $result['type'] = 'package';
                    $result['data'] = $packageData->fetch_all(MYSQLI_ASSOC);
                    return $result;
                }else {
                    return 0;
                }
            } else {
                $dishData = $this->mGetOrderDishes($orderID);
                if ($dishData != 0 && $dishData->num_rows > 0) {
                    $result['type'] = 'dishes';
                    $result['data'] = $dishData->fetch_all(MYSQLI_ASSOC);
                    return $result;
                } else {
                    return 0;
                }
            }
        }
    }

    public function cGetAllOrderDishByID($orrderID) {
        if ($this->mGetOrderDishes($orrderID) != 0) {
            $result = $this->mGetOrderDishes($orrderID);
            
            return $result;
        } return 0;
    }

    public function cGetAllOrderPackageByID($orrderID) {
        if ($this->mGetOrderDishes($orrderID) != 0) {
            $result = $this->mGetOrderPackage($orrderID);
            
            return $result;
        } return 0;
    }
    
    public function cGetAllOrderRangeOf($start, $end) {
        if ($this->mGetAllOrderRangeOf($start, $end) != 0) {
            $result = $this->mGetAllOrderRangeOf($start, $end);
            
            return $result;
        } return 0;
    }
    
    public function cUpdateStatusOrder($orderID, $status) {
        if ($this->mUpdateStatusOrder($orderID, $status) != 0) {
            $result = $this->mUpdateStatusOrder($orderID, $status);
            
            return $result;
        }else 
        return 0;
    }

    public function cUpdateOrderDish($orderID, $quantityUpdate, $notes, $total, $dishID) {
        if ($this->mUpdateOrderDish($orderID, $quantityUpdate, $notes, $total, $dishID)) {
            return true;
        }else 
        return false;
    }

    public function cUpdateOrderPartyPackage($orderID, $notes) {
        if ($this->mUpdateOrderPartyPackage($orderID, $notes)) {
            $result = $this->mUpdateOrderPartyPackage($orderID, $notes);
            
            return true;
        }else 
        return false;
    }
    
    public function cGetAllOrderFully() {
        if ($this->mGetAllOrderFully() != 0) {
            $result = $this->mGetAllOrderFully();
            
            return $result;
        } return 0;
    }

    public function cDeleteOrderDish($orderID, $dishID) {
        if ($this->mDeleteOrderDish($orderID, $dishID) != 0) {
            return true;
        }else {
            return false;
        }
    }

    
}