<?php

include('header.php');
include('dbcon.php');
include('doc-nav.php');
?>
	<div class="container home">
				<?php
									$name1 = $_GET['id'];
									$getPateintData = mysqli_query($conn,"SELECT patient.id as id , patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc,day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year,pat_card.id as pid,pat_card.presno_id as patpresno, pat_card.hosno_id as pathosno, pat_card.las_vis as lasvis,pat_card.pres as pres,pat_card.docz as docz,appoint.id, appoint.status as checks , users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,pat_card,users,appoint
WHERE
pat_card.presno_id = patient.id 
AND
users.id = pat_card.doc_id
and 
pat_card.appt = appoint.id
 and
 users.username='".$_SESSION['username']."' and appoint.status='pending' and patient.id='$name1'");
									while($data = mysqli_fetch_assoc($getPateintData)){
										
									
									?>
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Details</h3>							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b><?php echo $data['pname']; ?> </td><td> <b>Gender: </b><?php echo $data['gender']; ?></td>
											<td><b>Date of Birth:</b> <?php echo $data['pdob']; ?></td><td><b>Age:</b> <?php echo $data['']; ?></td>
											
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
							<h3 class="widget-title">Last Consultation Report</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<form>
									<p>Please note that you can't edit these details.</p>
									
									<div class="form-group">
										<label for="exampleFormControlTextarea1">Consultation report</label>
										<textarea id="myTextarea" class="form-control"  rows="4" readonly><?php echo $data['docz']; ?></textarea>
									</div>
									<div class="form-group">
										<label for="exampleFormControlTextarea1">Prescription report</label>
										<textarea id="myTextarea1" class="form-control"  rows="4" readonly><?php echo $data['pres']; ?></textarea>
									</div>
									
								</form>
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
							<h3 class="widget-title"></h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table class="table table-borderless">
										<tbody>
												<tr>
													<td><a class="btn btn-primary btn-xs" href="patient-prescription.php?id=<?php echo $data["id"]; ?>" target="_blank">Prescriptions</a></td>
													<td><a class="btn btn-warning btn-xs" href="patient-consultation.php?id=<?php echo $data["id"]; ?>" target="_blank">Consultations</a></td>
													<td><a class="btn btn-info btn-xs" href="patient-vital.php?id=<?php echo $data["id"]; ?>" target="_blank">Vital Signs</a></td>
													<td><a class="btn btn-success btn-xs" href="patient-request.php?id=<?php echo $data["id"]; ?>" target="_blank">Pres. Request</a></td>
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
			


	<br><br>
<?php
include('footer.php');
?>