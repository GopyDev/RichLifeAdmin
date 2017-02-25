<?php
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

$paid = base64_decode($_GET['paid']);

$sql="DELETE FROM parksamenities WHERE id='".$paid."'";
$deleteVenue =setXbyY($sql,"array");
header("Location:panda_list.php?msg=30");

?>
