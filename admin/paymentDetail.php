<?php 
ob_start();
session_start();
include ("../include.php"); 

// check if user logged in
if ($_SESSION['adminid'] == "") {
	header("location:index.php");
}

if (isset($_GET['msg'])) {
	$msg = getERRORS($_GET['msg']);
} else {
	$msg = "";
}



if (isset($_POST['submit'])) {
	$pay_type = $_POST['pay_type'];

	$item_id = $_POST['item_id'];
	$today = todaysDate();

	if ($pay_type == 1) {
		$sql = "UPDATE service
				SET isactive=0
				WHERE serviceid='{$item_id}'";
		$res = setXbyY($sql);
	} else if ($pay_type == 2) {
		$sqlReferral = "SELECT
						a.*,
						b.username AS username
					FROM
						refer_user a,
						users b
					WHERE
						a.isactive = 1 AND
						a.userid = b.userid AND
						a.referid={$referid}";
		$resReferral = getXbyY($sqlReferral, "array");
		$refer_item = $resReferral[0];

		$sql_insert = "INSERT INTO paymentlog
							(paid_userid.
							pay_type,
							refered_userid,
							createdon)
						VALUES
							('{$refer_item['userid']}',
							2,
							'{$refer_item['referedto']}',
							'{$today}')";
		$res_insert = setXbyY($sql_insert);
	} else if ($pay_type == 3) {
		$sqlReferral = "SELECT
							a.*,
							b.username AS username
						FROM
							refer_user a,
							users b
						WHERE
							a.isactive = 1 AND
							a.userid = b.userid AND
							a.referid = {$referid}";
		$resReferral = getXbyY($sqlReferral, "array");
		$refer_item = $resReferral[0];

		$sql_insert = "INSERT INTO paymentlog
							(paid_userid.
							pay_type,
							refered_userid,
							createdon)
						VALUES
							('{$refer_item['userid']}',
							2,
							'{$refer_item['referedto']}',
							'{$today}')";
		$res_insert = setXbyY($sql_insert);
	} else if ($pay_type == 4) {
		$sql = "UPDATE service_tip
				SET isactive=0
				WHERE service_tip_id='{$item_id}'";
		$res = setXbyY($sql);
	}

	header("Location:payments.php");
} else {
	$pay_type = $_GET['pay_type'];
	$pageNO = base64_decode($_GET['pageNO']);

	if ($pay_type == 1) {
		$serviceid = base64_decode($_GET['id']);

		// fetch all user data
		$sql = "SELECT
					a.*,
					b.categoryid,
					b.category,
					c.subcategoryid,
					c.subcategory,
					d.note,
					d.payment,
					d.cost_min,
					d.cost_max,
					d.cardnumber,
					d.cvv,
					d.expiration_date
				FROM
					service a,
					category b,
					subcategory c,
					servicerequest d
				WHERE
					a.serviceid = {$serviceid} AND
					a.categoryid = b.categoryid AND
					a.subcategoryid = c.subcategoryid AND
					a.serviceid = d.serviceid";

		$res = getXbyY($sql, "assoc");
		$service_info = $res[0];

		$sql = "SELECT * FROM servicearrival WHERE serviceid={$serviceid}";
		$res = getXbyY($sql, "assoc");
		if (count($res) > 0)
			$service_arrival = $res[0];
		else
			$service_arrival = null;

		$sql = "SELECT * FROM serviceaccepted WHERE serviceid={$serviceid}";
		$res = getXbyY($sql, "assoc");
		if (count($res) > 0)
			$service_accepted = $res[0];
		else
			$service_accepted = null;
	} else if ($pay_type == 2) {
		$referid = base64_decode($_GET['id']);

		$sqlReferral = "SELECT
						a.*,
						b.username AS username
					FROM
						refer_user a,
						users b
					WHERE
						a.isactive = 1 AND
						a.userid = b.userid AND
						a.referid={$referid}";
		$resReferral = getXbyY($sqlReferral, "array");
		if (count($resReferral) == 0) {
			print_r("Sorry, data not found");
			die();
		}

		$refer_item = $resReferral[0];
		$refer_item['pay_type'] = 2;			// pay for referral
		$refer_item['referredtousername'] = getUserDetail($refer_item['referred_userid'], 'username');
		$refer_item['cost'] = 10;
	} else if ($pay_type == 3) {
		$referid = base64_decode($_GET['id']);
		$sqlReferral = "SELECT
							a.*,
							b.username AS username
						FROM
							refer_user a,
							users b
						WHERE
							a.isactive = 1 AND
							a.userid = b.userid AND
							a.referid = {$referid}";
		$resReferral = getXbyY($sqlReferral, "array");
		if (count($resReferral) == 0) {
			print_r("Sorry, data not found");
			die();
		}

		$refer_item = $resReferral[0];
		$refer_item['pay_type'] = 3;			// pay for referral to driver
		$refer_item['cost'] = 50;
		$refer_item['referredtousername'] = getUserDetail($refer_item['referred_userid'], 'username');
	} else if ($pay_type == 4) {
		$tipid = base64_decode($_GET['id']);
		$sqlReferral = "SELECT
						a.*,
						b.username AS drivername
					FROM
						service_tip a,
						users b
					WHERE
						a.isactive = 1 AND
						a.driverid = b.userid AND
						a.service_tip_id = {$tipid}";
		$resReferral = getXbyY($sqlReferral, "array");
		if (count($resReferral) == 0) {
			print_r("Sorry, data not found");
			die();
		}

		$refer_item = $resReferral[0];
		$refer_item['pay_type'] = 4;			// pay for tip
		$refer_item['cost'] = $refer_item['amount'];
	} else {
		print_r("Sorry, data not found");
		die();
	}


	// include html/header/footer
	include ("../include/header_inner.php");
	include ("html/paymentDetail.php");
	include ("../include/footer.php");
}
?>