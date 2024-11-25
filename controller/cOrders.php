<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") || strpos($currentPath, "manager") || strpos($currentPath, "orderstaff") || strpos($currentPath, "kitchenstaff"))
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
    
    public function cGetRevenueOrderByStore($storeID, $start, $end) {
        if ($this->mGetRevenueOrderByStore($storeID, $start, $end) != 0) {
            $result = $this->mGetRevenueOrderByStore($storeID, $start, $end);
            
            return $result;
        } return 0;
    }
    
    public function cGetAllOrderRangeOf($start, $end) {
        if ($this->mGetAllOrderRangeOf($start, $end) != 0) {
            $result = $this->mGetAllOrderRangeOf($start, $end);
            
            return $result;
        } return 0;
    }
    
    public function cUpdateOrder($orderID) {
        if ($this->mUpdateOrder($orderID) != 0) {
            $result = $this->mUpdateOrder($orderID);
            
            return $result;
        } return 0;
    }
    
    public function cUpdateOrderDish($orderID, $dishID) {
        if ($this->mUpdateOrderDish($orderID, $dishID) != 0) {
            $result = $this->mUpdateOrderDish($orderID, $dishID);
            
            return $result;
        } return 0;
    }
    
    public function cUpdateStatusOrder($orderID, $status) {
        if ($this->mUpdateStatusOrder($orderID, $status) != 0) {
            $result = $this->mUpdateStatusOrder($orderID, $status);
            
            return $result;
        } return 0;
    }
    
    public function cInsertOrder($customerID, $paymentMethod) {
        return $this->mInsertOrder($customerID, $paymentMethod);
    }
    
    public function cInsertOrderDish($orderID, $dishID, $quantity) {
        return $this->mInsertOrderDish($orderID, $dishID, $quantity);
    }
    
    public function cGetAllOrderFully() {
        if ($this->mGetAllOrderFully() != 0) {
            $result = $this->mGetAllOrderFully();
            
            return $result;
        } return 0;
    }    
}