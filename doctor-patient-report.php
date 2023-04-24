<?php

include('header.php');
include('dbcon.php');
include('doc-pat-nav.php');


?>

<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Patient Medical Record</h3>
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
							<h3 class="widget-title"><i class="fas fa-laptop-medical"></i> Records</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
							<table class="table table-borderless">
										<tbody>
												<tr>
													<td>
													
													<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fas fa-prescription-bottle-alt"></i> Prescriptions</button>
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
													
														<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target=".bd-example-modal-lg1"> <i class="fas fa-diagnoses"></i> Consultations</button>
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
													<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-example-modal-lg2"> <i class="fas fa-diagnoses"></i> Vitals</button>
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
													
													<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target=".bd-example-modal-lg3"> <i class="fas fa-band-aid"></i> Nurse's Report</button>
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
													<td></td>
													
												</tr>
									
											<tr>
													<td>
													
													<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target=".bd-example-modal-lg20"> <i class="fas fa-prescription-bottle-alt"></i> Complaints | Allergies</button>
													<div class="modal fade bd-example-modal-lg20" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel20" aria-hidden="true">
		
									<div style="max-width: 60%" class="modal-dialog modal-lg20">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel20">Complaints | Allergies
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
									$ceckded = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,compl_allergy.pat_id as ca_id,compl_allergy.hosno as ca_hosno,compl_allergy.date as ca_date,substr(compl_allergy.cum,1,55) as ca_cum,substr(compl_allergy.al,1,55) as ca_al,compl_allergy.id as caid from patient,appoint,users,compl_allergy

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
patient.id = compl_allergy.pat_id

 and patient.id='$name1' order by compl_allergy.pat_id desc");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Complaints</th>
											<th>Allergies</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									<?php
		
												
	while($dasir = mysqli_fetch_assoc($ceckded)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td style="text-align: justify">
			<?php echo $dasir['ca_cum']; ?>
			</td>
											<td>
												<?php echo $dasir['ca_al']; ?>
											</td>
											<td>
												<?php echo $dasir['ca_date']; ?>
											</td>
											<td>
											<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="complaint-allergies.php?caid=<?php echo $dasir["caid"]; ?>"><span class="ti-pencil-alt"></span> view allergies |complaints</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									<?php } ?>
								</table>
							
											</div>
		
										</div>
									</div>
								</div>
													</td>
													<td>
													
														<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target=".bd-example-modal-lg21"> <i class="fas fa-diagnoses"></i> Past medical & Surgical Records</button>
													<div class="modal fade bd-example-modal-lg21" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel21" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel21">Past medical & Surgical Records
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
									$ceckqw = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,surgreg.pat_id as sur_id,surgreg.hosno as sur_hosno,surgreg.date as sur_date,substr(surgreg.rep,1,55) as rep,surgreg.id as suridd   from patient,appoint,users,surgreg

