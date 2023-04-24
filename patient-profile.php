<?php

include('header.php');
include('nurse-pat-nav.php');
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
						<h3 class="block-title">Patient Report</h3>
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
									$getPateintData = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
 and patient.id='$name1' order by patient.id");
								
	
												
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
							<h3 class="widget-title">Vitals</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateintDa = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp, pat_details.bp as bp1, pat_details.hb as hb1, pat_details.bt as bt1,pat_details.rp as rp1 from patient,appoint,users,pat_details

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and pat_details.hosno = patient.hosno

 and patient.id='$name1'");
								
	
									
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
									
											<td><?php echo $das['bp1']; ?></td>
											<td><?php echo $das['hb1']; ?></td>
											<td><?php echo $das['bt1']; ?></td>
											<td>
												<?php echo $das['rp1']; ?>
											
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
							<h3 class="widget-title">Vital's Update</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateintDat = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,pat_details.pat_d_id as pddid,pat_details.hosno from patient,appoint,users,pat_details

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and pat_details.hosno = patient.hosno 

 and patient.id='$name1' group by patient.fname");
								
	
									
									?>
									<form method="post">
										<?php
										if(isset($_POST['vitals'])){
											$bp = $_POST['bp'];
											$hb = $_POST['hb'];
											$rp = $_POST['rp'];
											$bt = $_POST['bt'];
											$pat = $_POST['id'];
											$pat_d_id = $_POST['pat_d_id'];
												//database ruinz
												$sendInNow = mysqli_query($conn,"update patient set bp='$bp', hb='$hb', rp='$rp', bt='$bt' where id='$pat'   ");
											$sendInNorth= mysqli_query($conn,"update pat_details set bp='$bp', hb='$hb', rp='$rp', bt='$bt' where pat_d_id='$pat_d_id'" );
										echo "<meta http-equiv='refresh' content='0'>;";	
								
										}
										
										
										
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
		if(mysqli_num_rows($getPateintDat) >0)
											{
												
	while($days = mysqli_fetch_assoc($getPateintDat)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><input type="text" name="bp" placeholder="Blood Pressure" class="form-control">
											<input type="hidden" value="<?php echo $days['id']; ?>" name="id" placeholder="Blood Pressure" class="form-control">
												
												
												<input type="hidden" value="<?php echo $days['pddid']; ?>" name="pat_d_id" placeholder="Blood Pressure" class="form-control">
											
											</td>
											<td><input type="text" name="hb" placeholder="Heart Rate" class="form-control"></td>
											<td><input type="text" name="bt" placeholder="Body Temperature" class="form-control"></td>
											<td>
												<input type="text" name="rp" placeholder="Respiratory Rate" class="form-control">
											
											
											</td>
											
										</tr>
										<tr>
											<td colspan="4"><button type="submit" class=" btn btn-secondary btn-block" name="vitals">Submit Vitals</button></td>
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
							<h3 class="widget-title">Nurse Observation</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateintD = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users

WHERE
appoint.pat_id = patient.id 

AND
users.id = appoint.doctor_id

 and patient.id='$name1' group by patient.hosno");
								
	
									
									?>
									<form method="post">
										<?php
										if(isset($_POST['observe'])){
											$patid = $_POST['pat_id'];
											$patids = $_POST['pat_id']= $_POST['id'];
											$docid = $_POST['doc_id']; 
											$nures = $_POST['nurse'];
											$patcard = $_POST['patcardid'];
											$date = $_POST['date'] = date("y-m-d") . "\n" ;
											$created = $_POST['createdby'];
											
		$nurserREply= mysqli_query($conn,"select * from nurse_report where nurse='' and docrep !=''");
									if($nurserREply->num_rows !==0){
										
										$dataSend = mysqli_query($conn,"update nurse_report set nurse='$nures', createdby='$created' where date='$date' and pat_id='$patid' and nurse=''");
									echo "<meta http-equiv='refresh' content='0'>;";	
									
									}else{
										
										//database cruize
									$dataBaseCruize= mysqli_query($conn,"insert into nurse_report(pat_id,doc_id,nurse,date,createdby) values ('$patid','$docid','$nures','$date','$created')");
									
					//	$datacheck= mysqli_query($conn,"update pat_card set nurse='$nures' where id='$patid' and pharm=''");
								echo "<meta http-equiv='refresh' content='0'>;";	
											
										
										
									}		
											
											
											
											
											
										}
										
										?>
									
									<?php
		if(mysqli_num_rows($getPateintD) >0)
											{
												
	while($dial = mysqli_fetch_assoc($getPateintD)){
		
	
		
		?>
									<input type="hidden" name="pat_id"  value="<?php echo $dial['peid']; ?>" >
									<input type="hidden" value="<?php echo $dial['uid']; ?>" name="doc_id">
										
										<!---<input type="hidden" value="<?php // echo $dial['pacarid']; ?>" name="patcardid"> -->
										<input type="hidden"  value="<?= $_SESSION['username'] ?>" name="createdby">
										<input type="hidden"  name="date" value="<?php echo date("y-m-d") . "\n" ?>">
								<div class="form-group">
										<label for="exampleFormControlTextarea1">Observation</label>
										<textarea name="nurse" class="form-control"  rows="4"></textarea>
									</div>
									
									<button type="submit" name="observe" class="btn btn-primary">Submit</button>
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
							<h3 class="widget-title">Nurse Remark</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['patid'];
									$getPateint = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,nurse_report.id as nrid,nurse_report.pat_id as pat_id, nurse_report.doc_id as doc_id, nurse_report.nurse as nurse,nurse_report.docrep as docrep,nurse_report.date as nrdate from patient,appoint,users,nurse_report

WHERE
appoint.pat_id = patient.id 
AND

nurse_report.pat_id = patient.id and nurse_report.doc_id = users.id
 and patient.id='$name1'");
								
	
									
									?>
									<form method="post">
									<thead>
										<tr>
											<th>Date</th>
											<th>Nurse Remark</th>
											<th>Doctor's Response</th>
										</tr>
									</thead>
									<?php
		if(mysqli_num_rows($getPateint) >0)
											{
												
	while($dast = mysqli_fetch_array($getPateint)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><?php echo $dast['nrdate']; ?></td>
											<td><?php echo $dast['nurse']; ?></td>
											<td><?php echo $dast['docrep']; ?></td>

										</tr>
										
										</tbody>
										
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