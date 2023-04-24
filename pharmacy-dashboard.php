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
include('pharm-nav.php');
include('dbcon.php');



// retriving exisiting visits
$query ="SELECT * FROM pat_card where month(datecreated) = MONTH(CURRENT_DATE())";
$result =mysqli_query($conn, $query);

//checking query error
if (!$result){
	
	die("retriving query error <br>".$query);
}


$total_pat=mysqli_num_rows($result);


// retriving exisiting visits
$query1 ="SELECT * FROM appoint where month(date_created) = MONTH(CURRENT_DATE())";
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
						<h3 class="block-title">Welcome</h3>
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
					<div class="col-md-6">
						<div class="widget-area proclinic-box-shadow color-red">
							<div class="widget-left">
								<span class="ti-pencil"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Prescriptions</h4>
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
								<span class="ti-book"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Total Drugs</h4>
								<span class="numeric color-green"><?php echo  $total_drug;  ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> Yearly</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					
					
				</div>
	
	
	

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
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail, patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, patient.createdby ,appoint.id, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id,appoint.pharm_stats as stats, users.fname as dname, users.acct_type as acct, users.id as uid, users.username from patient,appoint,users
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
											
											<th>Account Status</th>
											<th>Drug Status</th>
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
											
											<td>
												<?php echo $data['pacct']; ?>
												
											</td>
											<td>
											<?php
											
											echo $data['stats'];
											?>
											
											
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
		
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-pills"></i> Drug Store &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="new-category.php" style="position: relative;left: 650px;border: thin; color: white; padding: 6px; font-size: 12px; text-transform: uppercase;"  class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> New Category</a>
								
								<button type="button" style="float: right;border: thin; color: white; padding: 6px; font-size: 12px; text-transform: uppercase"  class="btn btn-warning btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Add Drug</button>
								<!-- Modal Popup-->
								<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="myLargeModalLabel"><i class="fas fa-capsules"></i> New Drug
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												
													<form method="post">
								<?php
								if(isset($_POST['newdrugs'])){
									
									$fname = $_POST['cat_id'];
									$presno = $_POST['drug'];
									$hosno = $_POST['regno'];
									$acct_stats = $_POST['qty'];
									$email = $_POST['unitcost'];
									$address = $_POST['drug_d'];
									$createdby	= $_POST['createdby'];
									
									// send into database
		$sendDadd = mysqli_query($conn,"insert into drugstore (cat_id,drug,regno,qty,unitcost,drug_d,createdby) values ('$fname','$presno','$hosno','$acct_stats','$email','$address','$createdby')");
									
									
									
									echo'
							<script>
							
Swal.fire("Successful!", "Sent  Successfully!", "success") ;

									
										</script>
							';
		
								}
								
								?>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Category</label>
										<select name="cat_id" class="form-control">
									<?php 
											
											$querys= "SELECT id, cate FROM drug_category " 
											;
											$query_runs= mysqli_query($conn, $querys);
										?>
									 
										<option>-Select-</option>
										<?php 
											
												while($rows =$query_runs->fetch_assoc())
												{
													$prod14= $rows['cate'];
													$prod12= $rows['id'];
													
													echo "<option value='$prod12'>$prod14</option>";
													}
										?>
										
									
									</select>
									
									</div>
									<div class="form-group col-md-6">
										<label>Name</label>
										<input type="text" name="drug" placeholder="Full Name" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label >Reg No.</label>
										<input type="text" class="form-control" name="regno" placeholder="Registration Number">
										
									</div>
									<div class="form-group col-md-6">
										<label>Stock Qty.</label>
										<input type="text" placeholder="Quantity In-Stock" name="qty" class="form-control">
									</div>
									<div class="form-group col-md-12">
										<label>Unit Cost</label>
										<input type="text" placeholder="Unit Cost" name="unitcost" class="form-control">
									</div>
									<script>
