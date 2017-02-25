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

$paid = base64_decode($_GET['paid']);

$sql = "SELECT * FROM admin WHERE adminid='".$_SESSION['adminid']."'";
$myinfo=getXbyY($sql,"assoc");

$sql = "SELECT * FROM parksamenities WHERE id='{$paid}'";
$allpa = getXbyY($sql,'assoc');
$row=count($allpa);

if(count($_POST)>0){

	/*print_r($_POST);*/
	//print_r($_FILES);
	//if($_FILES['evtpicture']['name'][0] == "" || $_FILES['icon']['name'][0] == ""){
	if($_POST['picurl'] == ""){
		header("Location:panda_edit.php?msg=33&paid=".base64_encode($paid));
	} else {

		$title  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
		$text   = mysql_real_escape_string($global_connection, $_POST['subtext']);
		$latitude  = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$location  = $_POST['address'];
		$datetime  = $_POST['datetime'];

		$PicuploadDir  ='../images/ParksandAmenitiesPic/'; //Uploading to same directory as PHP file
		$PicuploadDir2 ='images/ParksandAmenitiesPic/'; //Uploading to same directory as PHP file

		if($_FILES['evtpicture']['name'][0] != ""){
			$picfile 		 =basename($_FILES['evtpicture']['name'][0]);
			$picuploadFile   =$picfile;
			$randomNumber =rand(0, 99999);
			$ext		  =explode(".",$picuploadFile);
			$total        =count($ext);
			$ext          =$ext[$total-1]; 
			$picnewName      =$PicuploadDir.$randomNumber.".".$ext;
			$picnewName2     =$PicuploadDir2.$randomNumber.".".$ext;

			move_uploaded_file($_FILES['evtpicture']['tmp_name'][0], $picnewName);
			$pic = $picnewName2;
		} else {
			$pic = $_POST['picurl'];
		}

		$sqlUpdate="UPDATE `parksamenities` SET `title`='".$title."',`text`='".$text."',`picture`='".$pic."',`datetime`='".$datetime."',`location`='".$location."',`latitude`='".$latitude."',`longitude`='".$longitude."' WHERE id='".$paid."'";
		$resUpdate=setXbyY($sqlUpdate,'assoc');
		header("Location:panda_list.php?msg=32");
	}
}

// include html/header/footer
include ("../include/header_in.php");
include ("html/panda_edit.php");
include ("../include/footer_in.php");
?>