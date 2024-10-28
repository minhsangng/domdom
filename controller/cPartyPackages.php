<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mPartyPackages.php";
else $path = "./model/mPartyPackages.php";

if (!class_exists("mPartyPackages"))
    require_once($path);

class cPartyPackages extends mPartyPackages
{
    public function cGetAllPartyPackage()
    {
        if ($this->mGetAllPartyPackage() != 0) {
            $result = $this->mGetAllPartyPackage();

            return $result;
        } return 0;
    }
    
    public function cGetPartyPackageByName($name) {
        if ($this->mGetPartPackageByName($name) != 0) {
            $result = $this->mGetPartPackageByName($name);
            
            return $result;
        } return 0; 
    }
}
