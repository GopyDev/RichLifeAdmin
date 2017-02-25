<?php
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

$venueid = base64_decode($_GET['venueid']);

$sql="DELETE FROM venues WHERE id='".$venueid."'";
$deleteVenue =setXbyY($sql,"array");
header("Location:venue_list.php?msg=28");

?>
