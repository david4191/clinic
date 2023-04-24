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
					<form method="get" action="preview-sales.php">
						<div class="col-md-12">
							<div class="widget-area-2 proclinic-box-shadow pb-3">
								<?php
								$name1 = $_GET['patid'];
									$getPateint = mysqli_query($conn,"SELECT patient.id as peid, patient.fname as pname, patient.hosno as hosno, patient.presno as presno,patient.gender as gender, patient.email as pmail,patient.mstats as mstats ,patient.acct_stat as pacct, patient.address as paddress, patient.dob as pdob, patient.number as pnumb, patient.occupation as pocc, day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year, pat_card.id as pacarid, pat_card.presno_id as pcard_presno,pat_card.docz as pcardocz,pat_card.pres as pcardpres,pat_card.las_vis as lagadis,pat_card.doc_id as doctore, pat_card.appt,pat_card.nurse as nurse1 from patient,appoint,users,pat_card
WHERE

pat_card.presno_id = patient.id and pat_card.pharm ='issued'
 and patient.id='$name1' group by patient.id ");
								
								
								
								?>
								<?php
		if(mysqli_num_rows($getPateint) >0)
											{
												
	while($da = mysqli_fetch_array($getPateint)){
		
	
		
		?>
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
										<span><b>Name: </b><input style=" border: none;
    background-color: transparent;
    resize: none;
    outline: none;" name="pname" value="<?php echo $da['pname']; ?>" readonly ></span>
										<br>
										<span><b>Address: </b><input style=" border: none;
    background-color: transparent;
    resize: none;
    outline: none;" name="paddress" value="<?php echo $da['paddress']; ?>" readonly></span>
										<br>
										<span><b>Hospital No.: </b><input style=" border: none;
    background-color: transparent;
    resize: none;
    outline: none;" name="hosno" value="<?php echo $da['hosno']; ?>" readonly></span>
										<br>
										<span><b>Phone No.: </b><input style=" border: none;
    background-color: transparent;
    resize: none;
    outline: none;" name="pnumb" value="<?php echo $da['pnumb']; ?>" readonly></span>
										<br>
										<span><b>Email: </b><input style=" border: none;
    background-color: transparent;
    resize: none;
    outline: none;" name="pmail" value="<?php echo $da['pmail']; ?>" readonly></span>
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
												<script>
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
													
												</script> 
												
												
												<tr>
													<th><i class="fas fa-plus"></i><br><br><br>
														<i class="fas fa-plus"></i>
													
													
													</th>
				<td>
    		<!---	 <div class="frmSearch">
	<input type="text" class="form-control" id="search-box" placeholder="Drug Name" />
	<div id="suggesstion-box"></div> -->
</div> 
					
					 <select id="drug" name="drug" class="form-control form-control-user" onchange="myFunctionn()">
							  <option></option>
									<?php 
											$query1= "SELECT DISTINCT drug, unitcost FROM drugstore";
							  $res=$conn->query($query1);

while($r=mysqli_fetch_row($res))
{ 
   echo '<option data-add="'.$r[1].'" data-con="'.$r[2].'" value='.$r[0].'> '.$r[0].' </option>';
}
	
			
										?>
									 
										
									</select> <br>
					 <select id="drug1" name="drug1" class="form-control form-control-user" onchange="myFunctionn1()">
							  <option></option>
									<?php 
											$query1= "SELECT DISTINCT drug, unitcost FROM drugstore";
							  $res=$conn->query($query1);

while($r=mysqli_fetch_row($res))
{ 
   echo '<option data-add="'.$r[1].'" data-con="'.$r[2].'" value='.$r[0].'> '.$r[0].' </option>';
}
	
			
										?>
									 
										
									</select>
					
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
													<td><input type="text" name="amt" size="2" id="amt" class="form-control" readonly> <br>
														<input type="text" name="amt1" size="2" id="amt1" class="form-control" readonly>
														
														
														
														
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
													<td><input type="number" name="quantity" id="quantity" size="2" class="form-control"><br>
													<input type="number" name="quantity1" id="quantity1" size="2" class="form-control">
													
													</td>
													
													<td><input type="text" size="2" name="amount" id="amount" class="form-control" readonly><br>
													<input type="text" size="2" name="amount1" id="amount1" class="form-control" readonly>	
													
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
													<td> <input type="text" size="10" name="amount45" id="amount45" class="form-control form-control-user"  readonly></td>
												</tr>
												
												<tr>
													<td>
													 TOTAL
													</td>
													<td>
														<strong> <input type="text" name="amount45" id="amount45" class="form-control form-control-user"  readonly></strong>
													</td>
													
												</tr>
												
											</tbody>
										</table>
										<button type="submit" class="btn btn-success btn-block">Preview</button>
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
							
									<?php }} ?>	</div>
					</div>
				
					</form>
				</div>
						
				
			</div>
			<!-- /Main Content -->
	
	


<?php
include('footer.php');
?>