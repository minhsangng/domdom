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
        return $this->mUpdateOrder($orderID);
    }
    
    public function cUpdateStatusOrder($orderID, $status, $storeID) {
        return $this->mUpdateStatusOrder($orderID, $status, $storeID);
    }
    
    public function cInsertOrder($customerID, $total, $sumOfQuantity, $promotionID, $paymentMethod, $storeID) {
        return $this->mInsertOrder($customerID, $total, $sumOfQuantity, $promotionID, $paymentMethod, $storeID);
    }
    
    public function cInsertOrderPartyPackage($customerID, $total, $sumOfQuantity, $promotionID, $paymentMethod, $storeID, $partyPackageID) {
        return $this->mInsertOrderPartyPackage($customerID, $total, $sumOfQuantity, $promotionID, $paymentMethod, $storeID, $partyPackageID);
    }
    
    public function cInsertOrderDish($orderID, $dishID, $quantity) {
        return $this->mInsertOrderDish($orderID, $dishID, $quantity);
    }
    
    public function cGetAllOrderFully($storeID) {
        if ($this->mGetAllOrderFully($storeID) != 0) {
            $result = $this->mGetAllOrderFully($storeID);
            
            return $result;
        } return 0;
    } 
    
    public function cGetOrderIDNew() {
        if ($this->mGetOrderIDNew() != 0) {
            $result = $this->mGetOrderIDNew();
            
            return $result;
        } return 0;
    }  
}