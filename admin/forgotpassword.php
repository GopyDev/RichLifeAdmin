<?php 
ob_start();
session_start();
include ("../include.php");
 
if(isset($_GET['msg'])){
	$msg = getERRORS($_GET['msg']);
}else{
	$msg = "";
}

if(count($_POST)>0){
	
	$email =$_POST['email'];	 
	
	// check admin table for password
	$sql_check="select * from admin where email='".$email."'";
	$res_check=getXbyY($sql_check,"assoc");
    $row_check=count($res_check);
	
	if($row_check>0){

		$ranPassword=randomPassword();

		//update admin table
		$sql_update ="update admin set password='".md5($ranPassword)."' where adminid='".$res_check[0]['adminid']."'";
		$res_update =setXbyY($sql_update,"assoc");
		 
		$email_message = "Your new password: '".$ranPassword."'";	
		$email_from = 'chimeappdev@gmail.com';
		
		// send to email to users profile
		$to 	  = $email;
		$subject  = "Password";
		$message  = $email_message;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$email_from ."\r\n";

		mail($to, $subject, $message, $headers);  
		 
		header("location:forgotpassword.php?msg=5");
			
	}else{
			
		header("location:forgotpassword.php?msg=6");
			
	}
}

// include html/header/footer
include ("../include/start.php");
include ("html/forgotpassword.php");
include ("../include/end.php");
?>