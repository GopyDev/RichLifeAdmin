<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<div class="page-title-box">
						<ol class="breadcrumb pull-right">
							<li><a href="payments.php?pageNO=<?php echo $pageNO;?>">Back</a></li>
						</ol>
						<a href="paymentDetail.php?pay_type=<?php echo($pay_type); ?>&id=<?php
								if ($pay_type == 1)
									echo (base64_encode($serviceid));
								else if ($pay_type == 2)
									echo (base64_encode($referid));
								else if ($pay_type == 3)
									echo (base64_encode($referid));
								else if ($pay_type == 4)
									echo (base64_encode($tipid));
						?>&pageNO=<?php echo base64_encode($pageNO); ?>"><h4 class="page-title">Payment Details(Click to refresh)</h4></a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
				<div class="card-box">

				<form class="form-horizontal" name="pay_form" id="pay_form" method="post" action="paymentDetail.php" enctype="multipart/form-data" >

					<input type="hidden" name="pay_type" value="<?php echo($pay_type); ?>">
					<input type="hidden" name="item_id" value="<?php
						if ($pay_type == 1)
							echo ($serviceid);
						else if ($pay_type == 2)
							echo ($referid);
						else if ($pay_type == 3)
							echo ($referid);
						else if ($pay_type == 4)
							echo ($tipid);
					?>">

					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Payment reason</label>
						<div class="col-sm-9">
							<label for="inputEmail3" class="control-label">
							<?php
								if ($pay_type == 1) {
									echo ("<a target=\"_new\" href=\"serviceDetail.php?id=");
									echo (base64_encode($service_info['serviceid']));
									echo ("&pageNO=");
									echo (base64_encode(1));
									echo ("\">Pay for service</a>");
								} else if ($pay_type == 2) {
									echo("Referred to user");
								} else if ($pay_type == 3) {
									echo("Referred to driver");
								} else if ($pay_type == 4) {
									echo("Service tip");
								}
							?></label>
						</div>
					</div>

					<?php
						if ($pay_type == 1 || $pay_type == 4) {
					?>

					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Driver</label>
						<div class="col-sm-9">
							<label for="inputEmail3" class="control-label" style="<?php
								$drivername = getUserDetail($service_info['driverid'], 'username');
								if ($drivername == "") {
									echo "color:#A0A0A0";
								}
							?>"><?php
								if ($drivername == "") {
									echo "No driver yet";
								} else {
									echo $drivername;
								}
							?></label>
						</div>
					</div>

					<?php
					} else {
					?>

					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">User</label>
						<div class="col-sm-9">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php
								$errands_left = userWeeklyErrandLeft($service_info['userid']);
								if ($errands_left > 0)
									echo(getUserDetail($service_info['userid'], 'username') . " (Subscriber)");
								else
									echo(getUserDetail($service_info['userid'], 'username') . " (Nonsubscriber)");
							?></label>
						</div>
					</div>

					<?php
					}
					?>


					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Cost to pay</label>
						<div class="col-sm-9">
							<label for="inputEmail3" class="control-label"><?php echo($service_info['cost']); ?></label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9">
							<button type="submit"  name="submit" id="submit" class="btn btn-default">Confirm paid</button>
						</div>
					</div>
				</form>
				</div>
				</div>
			</div>
		</div> 
	</div>
</div>