WHERE
appoint.pat_id = patient.id 
AND patient.id = surgreg.pat_id and
users.id = appoint.doctor_id

 and patient.id='$name1'");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Report</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									<?php
		if(mysqli_num_rows($ceckqw) >0)
											{
												
	while($dass = mysqli_fetch_assoc($ceckqw)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
											
									
											<td style="text-align: justify"><?php echo $dass['rep']; ?>
												
				</td>
											<td>
												<?php echo $dass['sur_date']; ?>
											</td>
											
											<td>
												<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="surgical-medical-records.php?suridd=<?php echo $dass["suridd"]; ?>"><span class="ti-pencil-alt"></span> view Past medical & Surgical Records</a>
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
													<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-example-modal-lg22"> <i class="fas fa-diagnoses"></i> Family History</button>
													<div class="modal fade bd-example-modal-lg22" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel22" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel22"> Family History
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
									$ceck122d = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,substr(fam_history.fams,1,55) as fams,fam_history.pat_id as fm_id,fam_history.hosno as fm_hosno,fam_history.date as fm_date,fam_history.id as famidd from patient,appoint,users,fam_history

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and patient.id = fam_history.pat_id
 and patient.id='$name2'");
								
	
									
									?>
									<thead>
										<tr>
											<th>Report</th>
											<th>Date</th>
											<th>View Family History</th>
											
										</tr>
									</thead>
									<?php
		
												
	while($dasend = mysqli_fetch_array($ceck122d)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									<td><?php echo $dasend['fams']; ?></td>
											<td><?php echo $dasend['fm_date']; ?></td>
											<td>
											
											
											<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="family-history.php?famidd=<?php echo $dasend["famidd"]; ?>"><span class="ti-pencil-alt"></span> view family history</a>
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
													
													<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target=".bd-example-modal-lg23"> <i class="fas fa-band-aid"></i> Obst. | Gynae Hx</button>
													<div class="modal fade bd-example-modal-lg23" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel23" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel23">Obst. | Gynae Hx.
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
									$ceck139 = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,obst_gynae.pat_id as ogh_id,obst_gynae.hosno as ogh_hosno,obst_gynae.date as ogh_date,substr(obst_gynae.obst,1,55) as obst,obst_gynae.id as oghid from patient,appoint,users,obst_gynae

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and patient.id = obst_gynae.pat_id 
 and patient.id='$name1'");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Report</th>
											<th>Date</th>
											
											<th>View</th>
										</tr>
										</thead>
									<?php
		if(mysqli_num_rows($ceck139) >0)
											{
												
	while($das139 = mysqli_fetch_assoc($ceck139)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
											
									
											<td style="text-align: justify"><?php echo $das139['obst']; ?>
												
				</td>
											<td>
												<?php echo $das139['ogh_date']; ?>
											</td>
											
											<td>
												<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="obstx-gynae.php?oghid=<?php echo $das139["oghid"]; ?>"><span class="ti-pencil-alt"></span> View Obst. | Gynae Hx</a>
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
													
													
													</td>
													
												</tr>
									
											<tr>
													<td>
													
													<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target=".bd-example-modal-lg20"> <i class="fas fa-prescription-bottle-alt"></i> Social History</button>
													<div class="modal fade bd-example-modal-lg20" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel20" aria-hidden="true">
		
									<div style="max-width: 60%" class="modal-dialog modal-lg20">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel20">Complaints | Allergies
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
									$ceckded = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,compl_allergy.pat_id as ca_id,compl_allergy.hosno as ca_hosno,compl_allergy.date as ca_date,substr(compl_allergy.cum,1,55) as ca_cum,substr(compl_allergy.al,1,55) as ca_al,compl_allergy.id as caid from patient,appoint,users,compl_allergy

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
patient.id = compl_allergy.pat_id

 and patient.id='$name1' order by compl_allergy.pat_id desc");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Complaints</th>
											<th>Allergies</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									<?php
		
												
	while($dasir = mysqli_fetch_assoc($ceckded)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td style="text-align: justify">
			<?php echo $dasir['ca_cum']; ?>
			</td>
											<td>
												<?php echo $dasir['ca_al']; ?>
											</td>
											<td>
												<?php echo $dasir['ca_date']; ?>
											</td>
											<td>
											<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="complaint-allergies.php?caid=<?php echo $dasir["caid"]; ?>"><span class="ti-pencil-alt"></span> view allergies |complaints</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									<?php } ?>
								</table>
							
											</div>
		
										</div>
									</div>
								</div>
													</td>
													<td>
													
														<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target=".bd-example-modal-lg21"> <i class="fas fa-diagnoses"></i> Drug History</button>
													<div class="modal fade bd-example-modal-lg21" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel21" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel21">Past medical & Surgical Records
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
									$ceckqw = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,surgreg.pat_id as sur_id,surgreg.hosno as sur_hosno,surgreg.date as sur_date,substr(surgreg.rep,1,55) as rep,surgreg.id as suridd   from patient,appoint,users,surgreg

WHERE
appoint.pat_id = patient.id 
AND patient.id = surgreg.pat_id and
users.id = appoint.doctor_id

 and patient.id='$name1'");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Report</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									<?php
		if(mysqli_num_rows($ceckqw) >0)
											{
												
	while($dass = mysqli_fetch_assoc($ceckqw)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
											
									
											<td style="text-align: justify"><?php echo $dass['rep']; ?>
												
				</td>
											<td>
												<?php echo $dass['sur_date']; ?>
											</td>
											
											<td>
												<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="surgical-medical-records.php?suridd=<?php echo $dass["suridd"]; ?>"><span class="ti-pencil-alt"></span> view Past medical & Surgical Records</a>
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
													<?php
		$Compileddsss = mysqli_query($conn,"SELECT * from patient WHERE gender='male' and id='$name1'");
		if($Compileddsss->num_rows !== 0)
		{
		 
	$datty= date("y-m-d") . "\n";
	$pname = $data['pname'];; 
	$gender = $data['gender'];
	 $pdob= $data['pdob']; 
	$pressno = $data['presno'];; 
	$hosnno = $data['hosno'];
	 $pacct= $data['pacct']; 
			
						$name1 = $_GET['patid'];
							$Compileddss = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp, testro.id as test_id,testro.pat_id as test_patid,testro.doc_id as test_docid, testro.date as test_date, substr(testro.test,1,55) as test_test from patient,users,testro

WHERE

users.id = testro.doc_id and testro.pat_id = patient.id
 and patient.id='.$name1.' "); 
		
			echo '
			
			
									<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-example-modal-lg261">Testrointestinal System </button>
									<div class="modal fade bd-example-modal-lg261" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel261" aria-hidden="true">
		
									<div style="max-width: 60%" class="modal-dialog modal-lg261">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel261">
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
										<table id="tableId" class="table table-striped">
									
									<tbody>
										<tr>
									<td><b>Name: </b> '.$pname.' </td><td> <b>Gender: </b>'.$gender.'</td>
											<td><b>Date of Birth:</b>  '.$pdob.'</td>
										</tr>
										<tr>
											<td><b>Pres No.: </b>'.$pressno.'</td><td><b>Hospital No.: </b>'.$hosnno.'</td>
											<td><b>Account Status:</b>	'.$pacct.'&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
												<br><br>
												
													<table id="tableId" class="table table-borderless">
														<form method="post">
									<thead>
										<tr>
											<th>Report</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									
									
									<tbody>
										
			
			';
	
								while($dassb = mysqli_fetch_array($Compileddss)) 
										{
										$testd = $dassb['test_test'];	
		$testid = $dassb['test_id'];
										
			
		echo '
		<tr>
											
									
											<td style="text-align: justify">'.$testd.'	</td>
											<td>
												
											</td>
											
											<td>
												<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="Testrointestinal.php?test_id=<?php echo '.$testid.' ?>"><span class="ti-pencil-alt"></span> view Testrointestinal System Records</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									
						
									
		
		
		';
									 } 
									echo'
											</table>
							
											</div>
		
										</div>
									</div>
								</div>
									
									
									';
		
		}
		else{
			
		}
		?>
											</td>
													<td>
													
													
													</td>
													
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
			


<br><br>
<?php
include('footer.php');
?>