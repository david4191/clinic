<?php

include('header.php');
include('dbcon.php');
include('doc-app-nav.php');


?>
	<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Appointments</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="doctor-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Appointment block</li>
						</ol>
					</div>
				</div>
			</div>
	<div class="container home">
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
	
			</div>
			
	<br><br>
<?php
include('footer.php');
?>