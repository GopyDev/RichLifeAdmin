<?php
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

$eventid   = base64_decode($_GET['eventid']);

$sql="DELETE FROM events WHERE eventid='".$eventid."'";
$deleteUser =setXbyY($sql,"array");
header("Location:event_list.php?msg=26");

?>
