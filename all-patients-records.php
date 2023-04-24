<?php

include('header.php');
include('medic-pat-nav.php');
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
						<h3 class="block-title">Patient Records</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="medical-records-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Patient records</li>
						</ol>
					</div>
				</div>
			</div>
<div class="container home">
				

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-file-medical"></i> Patients List
							
								
							
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
    $query = "SELECT id, image, fname, presno, hosno, acct_stat, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year FROM patient  where createdby = '" . $_SESSION['username'] ."' LIMIT 5";
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
										</tr>
										
									</tbody>
									 <?php endwhile;?>
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

