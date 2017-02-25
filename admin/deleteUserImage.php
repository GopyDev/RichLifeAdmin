<?php 
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if($_SESSION['adminid'] ==""){
	header("location:index.php");
}

$userid = base64_decode($_GET['userid']);
$page = $_GET['page'];

$picOld='../'.getUserDetail($userid,'picture');
unlink($picOld);

$sqlUpdate="UPDATE `users` SET `picture`='' WHERE userid='".$userid."'";
$resUpdate=setXbyY($sqlUpdate,'assoc');

$userid = base64_encode($userid);

header("Location:userEdit.php?userid=".$userid."&page=".$page."");

?>