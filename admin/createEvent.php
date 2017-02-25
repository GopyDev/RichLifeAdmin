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
	$category = $_POST['category'];
	if($category === "trending" || $category === "regular"){
		if($_FILES['evtpicture']['name'][0] == "" || $_FILES['icon']['name'][0] == ""){
			header("Location:createEvent.php?msg=23");
		} else {
			$date      = dateOnly();
			$name      = mysql_real_escape_string($global_connection, $_POST['name']);
			$subtitle  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
			$subtext   = mysql_real_escape_string($global_connection, $_POST['subtext']);
			$latitude  = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$location  = $_POST['address'];
			$datetime  = $_POST['datetime'];
			$reservation  = $_POST['reserve'];
			$payment  = $_POST['pay'];

			if($datetime && $name && $subtext && $subtitle && $location){
				$EvtPicuploadDir  ='../images/EventPic/'; //Uploading to same directory as PHP file
				$EvtIconuploadDir ='../images/EventIcon/'; //Uploading to same directory as PHP file
				$EvtPicuploadDir2 ='images/EventPic/'; //Uploading to same directory as PHP file
				$EvtIconuploadDir2 ='images/EventIcon/'; //Uploading to same directory as PHP file

				$iconfile 		 =basename($_FILES['icon']['name'][0]);
				$iconuploadFile   =$iconfile;
				$randomNumber1 =rand(0, 99999);
				$ext1		  =explode(".",$iconuploadFile);
				$total1        =count($ext1);
				$ext1          =$ext1[$total1-1]; 
				$iconnewName      =$EvtIconuploadDir.$randomNumber1.".".$ext1;
				$iconnewName2     =$EvtIconuploadDir2.$randomNumber1.".".$ext1;

				move_uploaded_file($_FILES['icon']['tmp_name'][0], $iconnewName);
				$evticon = $iconnewName2;

				$picfile 		 =basename($_FILES['evtpicture']['name'][0]);
				$picuploadFile   =$picfile;
				$randomNumber =rand(0, 99999);
				$ext		  =explode(".",$picuploadFile);
				$total        =count($ext);
				$ext          =$ext[$total-1]; 
				$picnewName      =$EvtPicuploadDir.$randomNumber.".".$ext;
				$picnewName2     =$EvtPicuploadDir2.$randomNumber.".".$ext;

				move_uploaded_file($_FILES['evtpicture']['tmp_name'][0], $picnewName);
				$evtpic = $picnewName2;

				$sql_insert="insert into events(name,title,subtext,picture,icon,datetime,location,latitude,longitude,reservation,payment,category,created)values('".$name."','".$subtitle."','".$subtext."','".$evtpic."','".$evticon."','".$datetime."','".$location."','".$latitude."','".$longitude."','".$reservation."','".$payment."','".$category."','".$date."')";
				$res_insert=setXbyY($sql_insert,"assoc");
				header("Location:event_list.php?msg=24");
			} else {
				header("Location:createEvent.php?msg=34");
			}
		}
	} else if($category === "alert"){
		$date      = dateOnly();
		$name      = mysql_real_escape_string($global_connection, $_POST['name']);
		$subtitle  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
		if($subtitle && $name){
			$sql_insert="insert into events(name,title,category,created)values('".$name."','".$subtitle."','".$category."','".$date."')";
			$res_insert=setXbyY($sql_insert,"assoc");
			header("Location:event_list.php?msg=24");
		} else {
			header("Location:createEvent.php?msg=34");
		}
	} else if($category === "offer"){
		if($_FILES['evtpicture']['name'][0] == ""){
			header("Location:createEvent.php?msg=23");
		} else {
			$date      = dateOnly();
			$name      = mysql_real_escape_string($global_connection, $_POST['name']);
			$subtitle  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
			$latitude  = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$location  = $_POST['address'];

			if($name && $subtitle && $location){
				$EvtPicuploadDir  ='../images/EventPic/'; //Uploading to same directory as PHP file
				$EvtPicuploadDir2 ='images/EventPic/'; //Uploading to same directory as PHP file

				$picfile 		 =basename($_FILES['evtpicture']['name'][0]);
				$picuploadFile   =$picfile;
				$randomNumber =rand(0, 99999);
				$ext		  =explode(".",$picuploadFile);
				$total        =count($ext);
				$ext          =$ext[$total-1]; 
				$picnewName      =$EvtPicuploadDir.$randomNumber.".".$ext;
				$picnewName2     =$EvtPicuploadDir2.$randomNumber.".".$ext;

				move_uploaded_file($_FILES['evtpicture']['tmp_name'][0], $picnewName);
				$evtpic = $picnewName2;

				$sql_insert="insert into events(name,title,picture,location,latitude,longitude,category,created)values('".$name."','".$subtitle."','".$evtpic."','".$location."','".$latitude."','".$longitude."','".$category."','".$date."')";
				$res_insert=setXbyY($sql_insert,"assoc");
				header("Location:event_list.php?msg=24");
			} else {
				header("Location:createEvent.php?msg=34");
			}
		}
	}

}
// include html/header/footer
include ("../include/header_in.php");
include ("html/createEvent.php");
include ("../include/footer_in.php");
?>