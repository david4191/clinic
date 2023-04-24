

<?php

include('header.php');
include('dbcon.php');
include('doc-nur-nav.php');


?>





<div class="container home">
		
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-notes-medical"></i> Nurse Report</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateint = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1,nurse_report.id as nrid,nurse_report.pat_id as pat_id, nurse_report.doc_id as doc_id, nurse_report.nurse as nurse,nurse_report.patcardid as patcardid,nurse_report.date as nrdate from patient,appoint,users,pat_card,nurse_report

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
											<td><?php echo $dast['nurse1']; ?></td>

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



<?php
include('footer.php');
?>