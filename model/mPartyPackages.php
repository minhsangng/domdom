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
}