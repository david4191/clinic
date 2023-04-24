<?php

include('header.php');
include('dbcon.php');
include('doc-phrm-nav.php');
?>
	<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Pharmacy Report</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="doctor-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">pharmacy section</li>
						</ol>
					</div>
				</div>
			</div>
	<div class="container home">
				
		<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Pharmacy Report</h3>							
							<div class="table-responsive mb-3">
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
											<th>Doctor's Note</th>
											<th>Pharmacist Response</th>
											<th>Doctor's Note</th>
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
											<td><?php echo $data['pharmdocz']; ?></td>
											<td>
												<?php echo $data['pharmpres']; ?>
												
											</td>
											<td>
												<?php echo $data['pharmdoczrep']; ?>
												
											</td>
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
				
			</div>
			
	<br><br>
<?php
include('footer.php');
?>