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

if($_REQUEST['email'] && $_REQUEST['passcode']){

	$email =$_REQUEST['email'];
	$passcode =$_REQUEST['passcode'];

	if (isExist("users", "email", $email)){
		header("location:user_list.php?msg=8");
	} else {
		$today = dateOnly();
		$sql_insert="insert into users(email,passcode,isactive,created_date)values('".$email."','".$passcode."','0','".$today."')";
		$res_insert=setXbyY($sql_insert,"assoc");

		$email_message = "Your passcode: '".$passcode."'";	
		$email_from = 'chimeappdev@gmail.com';
		
		// send to email to users profile
		$to 	  = $email;
		$subject  = "Passcode";
		$message  = $email_message;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$email_from ."\r\n";

		mail($to, $subject, $message, $headers);
		header("location:user_list.php?msg=7");
	}
}

// include html/header/footer
include ("../include/header_in.php");
include ("html/createUser.php");
include ("../include/footer_in.php");
?>