// When ready.
$(function() {
  var extra = 0;
  var $input = $("#amount");

  $input.on("keyup", function(event) {

    // When user select text in the document, also abort.
    var selection = window.getSelection().toString();
    if (selection !== '') {
      return;
    }

    // When the arrow keys are pressed, abort.
    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
      if (event.keyCode == 38) {
        extra = 1000;
      } else if (event.keyCode == 40) {
        extra = -1000;
      } else {
        return;
      }

    }

    var $this = $(this);
    // Get the value.
    var input = $this.val();
    var input = input.replace(/[\D\s\._\-]+/g, "");
    input = input ? parseInt(input, 10) : 0;
    input += extra;
    extra = 0;
    $this.val(function() {
      return (input === 0) ? "" : input.toLocaleString("en-US");
    });
  });
});
										  
  </script>
									<div class="form-group col-md-12">
										<label>Details</label>
										<textarea name="drug_d" class="form-control"  rows="4"></textarea>
									</div>
									
									
									
									
									
			<input type="hidden" name="createdby" value="<?= $_SESSION['username'] ?>" class="form-control">
															
						
									<div class="form-group col-md-12 mb-6">
										<button type="submit" name="newdrugs" class="btn btn-primary btn-block">Send</button>
									</div>
								</div>
							</form>
						
												
												
												
											</div>
		
										</div>
									</div>
								</div>
								<!-- /Modal Popup-->
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							
							</h3>
							<form method="post">
									<div class="form-group col-md-4">
										<input type="search" name="fname" class="form-control" placeholder="Category" required>
										<button class="btn btn-success btn-block" name="search"><i class="fa fa-glass"></i> Search</button>
									</div>
									
									
								</form>	
							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateinter = mysqli_query($conn,"select drug_category.cate as cate, drug_category.id, drugstore.id as id, drugstore.cat_id, drugstore.drug as drugname, drugstore.regno as reg_no, drugstore.qty as qty, drugstore.unitcost as unitcost,drugstore.createdby as createdby from drug_category, drugstore
WHERE 
drugstore.cat_id = drug_category.id
and drugstore.createdby='".$_SESSION['username']."'");
								
	
									
									?>
									
									<thead>
										<tr>
											<th></th>
											<th>Category</th>
											<th>Drug</th>
											<th>Reg No.</th>
											<th>Stock Qty</th>
											<th>Unit Cost</th>
											<th>Reg. By</th>
										</tr>
									</thead>
									<?php
		
												
	while($daster = mysqli_fetch_assoc($getPateinter)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><i class="fas fa-arrow-alt-circle-up"></i></td>
											<td><?php echo $daster['cate']; ?></td>
											<td><?php echo $daster['drugname']; ?></td>
											<td><?php echo $daster['reg_no']; ?></td>
											<td><?php echo $daster['qty']; ?></td>
											<td>₦<?php
		
		$amt12 = $daster['unitcost'];
									$subtotal12 =  number_format($amt12, 2, '.', ',');
		
		
		echo $subtotal12; ?></td>
											<td><?php echo $daster['createdby']; ?></td>

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
									$getPateintz = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, appoint.id as apid, appoint.reason as checks, appoint.time as aptime,appoint.date as apdate, appoint.status as apstats,appoint.reason,appoint.doctor_id, users.fname as dname, users.acct_type as acct, users.id as uid, users.username, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,substr(pat_card.docz,0,30) as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1,nurse_report.id as nrid,nurse_report.pat_id as pat_id, nurse_report.doc_id as doc_id, nurse_report.nurse as nurse,nurse_report.date as nrdate from patient,appoint,users,pat_card,nurse_report

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
		
												
	while($dastz = mysqli_fetch_assoc($getPateintz)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><?php echo $dastz['pname']; ?></td>
											<td><?php echo $dastz['hosno']; ?></td>
											<td><?php echo $dastz['pcardocz']; ?></td>

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
	
	
	
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fab fa-cc-visa"></i> Payments
							
							
							</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1 from patient,appoint,users,pat_card
WHERE

pat_card.presno_id = patient.id and pat_card.pharm ='issued' and
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id");
									
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
												
												<a type="button" class="badge badge-warning" style="border: thin; color: white;" href="pharmacy-patient-payment.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> Generate Payment Slip</a></td>
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
								<!--Export links-->
								
						
								
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
							<h3 class="widget-title"><i class="fab fa-cc-visa"></i> Payments Preview
							
							
							</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								<table id="tableId" class="table table-borderless">
									<?php
									$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1,invoice.pname as ipname, invoice.hosno as ihosno, invoice.status as istats from patient,appoint,users,pat_card,invoice
WHERE

pat_card.presno_id = patient.id and pat_card.pharm ='issued' and
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and invoice.hosno = pat_card.hosno_id and
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
											<th>Payment Status</th>
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
											<?php
											
											$pharmstatsChecked = mysqli_query($conn,"select appoint.pat_id, appoint.status, appoint.pharm_stats as statsd,pat_card.presno_id, pat_card.pharm,invoice.pname as ipname, invoice.hosno as ihosno, invoice.status as istats  from appoint,pat_card,invoice where appoint.pharm_stats='Issued' and invoice.hosno = pat_card.hosno_id and appoint.pat_id = pat_card.presno_id");
											$data['istats'];
											if($pharmstatsChecked->num_rows !== 0 && $data['istats']){
											echo $data['istats'];
												
											}else{
												
												echo "Pending ";
											}		
										
											?>
											
											</td>
											<td>
												
												<a type="button" class="badge badge-warning" style="border: thin; color: white;" href="pharm-patient-payment-preview.php?patid=<?php echo $data["patid"]; ?>"><span class="ti-pencil-alt"></span> Generate Payment Slip</a></td>
										</tr>
										</tbody>
									<?php 
									}
									?>
								</table>
								<!--Export links-->
								
						
								
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