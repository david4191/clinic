<?php

include('header.php');
include('dbcon.php');
include('doc-lab-nav.php');
?>
	<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Lab Report</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="doctor-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">lab report</li>
						</ol>
					</div>
				</div>
			</div>
	<div class="container home">
				
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">labouratory Reports</h3>							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-bordered table-striped">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
users.username='".$_SESSION['username']."' and appoint.status='pending'");
									while($data = mysqli_fetch_assoc($getPateintData)){
										
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
												<div class="custom-control custom-checkbox">
													<input class="custom-control-input" type="checkbox" id="select-all">
													<label class="custom-control-label" for="select-all"></label>
												</div>
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
										<tr>
											<td>
											
											</td>
											<td><?php echo $data['id']; ?></td>
											<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['presno']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											<td><?php echo $data['day']; ?>/<?php echo $data['month']; ?>/<?php echo $data['year']; ?></td>
											<td>
												<?php
												$acctstats= mysqli_query($conn,"select * from patient where acct_stat = 'private'");
												if($acctstats->num_rows !== 0){
													echo'<span class="badge badge-warning">Private</span>';
												}else{
													echo'<span class="badge badge-success">DSS STAFF</span>';
												}
										
										
										?>
												
											</td>
											<td>
												
												<a type="button" class="badge badge-success" style="border: thin; color: white;" href="patient-report.php?id=<?php echo $data["id"]; ?>"><span class="ti-pencil-alt"></span> view report</a></td>
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
					<!-- /Widget Item -->
				</div>
		
			</div>
			
	<br><br>
<?php
include('footer.php');
?>