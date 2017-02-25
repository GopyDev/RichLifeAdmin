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

if (isset($_GET['pageNO'])) {
	$pageNO = $_GET['pageNO'];
} else {
	$pageNO = 1;
}



$total_items = array();

// Pay for the service as driver
$sqlService = "SELECT
					C.*,
					subcategory.subcategory
				FROM (
					SELECT	B.*,
							category.category
					FROM (
						SELECT
							service.*,
							users.username
						FROM service
						INNER JOIN users ON service.userid=users.userid
						WHERE
							service.isactive=1 AND
							(service.status=2 OR service.status=5) AND
							(service.errand > 0 || service.cost > 0)
						) AS B
					INNER JOIN category
					ON category.categoryid = B.categoryid
				) AS C
				INNER JOIN subcategory ON C.subcategoryid = subcategory.subcategoryid";
$resServices = getXbyY($sqlService, "array");

for ($i = 0; $i < count($resServices); $i++) {
	$resServices[$i]['pay_type'] = 1;			// Pay for service
	$resServices[$i]['drivername'] = getUserDetail($resServices[$i]['driverid'], 'username');
}


// Added services
$total_items = array_merge($total_items, $resServices);


// Get referral bonus for users

// 1. receive $10 every month up to 5 months if referred user is subscriber
$sqlReferral = "SELECT
					a.*,
					b.username AS username
				FROM
					refer_user a,
					users b
				WHERE
					a.isactive = 1 AND
					a.userid = b.userid";
$resReferral = getXbyY($sqlReferral, "array");

for ($i = 0; $i < count($resReferral); $i++) {
	$refer_item = $resReferral[$i];

	$refer_item['pay_type'] = 2;			// pay for referral

	$referred_userid = $refer_item['referedto'];
	$userid = $refer_item['userid'];
	$is_subscriber = userWeeklyErrandLeft($referred_userid) > 0;

	if (!$is_subscriber)
		continue;

	$sql_check = "SELECT * FROM usersplan WHERE userid={$referred_userid} ORDER BY createdon ASC";
	$res_check = getXbyY($sql_check, "array");
	if (count($res_check) == 0)
		continue;

	$today = date("Y-m-d", mktime(0,0,0, date("m"), date("d"), date("y")));

	$first_plan_date = $res_check[0]['createdon'];
	$interval = date_diff($today, $first_plan_date);
	$total_days = $interval->format('%d');
	if ($total_days > 150)		// 5 months
		continue;

	// Check if the user is paid for this referral in last 30 days
	$month_ago = strtotime($today . "-1 month");
	$sql_check = "SELECT * FROM paymentlog
					WHERE
						paid_userid={$userid} AND
						refered_userid={$referred_userid}
					WHERE
						createdon>='{$month_ago}' AND
						pay_type=2'
					ORDER BY createdon DESC";
	$res_check = getXbyY($sql_check, "array");
	if (count($res_check) > 0)
		continue;				// Already paid in last 30 days

	$refer_item['referredtousername'] = getUserDetail($refer_item['referred_userid'], 'username');
	$refer_item['cost'] = 10;

	array_push($total_items, $refer_item);
}


// 2. when they refer a driver all will receive $50 after the driver completes his first 30 trips within the first 30 days!
$sqlReferral = "SELECT
					a.*,
					b.username AS username
				FROM
					refer_user a,
					users b
				WHERE
					a.isactive = 1 AND
					a.userid = b.userid";
$resReferral = getXbyY($sqlReferral, "array");
for ($i = 0; $i < count($resReferral); $i++) {
	$refer_item = $resReferral[$i];

	$refer_item['pay_type'] = 3;			// pay for referral to driver

	$referred_userid = $refer_item['referedto'];
	$userid = $refer_item['userid'];
	if (!isDriverValid($referred_userid))
		continue;

	$signup_date = getUserDetail($referred_userid, 'createdon');
	$after_month = strtotime($signup_date . "+1 month");

	$sql_check = "SELECT *
					FROM service
					WHERE
						driverid={$referred_userid} AND
						status=4 AND
						end_time <= '{$after_month}'
				";
	$res_check = getXbyY($sql_check, "array");
	if (count($res_check) < 30)
		continue;


	// Check if the user is paid for this referral in last 30 days
	$month_ago = strtotime($today . "-1 month");
	$sql_check = "SELECT * FROM paymentlog
					WHERE
						paid_userid={$userid} AND
						refered_userid={$referred_userid}
					WHERE
						createdon>='{$month_ago}' AND
						pay_type=2'
					ORDER BY createdon DESC";
	$res_check = getXbyY($sql_check, "array");
	if (count($res_check) > 0)
		continue;				// Already paid in last 30 days

	$refer_item['cost'] = 50;
	$refer_item['referredtousername'] = getUserDetail($refer_item['referred_userid'], 'username');

	array_push($total_items, $refer_item);
}


// Service tip
$sqlReferral = "SELECT
					a.*,
					b.username AS drivername
				FROM
					service_tip a,
					users b
				WHERE
					a.isactive = 1 AND
					a.driverid=b.userid";
$resReferral = getXbyY($sqlReferral, "array");
for ($i = 0; $i < count($resReferral); $i++) {
	$refer_item = $resReferral[$i];

	$refer_item['pay_type'] = 4;			// pay for tip
	$refer_item['cost'] = $refer_item['amount'];

	array_push($total_items, $refer_item);
}











$rowsTOTAL = count($total_items);

$pagename = "payments.php";

$per = 20;

$totalPAGES = ceil($rowsTOTAL / $per);
$startLIMIT = ($pageNO - 1) * $per;
$endLIMIT   = $per;


$res = array();
$index = $startLIMIT;
while (true) {
	if ($index >= count($total_items) - 1 || $index > $startLIMIT + $endLIMIT)
		break;

	array_push($res, $total_items[$index]);
	$index++;
}


$row = count($res);


// include html/header/footer
include ("../include/header_inner.php");
include ("html/payments.php");
include ("../include/footer.php");
?>