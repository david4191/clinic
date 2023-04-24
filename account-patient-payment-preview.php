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

include('dbcon.php');
include('acct-pay-nav.php');
   
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>

<div class="container mt-0">
					<div class="row breadcrumb-bar">
						<div class="col-md-6">
							<h3 class="block-title">Payment Slip</h3>
						</div>
						<div class="col-md-6">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="pharmacy-dashboard.php">
										<span class="ti-home"></span>
									</a>
								</li>
								<li class="breadcrumb-item">Account/Sales</li>
								<li class="breadcrumb-item active">Invoice</li>
							</ol>
						</div>
					</div>
				</div>
				<div class="container">
				<div class="row">
					<form>
								
						
						<?php
						$name1 = $_GET['patid'];
						$getPateintData = mysqli_query($conn,"SELECT patient.id as patid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1, invoice.pname as ipname, invoice.paddress as ipaddress, invoice.hosno as ihosno, invoice.pnumb as ipnumb, invoice.pmail as ipmail, invoice.drug as drug, invoice.drug1 as drug1, invoice.amt as amt, invoice.amt1 as amt1, invoice.quantity as qty, invoice.quantity1 as qty1, invoice.amount as amount, invoice.amount1 as amount1, invoice.amount45 as amount45, invoice.status , invoice.datecreated from patient,appoint,users,pat_card,invoice
WHERE

pat_card.presno_id = patient.id and
appoint.pat_id = patient.id 
AND
users.id = appoint.doctor_id and invoice.hosno = pat_card.hosno_id and patient.id='$name1' group by invoice.datecreated");
						
						
												
	while($data = mysqli_fetch_assoc($getPateintData)){
		
	
						
						?>
						<?php
								if(isset($_POST['send'])){
										
									$status = $_POST['status'];
									$ihosno = $_POST['hosno'];
									
									$invoice = mysqli_query($conn,"update invoice set status='$status' where hosno='$ihosno' ");
										echo'
							<script>
							
Swal.fire("Successful!", "Verified  Successfully!", "success") ;

									window.location.href="account.php";
										</script>
							';
		
									
								}
								
								
								?>
						<div class="col-md-12">
							<div class="widget-area-2 proclinic-box-shadow pb-3">
								
								
								<!-- Invoice Head -->
								<div class="row ">
									
									<div class="col-sm-6 mb-5">
										<h5 class="proclinic-text-color"><img style="" src="images/DSS-Logo.png"  width="30px" height="25px">
									DSSMC</h5>
										
										<span>Lugbe road off airport road</span>
										<br>
										<span>Abuja, Nigeria.</span>
										<br>
										<span class="pr-2">Phone: +00 123456</span>
										
									</div>
									<div class="col-sm-6 text-md-right mb-5">
										<h3>INVOICE</h3>
										<br>
										<br>
										<span>Invoice # [123]</span>
										<br>
										<span>Date:<?php $datE = date("y-m-d") . "\n" ;
											 echo $datE?></span>
										<br>
										<br>
										<span style="font-weight: bold; color:#09F107; text-transform: uppercase; background-color:#262626; padding: 12px;">Payment Status: <?php 
												 
												
												 
												 if(empty($data['status'] )){
												
											echo "Pending";
											 }else{
											
											 echo $data['status'];
												 }?></span>
									</div>
								</div>
								<!-- /Invoice Head -->
								<!-- Invoice Content -->
								
								<div class="row">
									<div class="col-sm-8 mb-7">
										<h6 class="proclinic-text-color">TO:</h6>
										<span><b>Name: </b><?php echo $data['ipname']; ?></span>
										<br>
										<span><b>Address: </b><?php echo $data['ipaddress']; ?></span>
										<br>
										<span><b>Hospital No.: </b><?php echo $data['ihosno']; ?></span>
										<br>
										<span><b>Phone No.: </b><?php echo $data['ipnumb']; ?></span>
										<br>
										<span><b>Email: </b><?php echo $data['ipmail']; ?></span>
									</div>
									<div class="col-sm-12 mb-5">
										<strong class="proclinic-text-color"></strong>
									</div>
									<div class="col-sm-12">
																	
			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>
										<table class="table table-bordered table-striped table-invioce">
											
											
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Description</th>
													<th scope="col">Unit Cost (₦)</th>
													<th scope="col">Quantity</th>
													<th scope="col">Total (₦)</th>
												</tr>
											</thead>
											
											<tbody>
											<!---	<script>
												// AJAX call for autocomplete 
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readDrugs.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
													
												</script> --->
												
												
												<tr>
													<th><i class="fas fa-plus"></i><br><br><br>
														<i class="fas fa-plus"></i>
													
													
													</th>
				<td>
    				<!---- <div class="frmSearch">
	<input type="text" class="form-control" id="search-box" placeholder="Drug Name" />
	<div id="suggesstion-box"></div>
</div> --->
					
					<?php echo $data['drug']; ?><br><br><br>
						 <?php echo $data['drug1']; ?><br>
					
					<br>
					
					
					
					
					
					<br>
												
													
													</td>
													<td> <?php echo $data['amt']; ?><br><br><br>
						<?php echo $data['amt1']; ?>
														
														
														
														
														
					</td>
													<td><?php 
						if(empty($data['quantity'])){
							echo "";
						}else{
						echo $data['quantity']; 
						}
						 ?><br><br><br>
						<?php 
						if(empty($data['quantity1'])){
							echo "";
						}else{
						echo $data['quantity1']; 
						}
						
						
						
						?>
													</td>
													
													<td><?php 
						if(empty($data['amount'])){
							echo "";
						}else{
						echo $data['amount'];
						}
						
						
						 ?><br><br><br>
						<?php 	if(empty($data['amount1'])){
							echo "";
						}else{
						echo $data['amount1'];
						} ?><br>
													</td>
													
													
												</tr>
												
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	
												<script type="text/javascript">
	$('#amt, #quantity').on('input',function(){
    var rate = parseFloat($('#amt').val()) || 0;
    var box = parseFloat($('#quantity').val()) || 0;

    $('#amount').val(rate * box);    
});
	$('#amt1, #quantity1').on('input',function(){
    var rate = parseFloat($('#amt1').val()) || 0;
    var box = parseFloat($('#quantity1').val()) || 0;

    $('#amount1').val(rate * box);    
});													
													
	</script>
											
											</tbody>
										
	
										</table>
									</div>
									<script type="text/javascript">
									 $('input').change(function() {
    if($('[name="amount"]').val()!=="" && $('[name="amount1"]').val()!=="" )
    {
   $('[name="amount45"]').val(parseInt($("#amount").val())+(parseInt($("#amount1").val())));
    }
    else
    {
        $('[name="amount45"]').val("");
    }
});
									
									</script>
									<div class="col-sm-4 ml-auto">
										<table class="table table-bordered table-striped">
											<tbody>
												<tr>
													<td>Subtotal</td>
													<td> ₦<?php 
							$amt = $data['amount45'];
									$subtotal =  number_format($amt, 2, '.', ',');
						
						
						echo $subtotal; ?><br></td>
												</tr>
												
												<tr>
													<td>
													 TOTAL
													</td>
													<td>
														<strong> ₦<?php 
							$amt = $data['amount45'];
									$subtotal =  number_format($amt, 2, '.', ',');
						
						
						echo $subtotal; ?><br></strong>
													</td>
													
												</tr>
												
											</tbody>
										</table>
										
										<button type="submit" name="send" class="btn btn-warning btn-block">Print</button> <br>
										<a href="account.php" class="btn btn-success btn-block">Dashboard</a>
										<br>
										

									</div>
		
									<div class="col-sm-12">
										<div class="border p-4">
											<strong>Note:</strong>
											
											<br>
											<br>
											<i>Thanks for your patronage</i>
										</div>
									</div>
		
									
									
									
								</div>
								<!-- /Invoice Content -->
							
										</div>
					</div>
				<?php } ?>
					</form>
				</div>
						
				
	
			</div>
			<!-- /Main Content -->
	
	


<?php
include('footer.php');
?>