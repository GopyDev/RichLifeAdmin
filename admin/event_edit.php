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

$eventid = base64_decode($_GET['eventid']);

$sql = "SELECT * FROM admin WHERE adminid='".$_SESSION['adminid']."'";
$myinfo=getXbyY($sql,"assoc");

$sql = "SELECT * FROM events WHERE eventid='{$eventid}'";
$event = getXbyY($sql,'assoc');

$sql = "SELECT * FROM triggers";
$alltrigger=getXbyY($sql,"assoc");
$rowtriggers=count($alltrigger);

if(count($_POST)>0){
	$category = $_POST['category'];
	if($category === "trending" || $category === "regular"){
		if($_POST['iconurl'] == "" || $_POST['picurl'] == ""){
			header("Location:event_edit.php?msg=23&eventid=".base64_encode($eventid));
		} else {
			$name      = mysqli_real_escape_string($global_connection, $_POST['name']);
			$subtitle  = mysqli_real_escape_string($global_connection, $_POST['subtitle']);
			$subtext   = mysqli_real_escape_string($global_connection, $_POST['subtext']);
			$latitude  = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$location  = mysqli_real_escape_string($global_connection, $_POST['address']);
			$datetime  = $_POST['datetime'];

			$EvtPicuploadDir  ='../images/EventPic/'; //Uploading to same directory as PHP file
			$EvtIconuploadDir ='../images/EventIcon/'; //Uploading to same directory as PHP file
			$EvtPicuploadDir2 ='images/EventPic/'; //Uploading to same directory as PHP file
			$EvtIconuploadDir2 ='images/EventIcon/'; //Uploading to same directory as PHP file

			if($_FILES['icon']['name'][0] != ""){
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
			} else {
				$evticon = $_POST['iconurl'];
			}

			if($_FILES['evtpicture']['name'][0] != ""){
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
			} else {
				$evtpic = $_POST['picurl'];
			}

			$sqlUpdate="UPDATE `events` SET `name`='".$name."',`title`='".$subtitle."',`subtext`='".$subtext."',`picture`='".$evtpic."',`icon`='".$evticon."',`datetime`='".$datetime."',`location`='".$location."',`latitude`='".$latitude."',`longitude`='".$longitude."' WHERE eventid='".$eventid."'";
			$resUpdate=setXbyY($sqlUpdate,'assoc');
			header("Location:event_list.php?msg=25");
		}
	} else if($category === "alert"){
		$date      = dateOnly();
		$name      = mysql_real_escape_string($global_connection, $_POST['name']);
		$subtitle  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
		if($subtitle && $name){
			$sqlUpdate="UPDATE `events` SET `name`='".$name."',`title`='".$subtitle."',`category`='".$category."',`created`='".$date."' WHERE eventid='".$eventid."'";
			$resUpdate=setXbyY($sqlUpdate,'assoc');
			header("Location:event_list.php?msg=25");
		} else {
			header("Location:event_edit.php?msg=34&eventid=".base64_encode($eventid));
		}
	} else if($category === "offer"){
		if($_POST['picurl'] == ""){
			header("Location:event_edit.php?msg=23&eventid=".base64_encode($eventid));
		} else {
			$name      = mysql_real_escape_string($global_connection, $_POST['name']);
			$subtitle  = mysql_real_escape_string($global_connection, $_POST['subtitle']);
			$latitude  = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$location  = $_POST['address'];

			$EvtPicuploadDir  ='../images/EventPic/'; //Uploading to same directory as PHP file
			$EvtPicuploadDir2 ='images/EventPic/'; //Uploading to same directory as PHP file

			if($_FILES['evtpicture']['name'][0] != ""){
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
			} else {
				$evtpic = $_POST['picurl'];
			}

			$sqlUpdate="UPDATE `events` SET `name`='".$name."',`title`='".$subtitle."',`picture`='".$evtpic."',`datetime`='".$datetime."',`location`='".$location."',`latitude`='".$latitude."',`category`='".$category."',`longitude`='".$longitude."' WHERE eventid='".$eventid."'";
			$resUpdate=setXbyY($sqlUpdate,'assoc');
			header("Location:event_list.php?msg=25");
		}
	}
}

// include html/header/footer
include ("../include/header_in.php");
include ("html/event_edit.php");
include ("../include/footer_in.php");
?>