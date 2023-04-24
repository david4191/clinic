<?php

include('header.php');
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
$query ="SELECT * FROM pat_card where pharm !='issued'";
$result =mysqli_query($conn, $query);

//checking query error
if (!$result){
	
	die("retriving query error <br>".$query);
}


$total_rep=mysqli_num_rows($result);


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

<br><br><br><br><br><br>
<!-- Main Content -->
			<div class="container home">
				

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-borderless">
									<?php
									$name1 = $_GET['famidd'];
									$ceck = mysqli_query($conn,"SELECT patient.id as id, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, patient.bp as bp,patient.hb as hb,patient.bt as bt,patient.rp as rp,fam_history.fams as fams,fam_history.pat_id as fm_id,fam_history.hosno as fm_hosno,fam_history.date as fm_date,fam_history.id as famidd from patient,fam_history

WHERE
fam_history.id='$name1' and
patient.id = fam_history.pat_id 
 ");
								
	
									
									?>
				
									<tbody>
										<?php if(mysqli_num_rows($ceck) >0)
											{	while($data = mysqli_fetch_array($ceck)){
										
								?>
										<tr align="center">
											<td>
											 <?php echo $data['pname']; ?> | <?php echo $data['fm_date']; ?>
											</td>
											
										</tr>
										<tr>
											
											<td> <?php echo $data['fams']; ?></td>
											
										</tr>
									
										</tbody>
									<?php 
									} }
									?>
								</table>
								<!--Export links-->
								
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
		

			</div>
			<!-- /Main Content -->
			


