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
include('pharm-acct-nav.php');

   
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
					<form method="post">
								<?php
								if(isset($_POST['send'])){
										
									$pname = $_GET['pname'];
									$paddress = $_GET['paddress'];
									$hosno = $_GET['hosno'];
									$pnumb = $_GET['pnumb'];
									$pmail = $_GET['pmail'];
									$drug = $_GET['drug'];
									$drug1 = $_GET['drug1'];
									$amt = $_GET['amt'];
									$amt1 = $_GET['amt1'];
									$qty = $_GET['quantity'];
									$qty1 = $_GET['quantity1'];
									$amount = $_GET['amount'];
									$amount1 = $_GET['amount1'];
									$amount45 = $_GET['amount45'];
									
									$invoice = mysqli_query($conn,"insert into invoice(pname,paddress,hosno,pnumb,pmail,drug,drug1,amt,amt1,quantity,quantity1,amount,amount1,amount45) values ('$pname','$paddress','$hosno','$pnumb','$pmail','$drug','$drug1','$amt','$amt1','$qty','$qty1','$amount','$amount1','$amount45')");
										echo'
							<script>
							
Swal.fire("Successful!", "Sent  Successfully!", "success") ;

									
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
									</div>
								</div>
								<!-- /Invoice Head -->
								<!-- Invoice Content -->
								
								<div class="row">
									<div class="col-sm-8 mb-7">
										<h6 class="proclinic-text-color">TO:</h6>
										<span><b>Name: </b><?php echo $_GET['pname']; ?></span>
										<br>
										<span><b>Address: </b><?php echo $_GET['paddress']; ?></span>
										<br>
										<span><b>Hospital No.: </b><?php echo $_GET['hosno']; ?></span>
										<br>
										<span><b>Phone No.: </b><?php echo $_GET['pnumb']; ?></span>
										<br>
										<span><b>Email: </b><?php echo $_GET['pmail']; ?></span>
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
					
					<?php echo $_GET['drug']; ?><br><br><br>
						 <?php echo $_GET['drug1']; ?><br>
					
					<script>
					
					 function myFunctionn(){
 var index = document.getElementById("drug").selectedIndex;
    var add = document.getElementById("drug").options[index].getAttribute("data-add");
//var con = document.getElementById("con").options[index].getAttribute("data-con");
document.getElementsByName("amt")[0].value = add;
// document.getElementsByName("con")[0].value = con;
}
						
						 function myFunctionn1(){
 var index = document.getElementById("drug1").selectedIndex;
    var add = document.getElementById("drug1").options[index].getAttribute("data-add");
//var con = document.getElementById("con").options[index].getAttribute("data-con");
document.getElementsByName("amt1")[0].value = add;
// document.getElementsByName("con")[0].value = con;
}
					</script>
					
					
					<br>
					
					
					
					
					
					<br>
												
													
													</td>
													<td> <?php echo $_GET['amt']; ?><br><br><br>
						<?php echo $_GET['amt1']; ?>
														
														
														
														
														<script>
															var changeInput = function (amt){
    var input = document.getElementById("amt");
    input.value = amt;
}
														var changeInput1 = function (amt){
    var input = document.getElementById("amt1");
    input.value = amt;
}
														
														</script>
					</td>
													<td><?php 
						if(empty($_GET['quantity'])){
							echo "";
						}else{
						echo $_GET['quantity']; 
						}
						 ?><br><br><br>
						<?php 
						if(empty($_GET['quantity1'])){
							echo "";
						}else{
						echo $_GET['quantity1']; 
						}
						
						
						
						?>
													</td>
													
													<td><?php 
						if(empty($_GET['amount'])){
							echo "";
						}else{
						echo $_GET['amount'];
						}
						
						
						 ?><br><br><br>
						<?php 	if(empty($_GET['amount1'])){
							echo "";
						}else{
						echo $_GET['amount1'];
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
							$amt = $_GET['amount45'];
									$subtotal =  number_format($amt, 2, '.', ',');
						
						
						echo $subtotal; ?><br></td>
												</tr>
												
												<tr>
													<td>
													 TOTAL
													</td>
													<td>
														<strong> ₦<?php 
							$amt = $_GET['amount45'];
									$subtotal =  number_format($amt, 2, '.', ',');
						
						
						echo $subtotal; ?><br></strong>
													</td>
													
												</tr>
												
											</tbody>
										</table>
										<button type="submit" name="send" class="btn btn-warning btn-block">Send To Account Department</button> <br>
										<a href="pharmacy-dashboard.php" class="btn btn-success btn-block">Dashboard</a>
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
				
					</form>
				</div>
						
				
	
			</div>
			<!-- /Main Content -->
	
	


<?php
include('footer.php');
?>