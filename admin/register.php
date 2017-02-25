<?php 
ob_start();
session_start();
include ("../include.php");

if(isset($_SESSION['adminid'])){
	header("location:users.php");
}

if(isset($_GET['msg'])){
	$msg = getERRORS($_GET['msg']);
}else{
	$msg = "";
}

if(count($_POST)>0){
	
	$password = $_POST['password'];
	$repass   = $_POST['repass'];
	echo $password;
	if ($password !== $repass){
		header("location:register.php?msg=3");
	} else {
		$username = $_POST['username'];
		$email = $_POST['email'];

		$sql_check = "select email from admin where email='".$email."'";
		$res_check = getXbyY($sql_check,"assoc");
		$row_check = count($res_check);
		// if admin credentails matched         
		if($row_check == 1){
			header("location:register.php?msg=8");
		}else{
			$today = todaysDate();
			$sqlStr="insert into admin(username,email,password,modified,isactive)values('".$username."','".$email."','".md5($password)."','".$today."','1')";
			$resStr=setXbyY($sqlStr,'assoc');
			$name = explode(" ", $username);
			if(count($name)>1){
				$firstname = $name[0];
				$lastname = $name[1];
			} else {
				$firstname = $username;
			}
			$sql="insert into users(firstname,lastname,email,password,usertype)values('".$firstname."','".$lastname."','".$email."','".md5($password)."','admin')";
			$res=setXbyY($sql,'assoc');
			header("location:index.php?msg=7");
		}
	}
}

// include html/header/footer
include ("../include/start.php");
include ("html/register.php");
include ("../include/end.php");
?>