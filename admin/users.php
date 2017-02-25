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

if(isset($_GET['pageNO'])){
	$pageNO = $_GET['pageNO'];
	if($pageNO=='0'){
		$pageNO = 1;
	}elseif($pageNO==''){
		$pageNO = 1;
	}
}else{
	$pageNO = 1;
}

if(isset($_POST['submit']) || isset($_GET['search'])){
	if(isset($_POST['submit'])){
		$searchP=$_POST['search'];
	}else{
		$searchP=$_GET['search'];
	}
	$search="and (username LIKE '%".$searchP."%' or email LIKE '%".$searchP."%' or phone LIKE '%".$searchP."%')";
}else{
	$searchP="";
	$search="";
}

$sqlTOTAL = "select userid from users where usertype='1' $search  order by createdon DESC";
$resTOTAL = getXbyY($sqlTOTAL,"array");
$rowsTOTAL = count($resTOTAL);

$pagename = "users.php";

$per =20;

$totalPAGES = ceil($rowsTOTAL/$per);
$startLIMIT = ($pageNO - 1)*$per;
$endLIMIT   = $per;
 

// fetch all user data
$sql="select * from users where usertype='1' $search order by createdon DESC LIMIT $startLIMIT, $endLIMIT";
$res=getXbyY($sql,"assoc");
$row=count($res);

// include html/header/footer
include ("../include/header_inner.php");
include ("html/users.php");
include ("../include/footer.php");
?>