<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
	<div class="content">
		<div class="container">
		  <!-- Page-Title -->
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<div class="page-title-box">
						<!--<ol class="breadcrumb pull-right">
							<li><a href="user-add.html">Add</a></li>
						</ol>-->
						<h4 class="page-title">Payments</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
									  <th>#</th>
									  <th>Username</th>
									  <th>Payment type</th>
									  <th>Cost</th>
									  <th>Action</th>
									</tr>
								</thead>
								<tbody>
								  <?php for($i=0; $i < $row; $i++) { ?>
								  <tr>
								  	<th scope="row"><?php echo $i + 1 + ($pageNO - 1) * $per; ?></th>
									<td><?php
										if ($res[$i]['pay_type'] == 1 || $res[$i]['pay_type'] == 4)
											echo $res[$i]['drivername'] . "(Driver)";
										else
											echo $res[$i]['username'] . "(User)";
									?></td>
									<td><a href="serviceDetail.php?id=<?php echo base64_encode($res[$i]['serviceid']);?>&pageNO=<?php echo base64_encode($pageNO); ?>"><?php
										if ($res[$i]['pay_type'] == 1)
											echo "Pay for service";
										else if ($res[$i]['pay_type'] == 2)
											echo "Referred to user";
										else if ($res[$i]['pay_type'] == 3)
											echo "Referred to driver";
										else if ($res[$i]['pay_type'] == 4)
											echo "Service tip";
									?></a></td>
									<td><?php echo($res[$i]['cost']); ?></td>
									<td><a href="paymentDetail.php?pay_type=<?php echo($res[$i]['pay_type']); ?>
										&id=<?php
											if ($res[$i]['pay_type'] == 1)
												echo base64_encode($res[$i]['serviceid']);
											else if ($res[$i]['pay_type'] == 2)
												echo base64_encode($res[$i]['referid']);
											else if ($res[$i]['pay_type'] == 3)
												echo base64_encode($res[$i]['referid']);
											else if ($res[$i]['pay_type'] == 4)
												echo base64_encode($res[$i]['service_tip_id']);
										?>&pageNO=<?php
											echo base64_encode($pageNO);
										?>" class="btn btn-success">Details</a></td>
								  </tr>
								  <?php }?>
								</tbody>
							</table>
							<?php if($row>0){?>
								<div class="text-center">	 
									<div class="paging-nav">
										<?php pagination($pageNO, $totalPAGES, $pagename, "") ?>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>