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

$sql_check = "SELECT * FROM parksamenities";
$allpa=getXbyY($sql_check,"assoc");
$row=count($allpa);

// include html/header/footer
include ("../include/header_in.php");
include ("html/panda_list.php");
include ("../include/footer_in.php");
?>