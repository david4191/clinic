<?php

include('header.php');
?>

<!-- Pre Loader -->
	<div class="loading">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!--/Pre Loader -->
	
	<div class="wrapper">
		<!-- Page Content  -->
		<div id="content">
			<br><br><br><br>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 auth-box">
						<!--<img src="images/DSS-Logo.png" width="100px" height="95px">---><br>
						<div class="proclinic-box-shadow">
							
							
							
							
							<h3 class="widget-title">Login</h3>
							<form method="post" class="widget-form">
								<?php
								include("dbcon.php");
								if(isset($_POST['login'])){
									$email= $_POST['username'];
	$password  = $_POST['password'];
	$sql = "SELECT * FROM users WHERE username=? AND password=?";
	
	$stmt=$conn->prepare($sql);
	$stmt->bind_param("ss", $email,$password);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	
	session_regenerate_id();
	$_SESSION['username'] = $row['username'];
	$_SESSION['acct_type'] = $row['acct_type'];
	session_write_close();
	
	if($result->num_rows==1 && $_SESSION['acct_type']=="doctor"){
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="doctor-dashboard.php";
										</script>
							';
		
		
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="pharmacist"){
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="pharmacy-dashboard.php";
										</script>
							';
		
		
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="account"){
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="account.php";
										</script>
							';
		
		
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="nurse"){
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="nurse-dashboard.php";
										</script>
							';
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="physiotherapist"){
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="physio-dashboard.php";
										</script>
							';
		
		
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="radiologist"){
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="radio-dashboard.php";
										</script>
							';
		
		
		
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="lab attendant"){
		
		echo'
							<script>
							
Swal.fire("Successful!", "Logged-In Successfully!", "success") ;

									window.location.href="lab-dashboard.php";
										</script>
							';
		
	
	}
	else if($result->num_rows==1 && $_SESSION['acct_type']=="medical record"){
		
		header("location: medical-records-dashboard.php");
	}
	else{
		$msg ="Username or Password Incorrect";
	}
								}
								
								
								?>
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<input name="username" placeholder="Username" class="form-control" required="" data-validation="length alphanumeric" data-validation-length="3-12"
										 data-validation-error-msg="User name has to be an alphanumeric value (3-12 chars)" data-validation-has-keyup-event="true">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Password" name="password" class="form-control" data-validation="strength" data-validation-strength="2"
										 data-validation-has-keyup-event="true">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- Check Box -->		
								<div class="form-check row">
									<div class="col-sm-12 text-left">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="ex-check-2" checked>
											<label class="custom-control-label" for="ex-check-2">Remember Me</label>
										</div>
									</div>
								</div>
								<!-- /Check Box -->	
								<!-- Login Button -->			
								<div class="button-btn-block">
									<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Login</button>
								</div>
								<!-- /Login Button -->	
								<!-- Links -->	
							
								<!-- /Links -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content  -->
	</div>
	<!-- Jquery Library-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!-- Popper Library-->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Library-->
	<script src="js/bootstrap.min.js"></script>
	<!-- Custom Script-->
	<script src="js/custom.js"></script>
</body>

</html>