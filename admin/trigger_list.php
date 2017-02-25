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

$sql = "SELECT * FROM triggers";
$alltrigger=getXbyY($sql,"assoc");
$row=count($alltrigger);

// include html/header/footer
include ("../include/header_in.php");
include ("html/trigger_list.php");
//include ("../include/footer_in.php");
?>