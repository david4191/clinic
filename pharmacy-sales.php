<?php

include('header.php');
include('pharm-acct-nav.php');
include('dbcon.php');

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

?>

<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Welcome</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="pharmacy-dashboard.php">
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

pat_card.presno_id = patient.id and pat_card.pharm !='issued' and
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
											
											
											
										echo $data['istats'];
											
											?>
											
											</td>
											<td>
												
												<a type="button" class="badge badge-warning" style="border: thin; color: white;" href="pharmacy-patient-payment.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> Generate Payment Slip</a></td>
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