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
$sql = "SELECT * FROM users WHERE isactive='1'";
$alluser=getXbyY($sql,"assoc");
$row=count($alluser);

// include html/header/footer
include ("../include/header_in.php");
include ("html/user_list.php");
?>