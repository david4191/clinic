<?php

include('header.php');
include('dbcon.php');
include('doc-nav.php');


// retriving exisiting visits
$query ="SELECT * FROM pat_card where pharm !='issued'";
$result =mysqli_query($conn, $query);

//checking query error
if (!$result){
	
	die("retriving query error <br>".$query);
}


$total_rep=mysqli_num_rows($result);


// retriving exisiting visits
$query ="SELECT * FROM patient";
$result =mysqli_query($conn, $query);

//checking query error
if (!$result){
	
	die("retriving query error <br>".$query);
}


$total_pat=mysqli_num_rows($result);


// retriving exisiting visits
$query1 ="SELECT * FROM appoint where status='pending'";
$result1 = mysqli_query($conn, $query1);

//checking query error
if (!$result1){
	
	die("retriving query error <br>".$query1);
}


$total_app=mysqli_num_rows($result1);
?>
<!-- Page Title -->
			<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Welcome</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="doctor-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- /Page Title -->
<!-- Main Content -->
			<div class="container home">
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-4">
						<div class="widget-area proclinic-box-shadow color-red">
							<div class="widget-left">
								<span class="ti-user"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Patients</h4>
								<span class="numeric color-red"><?php echo  $total_app;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> Monthly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-4">
						<div class="widget-area proclinic-box-shadow color-green">
							<div class="widget-left">
								<span class="ti-bar-chart"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Appointments</h4>
								<span class="numeric color-green"><?php echo  $total_app;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-down"></span> Monthly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-4">
						<div class="widget-area proclinic-box-shadow color-yellow">
							<div class="widget-left">
								<span class="ti-book"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Reports</h4>
								<span class="numeric color-yellow"><?php echo  $total_rep;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> Monthly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Patients List</h3>							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, appoint.apt_stats as stat ,appoint.pharm_stats as stats,users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
