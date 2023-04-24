<?php

include('header.php');
include('medic-pat-nav.php');
include('dbcon.php');


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

<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Patient Medical Record</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="medical-records-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>

<div class="container home">
				<?php
									$name1 = $_GET['patid'];
									$getPateintData = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
 and patient.id='$name1'");
									
	while($data = mysqli_fetch_assoc($getPateintData)){
										
									
									?>
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical-alt"></i> Patient Details</h3>							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b><?php echo $data['pname']; ?> </td><td> <b>Gender: </b><?php echo $data['gender']; ?></td>
											<td><b>Date of Birth:</b> <?php echo $data['pdob']; ?></td><td><b>Marital Status:</b> <?php echo $data['mstats']; ?></td>
											
										</tr>
										<tr>
											<td><b>Pres No.: </b><?php echo $data['presno']; ?></td><td><b>Hospital No.: </b><?php echo $data['hosno']; ?></td>
											<td><b>Account Status:</b>	<?php
												echo $data['pacct'];
										
												?>&nbsp;&nbsp;&nbsp;</td><td><b>Reg. Date: </b><?php echo $data['day']; ?>/<?php echo $data['month']; ?>/<?php echo $data['year']; ?></td>
											<td></td>
											<td>
											
												
											</td>
											
										</tr>
										<tr>
									<td><b>Address: </b><?php echo $data['paddress']; ?> </td><td> <b>Mobile: </b><?php echo $data['pnumb']; ?></td>
											<td><b>Email:</b> <?php echo $data['pmail']; ?></td><td><b>Occupation:</b> <?php echo $data['pocc']; ?></td>
											
										</tr>
										</tbody>
									
								</table>
								<!--Export links-->
							
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
		<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"></h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
							<table class="table table-borderless">
										<tbody>
												<tr>
													<td>
													
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fas fa-prescription-bottle-alt"></i> Prescriptions</button>
													<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel">All Prescriptions
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<table id="tableId" class="table table-striped">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b><?php echo $data['pname']; ?> </td><td> <b>Gender: </b><?php echo $data['gender']; ?></td>
											<td><b>Date of Birth:</b> <?php echo $data['pdob']; ?></td>
										</tr>
										<tr>
											<td><b>Pres No.: </b><?php echo $data['presno']; ?></td><td><b>Hospital No.: </b><?php echo $data['hosno']; ?></td>
											<td><b>Account Status:</b>	<?php
												echo $data['pacct'];
										
												?>&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
													<table id="tableId" class="table table-borderless table-striped">
									<?php
									$name1 = $_GET['patid'];
									$ceckd = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,substr(pat_card.pres,1,55) as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
 and patient.id='$name1'");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Prescription</th>
											<th>Date</th>
											<th>Doctor Assgn.</th>
											<th>View</th>
										</tr>
										</thead>
									<?php
		if(mysqli_num_rows($ceckd) >0)
											{
												
	while($dasi = mysqli_fetch_assoc($ceckd)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td style="text-align: justify">
			<?php echo $dasi['pcardpres']; ?>
			</td>
											<td>
												<?php echo $dasi['lagadis']; ?>
											</td>
											<td>
												<?php echo $dasi['uname']; ?>
											</td>
											<td>
											<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="prescriptions.php?pacarid=<?php echo $dasi["pacarid"]; ?>"><span class="ti-pencil-alt"></span> view prescription</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									<?php }} ?>
								</table>
							
											</div>
		
										</div>
									</div>
								</div>
													</td>
													<td>
													
														<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg1"> <i class="fas fa-diagnoses"></i> Consultations</button>
													<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel1">All Consultations
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
													<table id="tableId" class="table table-striped">
									
									<tbody>
										<tr>
									<td><b>Name: </b><?php echo $data['pname']; ?> </td><td> <b>Gender: </b><?php echo $data['gender']; ?></td>
											<td><b>Date of Birth:</b> <?php echo $data['pdob']; ?></td>
										</tr>
										<tr>
											<td><b>Pres No.: </b><?php echo $data['presno']; ?></td><td><b>Hospital No.: </b><?php echo $data['hosno']; ?></td>
											<td><b>Account Status:</b>	<?php
												echo $data['pacct'];
										
												?>&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
												<br><br>
												<table id="tableId" class="table table-striped">
										<?php
		$name1 = $_GET['patid'];
									$getPateintDatad = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.allergies as alley, pat_card.complain as complain from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
and
users.username='".$_SESSION['username']."' and patient.id='$name1'");
		
		
	while($dart = mysqli_fetch_assoc($getPateintDatad)){	
		
		?>
								
									<tr>
										<th>Complaints</th>
										<th>Allergies</th>
										<th>Date</th>
												
												</tr>
									<tbody>
										<tr>
									<td><?php echo $dart['complain']; ?> </td>
											<td> <?php echo $dart['alley']; ?></td>
											<td> <?php echo $dart['lagadis']; ?></td>
										</tr>
										
										</tbody>
									<?php } ?>
								</table>
												
													<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$ceck = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,substr(pat_card.docz, 1, 55) as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
 and patient.id='$name1'");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Consultations</th>
											<th>Date</th>
											<th>Doctor Assgn.</th>
											<th>View</th>
										</tr>
										</thead>
									<?php
		if(mysqli_num_rows($ceck) >0)
											{
												
	while($das = mysqli_fetch_assoc($ceck)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
											
									
											<td style="text-align: justify"><?php echo $das['pcardocz']; ?>
												
				</td>
											<td>
												<?php echo $das['lagadis']; ?>
											</td>
											<td>
												<?php echo $das['uname']; ?>
											</td>
											<td>
												<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="consultations.php?pacarid=<?php echo $das["pacarid"]; ?>"><span class="ti-pencil-alt"></span> view consultation</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									<?php }} ?>
								</table>
							
											</div>
		
										</div>
									</div>
								</div>
													
													</td>
													<td>
													<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg2"> <i class="fas fa-diagnoses"></i> Vitals</button>
													<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel2">Patient Vital Signs
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
															<table id="tableId" class="table table-striped">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b><?php echo $data['pname']; ?> </td><td> <b>Gender: </b><?php echo $data['gender']; ?></td>
											<td><b>Date of Birth:</b> <?php echo $data['pdob']; ?></td>
										</tr>
										<tr>
											<td><b>Pres No.: </b><?php echo $data['presno']; ?></td><td><b>Hospital No.: </b><?php echo $data['hosno']; ?></td>
											<td><b>Account Status:</b>	<?php
												echo $data['pacct'];
										
												?>&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
												<br><br>
												
												
												
												
												<table id="tableId" class="table table-borderless">
									<?php
									$name2 = $_GET['patid'];
									$ceck122 = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp, pat_details.bp as bp1, pat_details.hb as hb1, pat_details.bt as bt1,pat_details.rp as rp1 from patient,appoint,users,pat_card,pat_details

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and pat_details.hosno = patient.hosno
and
pat_card.presno_id = patient.id
 and patient.id='$name2' group by patient.hosno");
								
	
									
									?>
									<thead>
										<tr>
											<th>Blood Pressure</th>
											<th>Heart Rate (Pulse)</th>
											<th>Body Temperature</th>
											<th>Respiratory Rate</th>
										</tr>
									</thead>
									<?php
		
												
	while($dasen = mysqli_fetch_array($ceck122)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									<td><?php echo $dasen['bp']; ?></td>
											<td><?php echo $dasen['hb']; ?></td>
											<td><?php echo $dasen['bt']; ?></td>
											<td>
												<?php echo $dasen['rp']; ?>
											
											</td>
										</tr>
										
										</tbody>
										
									<?php } ?>
								</table>
							
											</div>
		
										</div>
									</div>
								</div>
													
													
													
													
													</td>
													<td>
													
													<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg3"> <i class="fas fa-band-aid"></i> Nurse's Report</button>
													<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel3" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel3">Nurse Observation
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
													<table id="tableId" class="table table-striped">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b><?php echo $data['pname']; ?> </td><td> <b>Gender: </b><?php echo $data['gender']; ?></td>
											<td><b>Date of Birth:</b> <?php echo $data['pdob']; ?></td>
										</tr>
										<tr>
											<td><b>Pres No.: </b><?php echo $data['presno']; ?></td><td><b>Hospital No.: </b><?php echo $data['hosno']; ?></td>
											<td><b>Account Status:</b>	<?php
												echo $data['pacct'];
										
												?>&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
												<br><br>
													
												<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$ceck13 = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,substr(pat_card.docz, 1, 55) as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt, substr(pat_card.nurse, 1, 55) as nurs,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
 and patient.id='$name1' and pat_card.nurse !='' group by pat_card.id");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Nurse Remark</th>
											<th>Date</th>
											
											<th>View</th>
										</tr>
										</thead>
									<?php
		if(mysqli_num_rows($ceck13) >0)
											{
												
	while($das13 = mysqli_fetch_assoc($ceck13)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
											
									
											<td style="text-align: justify"><?php echo $das13['nurs']; ?>
												
				</td>
											<td>
												<?php echo $das13['lagadis']; ?>
											</td>
											
											<td>
												<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="nurses-reports.php?pacarid=<?php echo $das13["pacarid"]; ?>"><span class="ti-pencil-alt"></span> view nurses report</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									<?php }} ?>
								</table>
							
												
											</div>
		
										</div>
									</div>
								</div>
													
													
													
													</td>
													<td><a class="btn btn-secondary btn-xs"href="patient-special-request.php?id=<?php echo $data["id"]; ?>" target="_blank">Special Precaution</a></td>
													
												</tr>
									
										</tbody>
								</table>
								
								
								
								</div>
						
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
		
		
		<?php 
									}
									?>
		
	
	</div>
			<!-- /Main Content -->
			




<?php
include('footer.php');
?>