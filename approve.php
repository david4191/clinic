<?php
		include('dbcon.php');								
										 if(isset($_POST['edit_btn']))
							                             {
								$number= $_POST['edit_name'];
							 $stats = $_POST['status'];
	 //insert into logintable
	  $sql12= "update appoint set status='$stats' where id = '$number'";
	  $query_run = mysqli_query($conn,$sql12);
											
		header("location: doctor-dashboard.php");
										
										 }
										?>			