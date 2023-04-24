<?php

include('header.php');
include('medic-pat-nav.php');
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
						<h3 class="block-title">Patient Log</h3>
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

	<div class="container">

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Edit Patient
							<a href="image-verification.php" class="btn btn-warning btn-sm" style="float: right;border: thin; color: white; padding: 6px; font-size: 12px; text-transform: uppercase;">Image Verification</a>
							</h3>
							<form method="post" enctype="multipart/form-data">
								<?php
								if(isset($_POST['new'])){
									$name = $_SESSION['location'];

									$fname = $_POST['fname'];
									$presno = $_POST['presno'];
									$hosno = $_POST['hosno'];
									$acct_stats = $_POST['acct_stat'];
									$category= $_POST['category'];
									$email = $_POST['email'];
									$address = $_POST['address'];
									$dob = $_POST['dob'];
									$gender = $_POST['gender'];
									$mstats = $_POST['mstats'];
									$country = $_POST['country'];
									$number = $_POST['number'];
									$occupation = $_POST['occupation'];
									$kname = $_POST['kname'];
									$relat = $_POST['relat'];
									$knumb = $_POST['knumber'];
									$kaddress = $_POST['kaddress'];
									$createdby	= $_POST['createdby'];
									
									// send into database
		$sendDataNowed = mysqli_query($conn,"insert into patient (image,fname,presno,hosno,acct_stat,category,email,address,dob,gender,mstats,country,number,occupation,kname,relat,knumber,kaddress,createdby) values ('".$name."','$fname','$presno','$hosno','$acct_stats','$category','$email','$address','$dob','$gender','$mstats','$country','$number','$occupation','$kname','$relat','$knumb','$kaddress','$createdby')");
									
		$sendDataNowLet = mysqli_query($conn,"insert into pat_details (presno,hosno) values ('$presno','$hosno')");
									
									
									
									
									echo'
							<script>
							
Swal.fire("Successful!", "Sent  Successfully!", "success") ;

									
										</script>
							';
		
								}
								
								?>
									
								<div class="form-row">
									<div class="form-group col-md-12">
							<center><img src="<?php if(isset($_SESSION['picture'])){ echo $_SESSION['picture']; $_SESSION['location'] = $_SESSION['picture']; unset($_SESSION['picture']); } else{echo 'images/user1.png'; }?>" name='passport'></center>
									</div></div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Patient Name</label>
										<input type="text" name="fname" class="form-control" placeholder="Patient name">
									</div>
									<div class="form-group col-md-6">
										<label>Pres No.:</label>
										<input type="text" name="presno" placeholder="Pres No.:" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label >Hospital No.:</label>
										<input type="text" class="form-control" name="hosno" placeholder="Hospital Number">
									</div>
									<div class="form-group col-md-6">
										<label>Email</label>
										<input type="email" placeholder="Email" name="email" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label>Account Status</label>
										<select class="form-control" name="acct_stat">
											<option selected>- select -</option>
											<option value="DSS STAFF">DSS STAFF</option>
											<option value="Private">Private</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Date Of Birth</label>
										<input type="date" name="dob" placeholder="Date of Birth" class="form-control">
									</div>
									<hr />
									<div class="form-group col-md-6">
										<label for="age">Marital Status</label>
										<input type="text" name="mstats" placeholder="Marital Status" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label for="phone">Phone</label>
										<input type="text" name="number" placeholder="Phone Number" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label for="email">Country</label>
										<input type="text" placeholder="Country" name="country" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label for="gender">Gender</label>
										<select class="form-control" name="gender">
											<option selected>- select -</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="gender">Patient Type</label>
										<select class="form-control" name="category">
											<option selected>- select -</option>
											<option value="In">In Patient</option>
											<option value="Out">Out Patient</option>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">Address</label>
										<textarea placeholder="Address" name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
									</div>
									<!---<div class="form-group col-md-12">
										<label for="file">File</label>
										<input type="file" class="form-control" name="file">
									</div> -->
									<div class="form-group col-md-12">
										<label for="age">Occupation</label>
										<input type="text" name="occupation" placeholder="Occupation" class="form-control">
									</div>
									
									
									<div class="form-group col-md-6">
										<label for="patient-name"> Next of Kin </label>
										<input type="text" name="kname" class="form-control" placeholder="Name">
									</div>
									<div class="form-group col-md-6">
										<label for="dob">Relationship</label>
										<input type="text" name="relat" placeholder="" class="form-control">
									</div>
										<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">Phone No.</label>
										<input type="text" name="knumber" placeholder="Phone Number" class="form-control" id="phone">
									</div>
										<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">Address</label>
										<textarea placeholder="Address" name="kaddress" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
									</div>
									<br><br>
									
										<input type="hidden" name="createdby" value="<?= $_SESSION['username'] ?>" class="form-control">
															
									<div class="form-check col-md-12 mb-2">
										<div class="text-left">
											<div class="custom-control custom-checkbox">
												<input class="custom-control-input" type="checkbox" id="ex-check-2" required>
												<label class="custom-control-label" for="ex-check-2">Please Confirm</label>
											</div>
										</div>
									</div>
									<div class="form-group col-md-6 mb-3">
										<button type="submit" name="new" class="btn btn-primary btn-lg">Create New Patient</button>
									</div>
								</div>
							</form>
						
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
			</div>
			

<?php
include('footer.php');
?>