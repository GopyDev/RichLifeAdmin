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

if(isset($_POST['submit'])){
	
	$opassword =$_POST['opassword'];
	$password  =$_POST['password'];
	$cpassword =$_POST['cpassword'];
	
	// check admin table for password
	$sql_check="select * from admin where adminid='".$_SESSION['adminid']."' and password='".md5($opassword)."'";
	$res_check=getXbyY($sql_check,"assoc");
    $row_check=count($res_check);
	 
	if($password == $cpassword){
		if($row_check>0){
			
			//update admin table
			$sql_update ="update admin set password='".md5($password)."' where adminid='".$_SESSION['adminid']."'";
			$res_update =setXbyY($sql_update,"assoc");
			
			header("location:changepassword.php?msg=4");
			
		}else{
			
			header("location:changepassword.php?msg=2");
			
		}
	}else{		 
		header("location:changepassword.php?msg=3");
	}
	
}

// include html/header/footer
include ("../include/header_inner.php");
include ("html/changepassword.php");
include ("../include/footer.php");
?>