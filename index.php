<?php
error_reporting(1);
/* ini_set('display_errors', 1); */
session_start();

include("model/connect.php");
include("controller/cCategories.php");
include("controller/cPromotions.php");
include("controller/cPartyPackages.php");
include("controller/cDishes.php");

$db = new Database();
$conn = $db->connect();

include_once("view/layout/header.php");

$p = "";

if ($_REQUEST["p"] != "")
  $p = $_REQUEST["p"];
else
  $p = "home";
  
if ($p != "home") {
  include_once("view/page/" . $p . "/index.php");
} else
  include_once("view/page/home/index.php");

echo "<script src='view/main.js'></script>";

include_once("view/layout/footer.php");
