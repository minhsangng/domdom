<?php

class mEmployees
{
    public function mGetAllEmployee()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `user` AS U JOIN `role` AS R ON U.roleID = R.roleID WHERE U.roleID IN (3, 4)";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetEmployeeIDByName($name)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT userID FROM `user` WHERE userName = '$name'";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetEmployeeByID($id)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `user` WHERE userID = $id";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetEmployeeByStoreID($storeID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `user` AS U JOIN `role` AS R ON U.roleID = R.roleID WHERE U.roleID IN (3, 4) AND U.storeID = $storeID";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetEmployeeAttendance($storeID)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `user` AS U JOIN `role` AS R ON U.roleID = R.roleID JOIN `employee_shift` AS ES ON ES.userID = U.userID JOIN `shift` AS S ON S.shiftID = ES.shiftID JOIN `store` AS ST ON U.storeID = ST.storeID WHERE U.roleID IN (3, 4) AND U.storeID = $storeID AND ES.date = CURRENT_DATE";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mDeleteEmployeeShift($shiftID, $userID, $date)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "DELETE FROM `employee_shift` WHERE shiftID = $shiftID AND userID = $userID AND date = '$date'";
        
        return $conn->query($sql);
    }
    
    public function mInsertEmployeeShift($shiftID, $userID, $date)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "INSERT INTO `employee_shift` (shiftID, userID, date) VALUES ($shiftID, $userID, '$date')";
        
        return $conn->query($sql);
    }
    
    public function mGetEmployeeShiftInfo($userID, $start, $end)
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM `employee_shift` AS ES JOIN `user` AS U ON ES.userID = U.userID JOIN `shift` AS S ON ES.shiftID = S.shiftID WHERE U.userID = $userID AND ES.date >= '$start' AND ES.date <= '$end' ORDER BY ES.date, S.startTime";
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
}