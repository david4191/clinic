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



?>

<br><br><br><br><br><br>
<!-- Main Content -->
			<div class="container home">
				

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<div class="table-responsive mb-3">
								<h1 align="center" class="widget-title"><i class="fas fa-file-medical-alt"></i> Book Appointment</h1>	<br>
										<?php
									$name1 = $_GET['id'];
			$getPateintDatas = mysqli_query($conn,"SELECT id, image,number,fname,address,presno,hosno,acct_stat from patient
WHERE
 id='$name1'");
								
	
									
									?>
									
									<?php
		
	while($data = mysqli_fetch_assoc($getPateintDatas)){
		
	
		
		?> 
							
								
								<form method="post">
								<?php
								if(isset($_POST['newet'])){
									$hosnoo =$_POST['hosno'];
									$fname = $_POST['pat_id'];
									$presno = $_POST['time'];
									$hosno = $_POST['date'];
									$acct_stats = $_POST['status'];
									$email = $_POST['reason'];
									$address = $_POST['doctor_id'];
									$createdby	= $_POST['createdby'];
									
									// send into database
		$sendDataNowed = mysqli_query($conn,"insert into appoint (hosno,pat_id,time,date,status,reason,doctor_id,createdby) values ('$hosnoo','$fname','$presno','$hosno','$acct_stats','$email','$address','$createdby')");
									
									if($sendDataNowed){
										echo "success";
									}else{
										echo "failed";
									}
									
									
									echo'
							<script>
							
Swal.fire("Successful!", "Sent  Successfully!", "success") ;

						window.location.href="medical-records-dashboard.php";			
										</script>
							';
		
								}
								
								?>
									<div class="row">
										<input type="hidden" name="pat_id" value="<?php echo $data['id']; ?>" class="form-control">
										
								
										<div class="form-group col-md-6">
										<label>Full Name</label>
										<input type="text" class="form-control" value="<?php echo $data['fname']; ?>" readonly>
									</div>			
										<div class="form-group col-md-6">
										<label>Hospital No.:</label>
										<input type="text" placeholder="E.g. Eye Check" name="hosno" class="form-control" value="<?php echo $data['hosno']; ?>" readonly>
									</div>	
									<div class="form-group col-md-6">
										<label>Time</label>
										<input type="time" name="time" placeholder="Booking Time" class="form-control">
									</div>
										<div class="form-group col-md-6">
										<label >Date</label>
										<input type="date" class="form-control" name="date" placeholder="Booking Date">
										<input type="hidden" name="status" value="pending">
									</div>
											<div class="form-group col-md-6">
										<label>Complaint</label>
										<input type="text" placeholder="E.g. Eye Check" name="reason" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label>Assigned Doctor</label>
										<select name="doctor_id" class="form-control">
									<?php 
											
											$query92= "SELECT id, fname FROM users where acct_type='doctor' " 
											;
											$query_run92= mysqli_query($conn, $query92);
										?>
									 
										<option>-Select-</option>
										<?php 
											
												while($rowss =$query_run92->fetch_assoc())
												{
													$prod= $rowss['fname'];
													$prod12= $rowss['id'];
													
													echo "<option value='$prod12'>$prod</option>";
													}
										?>
										
									
									</select>
									</div>
									
									
									</div>
									
								
										<input type="hidden" name="createdby" value="<?= $_SESSION['username'] ?>" class="form-control">
															
						
									<div class="form-group">
								<button style="color: white;" type="submit" name="newet" class="btn btn-warning btn-block"><i class="fas fa-diagnoses"></i> Book an Appointment</button>
										
											<a style="color: white;" href="medical-records-dashboard.php" class="btn btn-primary btn-block"><i class="fas fa-file-medical-alt"></i> Back</a>
									</div>
									
								</div>
							</form>
						
								
									<?php } ?>
												
								
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
		

			</div>
			<!-- /Main Content -->
			


