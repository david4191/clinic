<?php

include('header.php');
include('medic-patcard-nav.php');
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
						<h3 class="block-title">Patient Card</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="medical-records-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Patient Card</li>
						</ol>
					</div>
				</div>
			</div>


<div class="container home">
			
	
	
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-id-card-alt"></i> Patient Cards
								<a href="new-patient.php" style="float: right;border: thin; color: white; padding: 6px; font-size: 12px; text-transform: uppercase;"  class="btn btn-secondary btn-sm" >New Card</a>
								
								
						
							</h3>
							<form method="post">
									<div class="form-group col-md-4">
										<input type="search" name="fname" class="form-control" placeholder="Patient's Name" required>
										<button class="btn btn-danger btn-block" name="search"><i class="fa fa-glass"></i> Search</button>
									</div>
									
									
								</form>	
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
										<?php
									$getPateintBooking1= mysqli_query($conn,"SELECT fname,id,presno,hosno,acct_stat,day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year from patient
WHERE
createdby ='".$_SESSION['username']."' order by datecreated");
										
									
									?>
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Pres No.</th>
											<th>Hospital No.</th>
											<th>Reg. Date</th>
											
											<th>Account Status</th>
											<th>Print Card</th>
								   	</tr>
									</thead>
									<tbody>
										<?php
										while($dated = mysqli_fetch_assoc($getPateintBooking1)){
									
										
										?>
										<tr>
											<td><?php echo $dated['fname']; ?></td>
											<td><?php echo $dated['presno']; ?></td>
											<td><?php echo $dated['hosno']; ?></td>
											<td><?php echo $dated['day']; ?>/<?php echo $dated['month']; ?>/<?php echo $dated['year']; ?></td>
											<td><?php echo $dated['acct_stat']; ?></td>
										<td>
												
												<a type="button" class="badge badge-danger" style="border: thin; color: white;" href="medic-card.php?id=<?php echo $dated["id"]; ?>"><span class="ti-pencil-alt"></span> Card</a></td>
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