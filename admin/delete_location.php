<?php
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

$location_id   = base64_decode($_GET['id']);
$page     = base64_decode($_GET['page']);

$sql="DELETE FROM locations WHERE locationid='".$location_id."'";
$deleteDriver =setXbyY($sql,"array");

header("Location:locations.php?pageNO=".$page."");

?>
