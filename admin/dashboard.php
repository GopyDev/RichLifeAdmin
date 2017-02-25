<?php 
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

$sql = "SELECT * FROM admin WHERE adminid='".$_SESSION['adminid']."'";
$myinfo=getXbyY($sql,"assoc");

$sql_eventnumber = "SELECT * FROM events";
$events=getXbyY($sql_eventnumber,"assoc");
$totalEvents=count($events);

$sql_usersnumber = "SELECT * FROM users";
$users=getXbyY($sql_usersnumber,"assoc");
$totalUsers=count($users);

$sql_venuesnumber = "SELECT * FROM venues";
$venues=getXbyY($sql_venuesnumber,"assoc");
$totalVenues=count($venues);

$sql_panumber = "SELECT * FROM parksamenities";
$pa=getXbyY($sql_panumber,"assoc");
$totalPA=count($pa);

// include html/header/footer
include ("../include/header_in.php");
include ("html/dashboard.php");
include ("../include/footer_in.php");
?>