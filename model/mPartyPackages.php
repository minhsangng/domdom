<?php

class mPartyPackages
{
    public function mGetAllPartyPackage()
    {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM partyPackage";
        
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
    
    public function mGetPartPackageByName($name) {
        $db = new Database;
        $conn = $db->connect();
        $sql = "SELECT * FROM partyPackage WHERE partyPackageName LIKE '%".$name."%'";
        
        if ($conn != null) 
            return $conn->query($sql);
        return 0;
    }
}