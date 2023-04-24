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
								<a href="pharmacy-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>



<div class="container home">
			
	

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="	fas fa-id-card-alt"></i> Patients List
							
								
							
							</h3>
							<form method="post">
									<div class="form-group col-md-4">
										<input type="search" name="fname" class="form-control" placeholder="Patient's Name" required>
										<button class="btn btn-danger btn-block" name="search"><i class="fa fa-glass"></i> Search</button>
									</div>
									
									
								</form>	
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, patient.createdby ,appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
appoint.status='pending'");
									
									?>
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Reg. Date</th>
											<th>Account Status</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										while($data = mysqli_fetch_assoc($getPateintData)){
										
									?>
										<tr>
											<td>
											
											</td>
											<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['presno']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											<td><?php echo $data['day']; ?>/<?php echo $data['month']; ?>/<?php echo $data['year']; ?></td>
											<td>
												<?php echo $data['pacct']; ?>
												
											</td>
											<td>
												
												<a type="button" class="badge badge-success" style="border: thin; color: white;" href="pharmacy-patient-profile.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> view report</a></td>
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










<?php
include('footer.php');
?>

