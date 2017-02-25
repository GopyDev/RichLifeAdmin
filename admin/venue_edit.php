<?php 
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

if(isset($_GET['msg'])){
	$msg = getERRORS($_GET['msg']);
}else{
	$msg = "";
}

$venueid = base64_decode($_GET['venueid']);

$sql = "SELECT * FROM admin WHERE adminid='".$_SESSION['adminid']."'";
$myinfo=getXbyY($sql,"assoc");

$sql_check = "SELECT * FROM venues WHERE id='{$venueid}'";
$venues = getXbyY($sql_check,'assoc');

if(count($_POST)>0){

	$title      = mysql_real_escape_string($global_connection, $_POST['name']);
	$text   = mysql_real_escape_string($global_connection, $_POST['subtext']);
	$fromdate  = $_POST['fdate'];
	$todate  = $_POST['tdate'];

	$sqlUpdate="UPDATE `venues` SET `title`='".$title."',`text`='".$text."',`fromdate`='".$fromdate."',`todate`='".$todate."' WHERE id='".$venueid."'";
	$resUpdate=setXbyY($sqlUpdate,'assoc');
	header("Location:venue_list.php?msg=27");
}

// include html/header/footer
include ("../include/header_in.php");
include ("html/venue_edit.php");
include ("../include/footer_in.php");
?>