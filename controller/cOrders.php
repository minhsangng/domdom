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
        } return 0;
    }
    
    public function cGetAllOrderFully() {
        if ($this->mGetAllOrderFully() != 0) {
            $result = $this->mGetAllOrderFully();
            
            return $result;
        } return 0;
    }
}