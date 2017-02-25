<?php 
ob_start();
session_start();
include ("../include.php");
//include ("../include/header.php");

if(isset($_SESSION['adminid'])){
	header("location:dashboard.php");
}

if(isset($_GET['msg'])){
	$msg = getERRORS($_GET['msg']);
}else{
	$msg = "";
}

if(count($_POST)>0){

	$email    = $_POST['email'];
	$password = $_POST['password'];

	$sql_check = "select * from admin where email='".$email."' and password='".md5($password)."' and isactive=1";
	$res_check = getXbyY($sql_check,"assoc");
	$row_check = count($res_check);

	// if admin credentails matched         
	if($row_check ==1){
		$_SESSION['adminid'] = $res_check[0]['adminid'];		
		header("location:dashboard.php");
		
	}else{ 
		header("location:index.php?msg=1"); 
	}
}

// include html/header/footer
include ("../include/start.php");
include ("html/index.php");
include ("../include/end.php");
?>