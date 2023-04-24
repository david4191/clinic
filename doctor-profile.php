<?php

include('header.php');
include('dbcon.php');
include('doc-prof-nav.php');


?>

<div class="container mt-0">
					<div class="row breadcrumb-bar">
						<div class="col-md-6">
							<h3 style="text-transform: uppercase;" class="block-title">Hi <?= $_SESSION['username'] ?></h3>
						</div>
						<div class="col-md-6">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="doctor-dashboard.php">
										<span class="ti-home"></span>
									</a>
								</li>
								<li class="breadcrumb-item">My profile</li>
								<li class="breadcrumb-item active">Profile Details</li>
							</ol>
						</div>
					</div>
				</div>
<!-- Main Content -->
			<div class="container">

                <div class="row">
                    <!-- Widget Item -->
                    <div class="col-md-12">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">My profile</h3>
                           <?php
	$getUserData = mysqli_query($conn,"select * from users where username='".$_SESSION['username']."'");
								while($rows = mysqli_fetch_assoc($getUserData)){
									
	
										?>
							
							<div class="row no-mp">
								
                                <div class="col-md-4">
									
                                    <div class="card mb-4">
										<?php echo '<img src="images/'.$rows['image'].'" class="card-img-top"  alt="profile image" >' ?>
                                        <div class="card-body">
											
                                            <h4 class="card-title"> <?php echo $rows['fname']; ?>  </h4>
                                            <p class="card-text">
											<?php echo $rows['note']; ?>
											</p>
											<button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModalCenter"><span class="ti-pencil-alt"></span>
									Edit Profile
								</button>
											<button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#exampleModal">
									Upload Photo
								</button>	
									<!-- Modal Popup-->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Upload profile Image</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="post" class="widget-form" enctype="multipart/form-data">
								<?php
								
								if(isset($_POST['updated'])){
									
	$username = $_SESSION['username'];
				
				
  $name = $_FILES['file']['name'];
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
	  $update = mysqli_query($conn,"update users set image='".$name."' where username='$username'");
	  
	  echo'
							<script>
							
Swal.fire("Successful!", "Updated Successfully!", "success") ;

									
										</script>
							';
    
     // Upload file
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

  }
									header("location: doctor-profile.php");
		
		
		
	
	
								}
								
								
								?>
								<!-- form-group -->
													  
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Profile Iamge</label>
										<input type="file" name="file" placeholder="File Upload" class="form-control">
										
										<input type="hidden" name="username" value="<?= $_SESSION['username'] ?>" >
									</div>
								</div>
								<!-- /.form-group -->
								
								<!-- Login Button -->			
								<div class="button-btn-block">
									<button type="submit" name="updated" class="btn btn-primary btn-lg btn-block">Update Profile</button>
								</div>
								<!-- /Login Button -->	
								<!-- Links -->	
							
								<!-- /Links -->
							</form>
					
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												
											</div>
										</div>
									</div>
								</div>
								<!-- /Modal Popup-->		
										<!-- Modal Popup-->
								<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="post" class="widget-form">
								<?php
								
								if(isset($_POST['update'])){
									
	$username = $_SESSION['username'];
				$fname = $_POST['fname'];
				$gender = $_POST['gender'];
				$dob = $_POST['dob'];
				$email = $_POST['email'];
				$specs = $_POST['specs'];
				$exper = $_POST['exper'];
				$note = $_POST['note'];
				$address = $_POST['address'];
				$number = $_POST['number'];
									$password = $_POST['password'];
				
  
 
     // Insert record
	  $updated = mysqli_query($conn,"update users set fname='$fname', gender='$gender', dob='$dob', email='$email', specs='$specs', exper='$exper', note='$note', address='$address', number='$number', password='$password' where username='$username'");
	  
	  echo'
							<script>
							
Swal.fire("Successful!", "Updated Successfully!", "success") ;

									
										</script>
							';
    
									//header("location: doctor-profile.php");
		
		
		
	
	
								}
								
								
								?>
										<input type="hidden" name="username" value="<?= $_SESSION['username'] ?>" >
								
													<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Full Name</label>
										<input type="text" name="fname" placeholder="Full Name" class="form-control">
									</div>
								</div>
								<!-- /.form-group -->
													<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Gender</label>
										<select name="gender" class="form-control" >
										<option>- Choose -</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										
									</div>
								</div>
								<!-- /.form-group -->
									<div class="form-group row">
												
									<div class="col-sm-12">
										<label>Date Of Birth</label>
										<input type="date" class="form-control" name="dob">
										
									</div>
								</div>
								<!-- /.form-group -->
<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Email</label>
										<input type="text" name="email" placeholder="Email" class="form-control">
									</div>
								</div>
								<!-- /.form-group -->
													<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Specialization</label>
										<input type="text" name="specs" placeholder="Specialization" class="form-control" >
									</div>
								</div>
													<div class="form-group row">
									<div class="col-sm-12">
										<label>Phone Number</label>
										<input type="text" name="number" placeholder="Mobile number" class="form-control">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Experience</label>
										<input type="text" name="exper" placeholder="years of experience" class="form-control">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label>Password</label>
										<input type="password" placeholder="Password" name="password" class="form-control" data-validation="strength" data-validation-strength="2"
										 data-validation-has-keyup-event="true">
									</div>
								</div>
								<!-- /.form-group -->
													<div class="form-group row">
									<div class="col-sm-12">
										<label>About You</label>
										<textarea class="form-control" name="note" placeholder="Description"></textarea>
									</div>
								</div>
								<!-- /.form-group -->
													<!-- /.form-group -->
													<div class="form-group row">
									<div class="col-sm-12">
										<label>Address</label>
										<textarea class="form-control" name="address" placeholder="your address"></textarea>
									</div>
								</div>
								<!-- /.form-group -->
								
								<!-- Login Button -->			
								<div class="button-btn-block">
									<button type="submit" name="update" class="btn btn-primary btn-lg btn-block">Update Profile</button>
								</div>
								<!-- /Login Button -->	
								<!-- Links -->	
							
								<!-- /Links -->
							</form>
					
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												
											</div>
										</div>
									</div>
									<!-- /.col-sm-9 -->
								</div>
								<!-- /Modal Popup-->
                                        </div>
										
                                    </div>
									
                                </div>
								
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Specialization</strong></td>
                                                    <td><?php echo $rows['specs']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Experience</strong></td>
                                                    <td><?php echo $rows['exper']; ?> Years</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gender</strong></td>
                                                    <td><?php echo $rows['gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Address</strong></td>
                                                    <td><?php echo $rows['address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone</strong> </td>
                                                    <td><?php echo $rows['number']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Date Of Birth</strong> </td>
                                                    <td><?php echo $rows['dob']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email</strong></td>
                                                    <td><?php echo $rows['email']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--Export links-->
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center export-pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><span class="ti-download"></span> csv</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><span class="ti-printer"></span> print</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <!-- /Export links-->
                                    </div>
                                </div>
                            </div>
               <?php } ?>
                        </div>
                    </div>
                    <!-- /Widget Item -->
                    <!-- Widget Item -->
                   
                    <!-- /Widget Item -->
                </div>
			</div>
			<!-- /Main Content -->
		<br><br><br><br><br>	

<?php
include('footer.php');
?>