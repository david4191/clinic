	<td>
																<?php
		
						$Compile = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp from patient,appoint,users

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
 and patient.id='$name1' and patient.gender='male'");
		if($Compile->num_rows !== 0){
			$pname = $data['pname'];
			$gender = $data['gender'];
			$dob = $data['pdob'];
			$presno = $data['presno'];
			$audhosno = $data['hosno'];
			$pacct = $data['pacct'];
			
			
			
									$name1 = $_GET['patid'];
									$ceckdeds = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,testro.pat_id as t_id,testro.hosno as t_hosno,testro.date as t_date,substr(testro.test,1,55) as test,testro.id as tid from patient,appoint,users,testro

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
patient.id = testro.pat_id

 and patient.id='$name1'");
			if(mysqli_num_rows($ceckdeds) >0)
											{					
	while($datar = mysqli_fetch_assoc($ceckdeds)){
	$tid = $datar['tid'];
		$test = $datar['test'];
		$tdate = $datar['t_date'];
	}}
			echo '
									
									<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg6">Testrointestinal System </button>
									<div class="modal fade bd-example-modal-lg6" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel6" aria-hidden="true">
		
									<div style="max-width: 60%" class="modal-dialog modal-lg6">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel6">
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
													<table id="tableId" class="table table-striped">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b>'.$pname.' </td><td> <b>Gender: </b>'.$gender.'</td>
											<td><b>Date of Birth :</b> '.$dob.'</td>
										</tr>
										<tr>
											<td><b>Pres No.: </b>'.$presno.'</td><td><b>Hospital No.: </b>'.$audhosno.'</td>
											<td><b>Account Status:</b>'.$pacct.'
										
												&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
								<table id="tableId" class="table table-borderless table-striped">
									
									
							
									<form method="post">
									<thead>
										<tr>
											<th>Testrointestinal  Report</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									
									
									<tbody>

										
										<tr>
									
											
											<td>
												'.$test.'
											</td>
											<td>
												'.$tdate.'
											</td>
											<td>
											<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="testrointestinal-report.php?tid='.$tid.'"><span class="ti-pencil-alt"></span> view Testrointestinal Report</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									
								</table>
						
											
											</div>
		
										</div>
									</div>
								</div>
									
		';
		
		}
		else{
			$pname = $data['pname'];
			$gender = $data['gender'];
			$dob = $data['pdob'];
			$presno = $data['presno'];
			$audhosno = $data['hosno'];
			$pacct = $data['pacct'];
			
			
			$name1 = $_GET['patid'];
									$ceckdedss = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username as uname,patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,gestro.pat_id as g_id,gestro.hosno as g_hosno,gestro.date as g_date,substr(gestro.gest,1,55) as gest,gestro.id as gid from patient,appoint,users,gestro

WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id
and
patient.id = gestro.pat_id

 and patient.id='$name1'");
								
	while($datars = mysqli_fetch_assoc($ceckdedss)){
	$gid = $datars['gid'];
		$gest = $datars['gest'];
		$gdate = $datars['g_date'];
	}
			
			
			echo'
				<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg61">Gestrointestinal System </button>
									<div class="modal fade bd-example-modal-lg61" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel61" aria-hidden="true">
		
									<div style="max-width: 60%" class="modal-dialog modal-lg61">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel61">Gestrointestinal System
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
													<table id="tableId" class="table table-striped">
									
									
									<tbody>
										<tr>
									<td><b>Name: </b>'.$pname.' </td><td> <b>Gender: </b>'.$gender.'</td>
											<td><b>Date of Birth :</b> '.$dob.'</td>
										</tr>
										<tr>
											<td><b>Pres No.: </b>'.$presno.'</td><td><b>Hospital No.: </b>'.$audhosno.'</td>
											<td><b>Account Status:</b>'.$pacct.'
										
												&nbsp;&nbsp;&nbsp;
											
										</tr>
										</tbody>
									
								</table>
								
								<table id="tableId" class="table table-borderless table-striped">
									
									
							
									<form method="post">
									<thead>
										<tr>
											<th>Gestrointestinal  Report</th>
											<th>Date</th>
											<th>View</th>
										</tr>
										</thead>
									
									
									<tbody>
										
										<tr>
									
											
											<td>
												'.$gest.'
											</td>
											<td>
												'.$gdate.'
											</td>
											<td>
											<a type="button" target="_blank" class="badge badge-success" style="border: thin; color: white;" href="gestrointestinal-report.php?gid='.$gid.'"><span class="ti-pencil-alt"></span> view Gestrointestinal Report</a>
											</td>
										</tr>
										
										</tbody>
										</form>
									
								</table>
												
											</div>
		
										</div>
									</div>
								</div>
			
			
			';
		}
									
									?>			
								&nbsp;&nbsp;
								
													
													</td>
													