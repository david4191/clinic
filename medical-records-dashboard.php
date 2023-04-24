<?php

include('header.php');
include('medic-nav.php');
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
						<h3 class="block-title">Welcome</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="medical-records-dashboard.php">
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
					<div class="col-md-6">
						<div class="widget-area proclinic-box-shadow color-red">
							<div class="widget-left">
								<span class="ti-user"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Patients</h4>
								<span class="numeric color-red"><?php echo  $total_pat;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> Monthly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-6">
						<div class="widget-area proclinic-box-shadow color-green">
							<div class="widget-left">
								<span class="ti-bar-chart"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Appointments</h4>
								<span class="numeric color-green"><?php echo  $total_app;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-down"></span> Mothly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					
				</div>
	
	
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-id-card-alt"></i> All Patients
								<a href="new-patient.php" style="float: right;border: thin; color: white; padding: 6px; font-size: 12px; text-transform: uppercase;"  class="btn btn-secondary btn-sm" >New Patient</a>
								
								
						
							</h3>
							<form method="post" class="form-group">
									<div class="form-group col-md-4">
										<input type="search" name="fname" class="form-control" placeholder="Patient's Name" required>
										<button class="btn btn-danger btn-block" type="submit" name="search1"><i class="fa fa-glass"></i> Search</button>
									</div>
									
									
								</form>	
							<div class="table-responsive">
								<table class="table table-borderless">
									<?php 
									
if(isset($_POST['search1']))
{
    $valueToSearch = $_POST['fname'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT id, image, fname, presno, hosno, acct_stat, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year FROM patient WHERE CONCAT( `image`,`fname`, `presno`, `hosno`, `acct_stat`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT id, image, fname, presno, hosno, acct_stat, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year FROM patient  where createdby = '" . $_SESSION['username'] ."' LIMIT 33";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "clinic");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
										
										?>
                                  
									<thead>
										<tr>
											<th>Image</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Reg. Date</th>
											
											<th>Account Status</th>
											<th>Print Card</th>
											<th>Book Appointment</th>
								   	</tr>
									</thead>
									<tbody>
										<?php while($dated = mysqli_fetch_array($search_result)):?>
										<tr>
											<td><?php echo '<img src="'.$dated['image'].'" width="40px" height="30px" alt="Client Image" class="img-circle" >' ?></td>
											<td><?php echo $dated['fname']; ?></td>
											<td><?php echo $dated['presno']; ?></td>
											<td><?php echo $dated['hosno']; ?></td>
											<td><?php echo $dated['day']; ?>/<?php echo $dated['month']; ?>/<?php echo $dated['year']; ?></td>
											<td><?php echo $dated['acct_stat']; ?></td>
										<td>
												
												<a type="button" class="badge badge-danger" style="border: thin; color: white;" href="medic-card.php?id=<?php echo $dated["id"]; ?>"><span class="ti-pencil-alt"></span> Card</a></td>
											<td>
											<a type="button" class="badge badge-warning" style="border: thin; color: white;" href="new-appointment.php?id=<?php echo $dated["id"]; ?>"><span class="ti-pencil-alt"></span> New Session</a>
											
											</td>
										</tr>
										
									</tbody>
									 <?php endwhile;?>
								</table>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
	
	

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Appointments List
							
								
							
							</h3>
							<form method="post" class="form-group">
									<div class="form-group col-md-4">
										<input type="search" name="fname" class="form-control" placeholder="Patient's Name" required>
										<button class="btn btn-danger btn-block" type="submit" name="search2"><i class="fa fa-glass"></i> Search</button>
									</div>
									
									
								</form>	
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									
									<?php 
									
if(isset($_POST['search2']))
{
    $valueToSearch1 = $_POST['fname'];
    // search in all table columns
    // using concat mysql function
    $query2 = "SELECT patient.id as patid, patient.image as image,patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, patient.createdby, appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and CONCAT( `patid`, `image`, `pname`, `presno`, `hosno`, `pacct`) LIKE '%".$valueToSearch1."%'";
    $search_result1 = filterTable1($query2);
    
}
 else {
    $query2 = "SELECT patient.id as patid,  patient.image as image,patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, patient.createdby ,appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
patient.createdby ='".$_SESSION['username']."' order by patient.id desc";
    $search_result1 = filterTable1($query2);
}

// function to connect and execute the query
function filterTable1($query2)
{
    $connect = mysqli_connect("localhost", "root", "", "clinic");
    $filter_Result1 = mysqli_query($connect, $query2);
    return $filter_Result1;
}
										
										?>
                                  
									<thead>
										<tr>
											<th class="no-sort">
											
											</th>
											<th>Patient ID</th>
											<th>Images</th>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											
											<th>Account Status</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
									<?php while($data = mysqli_fetch_array($search_result1)):?>
									
										<tr>
											<td>
											
											</td>
											<td><?php echo $data['patid']; ?></td>
											<td><?php echo '<img src="'.$data['image'].'" width="40px" height="30px" alt="Client Image" class="img-circle" >' ?></td>
											<td><?php echo $data['pname']; ?></td>
											<td><?php echo $data['presno']; ?></td>
											<td><?php echo $data['hosno']; ?></td>
											
											<td>
												<?php echo $data['pacct']; ?>
												
											</td>
											<td>
												
												<a type="button" class="badge badge-success" style="border: thin; color: white;" href="medic-report.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> view report</a></td>
										</tr>
										</tbody>
								 <?php endwhile;?>
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
		

	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-laptop-medical"></i> Appointments Sessions
							
							
								
							</h3>
							
							<div class="table-responsive">
								<table class="table table-borderless">
										<?php
									$getPateintBooking = mysqli_query($conn,"SELECT patient.id , patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
WHERE
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and
patient.createdby ='".$_SESSION['username']."' order by appoint.id desc");
										
									
									?>
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Doctor</th>
											<th>Check-Up</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
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
			

<?php
include('footer.php');
?>