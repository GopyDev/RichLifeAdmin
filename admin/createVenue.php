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

$sql = "SELECT * FROM admin WHERE adminid='".$_SESSION['adminid']."'";
$myinfo=getXbyY($sql,"assoc");

if(count($_POST)>0){
	$title = mysql_real_escape_string($global_connection, $_REQUEST['name']);
	$text = mysql_real_escape_string($global_connection, $_REQUEST['subtext']);
	$fromdate =$_REQUEST['fdate'];
	$todate =$_REQUEST['tdate'];

	$today = dateOnly();
	$sql_insert="insert into venues(title,text,fromdate,todate)values('".$title."','".$text."','".$fromdate."','".$todate."')";
	$res_insert=setXbyY($sql_insert,"assoc");

	header("location:venue_list.php?msg=29");
}

// include html/header/footer
include ("../include/header_in.php");
include ("html/createVenue.php");
include ("../include/footer_in.php");
?>