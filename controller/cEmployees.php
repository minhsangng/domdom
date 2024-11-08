<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mEmployees.php";
else $path = "./model/mEmployees.php";

if (!class_exists("mEmployees"))
    require_once($path);
    
class cEmployees extends mEmployees
{
    public function cGetAllEmployee()
    {
        if ($this->mGetAllEmployee() != 0) {
            $result = $this->mGetAllEmployee(); 
            return $result;
        }
        return 0;
    }
    
    public function cGetEmployeeIDByName($name)
    {
        if ($this->mGetEmployeeIDByName($name) != 0) {
            $result = $this->mGetEmployeeIDByName($name); 
            return $result;
        }
        return 0;
    }
    
    public function cGetEmployeeByID($id)
    {
        if ($this->mGetEmployeeByID($id) != 0) {
            $result = $this->mGetEmployeeByID($id); 
            return $result;
        }
        return 0;
    }
    
    public function cGetEmployeeByStoreID($storeID)
    {
        if ($this->mGetEmployeeByStoreID($storeID) != 0) {
            $result = $this->mGetEmployeeByStoreID($storeID); 
            return $result;
        }
        return 0;
    }
    
    public function cGetEmployeeAttendance($storeID) {
        if ($this->mGetEmployeeAttendance($storeID) != 0) {
            $result = $this->mGetEmployeeAttendance($storeID); 
            return $result;
        }
        return 0;
    }
    
    public function cDeleteEmployeeShift($userID, $date) {
        if ($this->mDeleteEmployeeShift($userID, $date) != 0) {
            $result = $this->mDeleteEmployeeShift($userID, $date); 
            return $result;
        }
        return 0;
    }
    
    public function cInsertEmployeeShift($shiftID, $userID, $date) {
        if ($this->mInsertEmployeeShift($shiftID, $userID, $date) != 0) {
            $result = $this->mInsertEmployeeShift($shiftID, $userID, $date); 
            return $result;
        }
        return 0;
    }
}