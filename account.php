<?php

include('header.php');
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 90000)) {
    // request 30 minates ago
    session_destroy();
    session_unset();
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time


if($_SESSION['username'] == null ) {
	session_destroy();
	header('location: index.php');
}

include('acct-nav.php');
include('dbcon.php');

// retriving exisiting visits
$query ="SELECT * FROM drugstore";
$result =mysqli_query($conn, $query);

//checking query error
if (!$result){
	
	die("retriving query error <br>".$query);
}


$total_rep=mysqli_num_rows($result);




?>

<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Welcome</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="account.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>




<div class="container home">
			<div class="row">
					<!-- Widget Item -->
					<div class="col-md-6">
						<div class="widget-area proclinic-box-shadow color-red">
							<div class="widget-left">
								<span class="ti-user"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Drugs</h4>
								<span class="numeric color-red"><?php echo  $total_rep;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> In-Store</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-6">
						<div class="widget-area proclinic-box-shadow color-green">
							<div class="widget-left">
								<span class="ti-bar-chart"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Total Drugs Sold</h4>
								<span class="numeric color-green"><?php $checkAmount = mysqli_query($conn, "SELECT sum(amount45) as amt FROM invoice");
									while($row= mysqli_fetch_assoc($checkAmount)){
									echo $row['amt'];	
										
									}
									 ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-down"></span> Monthly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				
				</div>
		
	
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-credit-card"></i> Payment Request
							
							
							</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1 from patient,appoint,users,pat_card
WHERE

pat_card.presno_id = patient.id and pat_card.pharm ='issued' and
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
appoint.status='pending' group by patient.hosno");
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Account Status</th>
											<th>Confirm Payment</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										while($data = mysqli_fetch_assoc($getPateintData)){
										
									?>
										<tr>
											<td>
											
											</td>
											<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['presno']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											
											<td>
												<?php echo $data['pacct']; ?>
												
											</td>
											<td>
												
												<a type="button" class="badge badge-warning" style="border: thin; color: white;" href="account-patient-payment.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> Generate Payment Slip</a></td>
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
								<!--Export links-->
								
						
								
							</div>
						
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>	
		<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fab fa-cc-visa"></i> Payments
							
							
							</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1,invoice.pname as ipname, invoice.hosno as ihosno, invoice.status as istats from patient,appoint,users,pat_card,invoice
WHERE

pat_card.presno_id = patient.id and pat_card.pharm ='issued' and
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and invoice.hosno = pat_card.hosno_id and
appoint.status='pending'");
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Reg. Date</th>
											<th>Account Status</th>
											<th>Payment Status</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										while($data = mysqli_fetch_assoc($getPateintData)){
										
									?>
										<tr>
											<td>
											
											</td>
											<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['presno']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											<td><?php echo $data['day']; ?>/<?php echo $data['month']; ?>/<?php echo $data['year']; ?></td>
											<td>
												<?php echo $data['pacct']; ?>
												
											</td>
											<td>
											<?php
											
											$pharmstatsChecked = mysqli_query($conn,"select appoint.pat_id, appoint.status, appoint.pharm_stats as statsd,pat_card.presno_id, pat_card.pharm,invoice.pname as ipname, invoice.hosno as ihosno, invoice.status as istats  from appoint,pat_card,invoice where appoint.pharm_stats='Issued' and invoice.hosno = pat_card.hosno_id and appoint.pat_id = pat_card.presno_id");
											$data['istats'];
											if($pharmstatsChecked->num_rows !== 0 && $data['istats']){
											echo $data['istats'];
												
											}else{
												
												echo "Pending ";
											}		
										
											?>
											
											</td>
											<td>
												
												<a type="button" class="badge badge-warning" style="border: thin; color: white;" href="account-patient-payment-preview.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> Generate Payment Slip</a></td>
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
								<!--Export links-->
								
						
								
							</div>
						
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>	
	

			</div>



<?php

include('footer.php');
?>