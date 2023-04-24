<?php

include('header.php');
include('pharm-drug-nav.php');
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

?>

<div class="container mt-0">
				<div class="row breadcrumb-bar">
					<div class="col-md-6">
						<h3 class="block-title">Drug Store</h3>
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
							<h3 class="widget-title"><i class="fas fa-book-medical"></i> Categories &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="new-category.php" style="position: relative;left: 750px;border: thin; color: white; padding: 6px; font-size: 12px; text-transform: uppercase;"  class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> New Category</a>
								
							
							
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
									$getPateinter = mysqli_query($conn,"select drug_category.cate as cate, drug_category.id, drugstore.id as id, drugstore.cat_id, drugstore.drug as drugname, drugstore.regno as reg_no, drugstore.qty as qty,sum(drugstore.qty) as tot, drugstore.unitcost as unitcost,drugstore.createdby as createdby from drug_category, drugstore
WHERE 
drugstore.cat_id = drug_category.id
group by drug_category.cate asc");
								
	
									
									?>
									
									<thead>
										<tr>
											<th></th>
											<th>Category</th>
											<th>Stock Qty</th>
											</tr>
									</thead>
									<?php
		
												
	while($daster = mysqli_fetch_assoc($getPateinter)){
		
	
		
		?>
									
									<tbody>
										
										<tr>
									
											<td><i class="fas fa-arrow-alt-circle-up"></i></td>
											<td><?php echo $daster['cate']; ?></td>
											<td><?php 
		
						
		
			echo $daster['tot'];

		
		 ?></td>
											
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
							<h3 class="widget-title"><i class="fas fa-pills"></i> Drug Store &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
								
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
										<input type="text" placeholder="Unit Cost" name="unitcost" class="form-control" id="amount">
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
											<td>₦<?php echo $daster['unitcost']; ?></td>
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
	
	
			</div>


<?php
include('footer.php');
?>