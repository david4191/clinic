<?php

include('header.php');
include('pharm-doc-nav.php');
include('dbcon.php');

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

// retriving exisiting visits
$query ="SELECT * FROM pat_card where pharm=''";
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


// retriving exisiting visits
$quer ="SELECT * FROM drugstore";
$resul = mysqli_query($conn, $quer);

//checking query error
if (!$resul){
	
	die("retriving query error <br>".$quer);
}


$total_drug=mysqli_num_rows($resul);
?>

<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Doctor's Report</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="pharmacy-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Doctor report</li>
						</ol>
					</div>
				</div>
			</div>



<div class="container home">
			
	
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-comment-medical"></i>  Doctor's Report
							
							
							</h3>							
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
pat_card.presno_id = patient.id and appoint.status='pending' group by pat_card.las_vis desc
");
								
	
									
									?>
									
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Hospital No.</th>
											<th>Doctor's Report</th>
										</tr>
									</thead>
									<?php
		
												
	while($dast = mysqli_fetch_assoc($getPateint)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><?php echo $dast['pname']; ?></td>
											<td><?php echo $dast['hosno']; ?></td>
											<td><?php echo $dast['pcardocz']; ?></td>

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