users.username='".$_SESSION['username']."' and appoint.status='pending'");
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Account Status</th>
											<th>Drug Status</th>
											<th>Payment Status</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										<?php 	while($data = mysqli_fetch_assoc($getPateintData)){
										
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
											<?php
											
											
											$pharmstatsChecked = mysqli_query($conn,"select appoint.pat_id, appoint.status, appoint.pharm_stats as statsd,pat_card.presno_id, pat_card.pharm  from appoint,pat_card where appoint.pharm_stats='Issued' and appoint.pat_id = pat_card.presno_id");
											$data['stats'];
											if($pharmstatsChecked->num_rows !== 0 && $data['stats']){
											echo "Drugs " .$data['stats'];
												
											}else{
												
												echo " ";
											}
											?>
											
											</td>
											<td>
											<?php
	 echo $data['stat'];
	
	?>
											
											</td>
											<td>
												
												<a type="button" class="badge badge-success" style="border: thin; color: white;" href="patient-report.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> view report</a></td>
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
		

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="	fas fa-laptop-medical"></i> Appointments</h3>
							<div class="table-responsive">
								<table class="table table-borderless">
										<?php
									$getPateintBooking = mysqli_query($conn,"SELECT patient.id , patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
users.username='".$_SESSION['username']."' and appoint.status='pending' order by appoint.time");
										
									
									?>
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Doctor</th>
											<th>Check-Up</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
											<th>Confirm</th>
										</tr>
									</thead>
									<tbody>
										<?php while($datas = mysqli_fetch_assoc($getPateintBooking)){
									 ?>
										<tr>
											<td><?php echo $datas['pname']; ?></td>
											<td><?php echo $datas['dname']; ?></td>
											<td><?php echo $datas['checks']; ?></td>
											<td><?php echo $datas['apdate']; ?></td>
											<td><?php echo $datas['aptime']; ?></td>
											<td>
												<?php echo $datas['apstats']; ?>
												
												
											</td>
											<td>
											
												<form id="myForm" action="approve.php" method="post">	
													<input type="hidden" name="edit_name" value="<?php echo $datas['id']; ?>" >
													<input type="hidden" name="status" value="completed">
													<button name="edit_btn" type="submit" style="border: thin; color: white;"  class="badge badge-info btn-block" onClick="refreshPage()">Confirm</button>
												</form>
												<script>
													
													function refreshPage(){
    window.location.reload();
} 
													
													
												$('#myForm').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});
									</script>
												<form method="post" action="approve1.php" id="myForm">	
													<input type="hidden" name="edit_names" value="<?php echo $datas['id']; ?>" >
													<input type="hidden" name="status" value="cancelled">
													<button name="edit_btns" type="submit" style="border: thin; color: white;"  class="badge badge-danger btn-block" onClick="refreshPage()"> Cancel</button>
												</form>
												
											</td>
										</tr>
										
									</tbody>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>

				<div class="row">
					<!-- Widget Item -->
					<div class="col-sm-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Lab Report</h3>
							<table class="table table-bordered">
									
									<tbody>
										<tr>
											<td></td>
											<td></td>
											<td>
												<span class="badge badge-success"></span>
											</td>
										</tr>
										
									</tbody>
								</table>
							
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-6">
						<div class="widget-area-2 progress-status proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Pharmacy Report</h3>
							<div class="table-responsive">
									<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"select patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pharm_request.id as phamid, pharm_request.patient_id as pharm_patid, pharm_request.docz as pharmdocz, pharm_request.presreq as pharmpres, pharm_request.docz_rep as pharmdoczrep, pharm_request.createdby as pharmeds from patient,appoint,users,pharm_request
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id AND
patient.id = pharm_request.patient_id and
users.username='".$_SESSION['username']."' and appoint.status='pending'");
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient Name</th>
											<th>Hospital No.</th>
											<th>Pharmacist Note </th>
											
										</tr>
									</thead>
									<tbody>
										<?php 	while($data = mysqli_fetch_assoc($getPateintData)){
										
								?>
										<tr>
											<td>
											
											</td>
<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											<td>
												<?php echo $data['pharmpres']; ?>
												
											</td>
											
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
							
							</div>

						</div>
					</div>
					<!-- /Widget Item -->

				</div>
				
				
				
				
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Medical Records
							
								
							
							</h3>
							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, patient.createdby ,appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
 users.username='".$_SESSION['username']."' and appoint.status='pending'");
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient ID</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Reg. Date</th>
											<th>Account Status</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										<?php while($data = mysqli_fetch_assoc($getPateintData)){
										
									?>
										<tr>
											<td>
											
											</td>
											<td><?php echo $data['patid']; ?></td>
											<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['presno']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											<td><?php echo $data['day']; ?>/<?php echo $data['month']; ?>/<?php echo $data['year']; ?></td>
											<td>
												<?php echo $data['pacct']; ?>
												
											</td>
											<td>
												
												<a type="button" class="badge badge-success" style="border: thin; color: white;" href="doctor-patient-report.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> view report</a></td>
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
				
				
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-notes-medical"></i> Nurse Report</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateint = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1,nurse_report.id as nrid,nurse_report.pat_id as pat_id, nurse_report.doc_id as doc_id, nurse_report.nurse as nurse,nurse_report.docrep as docrep,nurse_report.date as nrdate from patient,appoint,users,pat_card,nurse_report

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id and appoint.status='pending'
group by nurse_report.pat_id desc");
								
	
									
									?>
									
									<thead>
										<tr>
											<th>Date</th>
											<th>Patient Name</th>
											<th>Hospital No.:</th>
											<th>Nurse Remark</th>
											<th>Your Reply</th>
										</tr>
									</thead>
									<?php
		
												
	while($dast = mysqli_fetch_assoc($getPateint)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><?php echo $dast['nrdate']; ?></td>
											<td><?php echo $dast['pname']; ?></td>
											<td><?php echo $dast['hosno']; ?></td>
											<td><?php echo $dast['nurse']; ?></td>
											<td><?php echo $dast['docrep']; ?></td>

										</tr>
										
										</tbody>
										
									<?php } ?>
								</table>
								
								
							</div>
						
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>	
	
	
		
			</div>
			<!-- /Main Content -->
			


<?php
include('footer.php');
?>