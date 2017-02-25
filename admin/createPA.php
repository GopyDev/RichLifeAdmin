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

if(count($_POST)>0){

	if($_FILES['picture']['name'][0] == ""){
		header("Location:createPA.php?msg=33");
	} else {
		$title  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
		$text   = mysql_real_escape_string($global_connection, $_POST['subtext']);
		$latitude  = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$location  = $_POST['address'];
		$datetime  = $_POST['datetime'];

		$PicuploadDir  ='../images/ParksandAmenitiesPic/'; //Uploading to same directory as PHP file
		$PicuploadDir2 ='images/ParksandAmenitiesPic/'; //Uploading to same directory as PHP file

		$picfile 		 =basename($_FILES['picture']['name'][0]);
		$picuploadFile   =$picfile;
		$randomNumber =rand(0, 99999);
		$ext		  =explode(".",$picuploadFile);
		$total        =count($ext);
		$ext          =$ext[$total-1]; 
		$picnewName      =$PicuploadDir.$randomNumber.".".$ext;
		$picnewName2     =$PicuploadDir2.$randomNumber.".".$ext;

		move_uploaded_file($_FILES['picture']['tmp_name'][0], $picnewName);
		$pic = $picnewName2;

		$sql_insert="insert into parksamenities(title,text,picture,datetime,location,latitude,longitude)values('".$title."','".$text."','".$pic."','".$datetime."','".$location."','".$latitude."','".$longitude."')";
		$res_insert=setXbyY($sql_insert,"assoc");
		header("Location:panda_list.php?msg=31");
	}
}
// include html/header/footer
include ("../include/header_in.php");
include ("html/createPA.php");
include ("../include/footer_in.php");
?>