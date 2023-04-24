<?php

include('header.php');
include('pharm-drug-nav.php');
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
						<h3 class="block-title">Drug Category</h3>
					</div>
					<div class="col-md-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="pharmacy-dashboard.php">
									<span class="ti-home"></span>
								</a>
							</li>
							<li class="breadcrumb-item active">Drug Category</li>
						</ol>
					</div>
				</div>
			</div>



<div class="container home">
	
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title"><i class="fas fa-plus"></i> New Category
							
								
							
							</h3>
							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-bordered table-striped">
									<form method="post">
										<?php
										if(isset($_POST['drug'])){
										$cate = $_POST['cate'];
										//database
										$sendCategory = mysqli_query($conn,"insert into drug_category(cate) values ('$cate')");
											echo'
							<script>
							
Swal.fire("Successful!", "Sent  Successfully!", "success") ;

									
										</script>
							';
										}
										?>
									<tbody>
										
										<tr>
											<td>
											
											</td>
											<td><input type="text" name="cate" placeholder="Drug Category" class="form-control"></td>
											<td><input type="submit" name="drug" placeholder="Blood Pressure" class="btn btn-secondary btn-block "></td>
											
											<td>
												
												
											</td>
										</tr>
										</tbody>
								</form>
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
							<h3 class="widget-title"><i class="fas fa-archive"></i> Drug's Category
							
								
							
							</h3>
							<form method="post">
									<div class="form-group col-md-4">
										<input type="search" name="fname" class="form-control" placeholder="Drug Category" required>
										<button class="btn btn-success btn-block" name="search"><i class="fa fa-glass"></i> Search</button>
									</div>
									
									
								</form>	
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-bordered table-striped">
									<?php
									$getPateintDatad = mysqli_query($conn,"select drug_category.cate as cate, drug_category.id as id, (drugstore.id), drugstore.cat_id, drugstore.drug as drugz, drugstore.regno, drugstore.qty as qty, drugstore.unitcost from drug_category, drugstore
WHERE 
drugstore.cat_id = drug_category.id");
									
									?>
									<thead>
										<tr>
											
											<th align="center"></th>
											<th>Drugs</th>
											<th>Category</th>
										
											<th>Total Drugs</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										while($data = mysqli_fetch_assoc($getPateintDatad)){
										
									?>
										<tr>
										
											<td align="center"><i class="fas fa-arrow-alt-circle-up"></i></td>
											<td><?php echo $data['drugz']; ?></td>
											<td><?php echo $data['cate']; ?></td>
											<td>
												
												<?php echo $data['qty']; ?>
											</td>
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