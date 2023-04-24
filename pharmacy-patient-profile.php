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
include('pharm-pat-nav.php');
include('dbcon.php');



// retriving exisiting visits
$query ="SELECT * FROM pat_card where nurse =''";
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
						<h3 class="block-title">Patient List</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="nurse-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Patient Record</li>
						</ol>
					</div>
				</div>
			</div>


<div class="container home">
				<?php
									$name1 = $_GET['patid'];
									$getPateintData = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
 and patient.id='$name1' group by patient.id");
								
	
												
	while($data = mysqli_fetch_assoc($getPateintData)){
		
	
									
									?>
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="	fas fa-id-card-alt"></i> Patient Details</h3>							
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
		
	
		<?php 
	}	
									?>
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical-alt"></i> Vitals</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateintDa = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
 and patient.id='$name1' group by patient.id");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Blood Pressure</th>
											<th>Heart Rate (Pulse)</th>
											<th>Body Temperature</th>
											<th>Respiratory Rate</th>
										</tr>
									</thead>
									<?php
		if(mysqli_num_rows($getPateintDa) >0)
											{
												
	while($das = mysqli_fetch_assoc($getPateintDa)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><?php echo $das['bp']; ?></td>
											<td><?php echo $das['hb']; ?></td>
											<td><?php echo $das['bt']; ?></td>
											<td>
												<?php echo $das['rp']; ?>
											
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
					<!-- /Widget Item -->
				</div>
		
	
			
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-notes-medical"></i> Doctor's Prescription</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateint = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1 from patient,appoint,users,pat_card
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id and pat_card.pharm =''
 and patient.id='$name1' ");
								
	
									
									?>
									
									<?php
		if(mysqli_num_rows($getPateint) >0)
											{
												
	while($dast = mysqli_fetch_array($getPateint)){
		
	
		
		?>
									
									
										<form method="post">
											<?php
		if(isset($_POST['updateIssue'])){
			$issed = $_POST['pharm'];
			$id = $_POST['id'];
			$pres = $_POST["presno_id"];
			$dataconfirm = mysqli_query($conn,"update pat_card set pharm='$issed' where id='$id'");
			$drugConfirm = mysqli_query($conn,"update appoint set pharm_stats='$issed' where pat_id='$pres'");
			echo"
				<script>
				window.location.href='pharmacy-dashboard.php';
				
				</script>
			
			"
				;
		}
		
		
		
		
		?><input type="hidden" name="id" value="<?php echo $dast['pacarid']; ?>">
		<input type="hidden" name="presno_id" value="<?php echo $dast['pcard_presno']; ?>">
										<div class="form-group">
										<label for="exampleFormControlTextarea1">Doctor's Prescription </label>
										<textarea name="docz" class="form-control"  rows="4" disabled><?php echo $dast['pcardpres']; ?></textarea>
									</div>
										
										<div class="form-group">
										<label for="exampleFormControlTextarea1">Date</label>
										<input type="text" value="<?php echo $dast['lagadis']; ?>" class="form-control" disabled>
											</div>
											<div class="form-group">
										<label for="exampleFormControlTextarea1">Drug Issued</label>
										<select style="width: 900px;" name="pharm" class="form-control">
												<option>- select -</option>
											<option value="issued">Yes</option>
											<option value="canceled">No</option>
												
												</select>
										<button style="position: relative;left: 900px; bottom: 39px;" type="submit" name="updateIssue" class="btn btn-danger">Update</button>	
									</div>
									</form>
										
									<?php }} ?>
								</table>
								
								
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
							<h3 class="widget-title"><i class="	fas fa-laptop-medical"></i> Pharmacy Request</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateintd = mysqli_query($conn,"SELECT patient.id as pid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1 from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
 and patient.id='$name1' group by patient.id ");
								
	
									
									?>
									
									<?php
		if(mysqli_num_rows($getPateintd) > 0)
											{
												
	while($dastd = mysqli_fetch_array($getPateintd)){
		
	
		
		?>
									
									<form method="post">
										<?php
					if(isset($_POST['regs'])){
						$patted = $_POST['patient_id'];
						$docket = $_POST['docz'];
						$pharm = $_POST['presreq'];
						$createdby = $_POST['createdby'];
						$sendNowInd = mysqli_query($conn,"insert into pharm_request (patient_id, docz,presreq,createdby) values ('$patted','$docket','$pharm','$createdby')");
						
											echo'
							<script>
							
Swal.fire("Successful!", "Sent  Successfully!", "success") ;

									
										</script>
							';
						
					}
		
		
		?>
		<input type="hidden" name="patient_id" value="<?php echo $dastd['pid']; ?>" class="form-control">
		<input type="hidden" name="docz" value="<?php echo $dastd['pcardocz']; ?>" class="form-control">
		<input type="hidden" name="createdby" value="<?= $_SESSION['username'] ?>" class="form-control">
			<div class="form-group">
			<label for="exampleFormControlTextarea1">Pharmacy Request</label>
			<textarea name="presreq" class="form-control"  rows="4"></textarea>
				</div>
										<div class="form-group">
										<button type="submit" name="regs" class="btn btn-success">Send Request</button>
										</div>
									</form>
										
									<?php }} ?>
								</table>
								
								
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
							<h3 class="widget-title"><i class="fas fa-prescription"></i> Prescription History</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateintDaz = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt, pat_card.pharm as pharm,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users,pat_card

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
pat_card.presno_id = patient.id
 and patient.id='$name1' ");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th><i class="fas fa-prescription"></i></th>
											<th>Drug</th>
											<th>Status</th>
											<th>Date</th>
										</tr>
									</thead>
									<?php
		if(mysqli_num_rows($getPateintDaz) >0)
											{
												
	while($dasz = mysqli_fetch_assoc($getPateintDaz)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><i class="fas fa-prescription"></i></td>
											<td><?php echo $dasz['pcardpres']; ?></td>
											<td><?php echo $dasz['pharm']; ?></td>
											<td>
												<?php echo $dasz['lagadis']; ?>
											
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
					<!-- /Widget Item -->
				</div>
		
	
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-comment-medical"></i> Replies</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateint = mysqli_query($conn,"SELECT patient.id as pid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year,pharm_request.id as pharmid,pharm_request.presreq as presreq,pharm_request.docz_rep as docz from patient,pharm_request

WHERE
pharm_request.patient_id = patient.id 

 and patient.id='$name1' ");
								
	
									
									?>
									
									<?php
		if(mysqli_num_rows($getPateint) >0)
											{
												
	while($dast = mysqli_fetch_array($getPateint)){
		
	
		
		?>
									
									
										
										<div class="form-group">
										<label for="exampleFormControlTextarea1">Your Request</label>
										<textarea name="docz" class="form-control"  rows="4" disabled><?php echo $dast['presreq']; ?></textarea>
									</div>
									<div class="form-group">
										<label for="exampleFormControlTextarea1">Doctor's Response</label>
										<textarea name="docz" class="form-control"  rows="4" disabled><?php echo $dast['docz']; ?></textarea>
									</div>
										
										
									</div>
										
									<?php }} ?>
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