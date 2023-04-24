
	<?php

include('dbcon.php');

										
										 if(isset($_POST['edit_btns']))
							                             {
								$number1= $_POST['edit_names'];
							 $stats1 = $_POST['status'];
	 //insert into logintable
	  $sql121= "update appoint set status='$stats1' where id = '$number1'";
	  $query_run1 = mysqli_query($conn,$sql121);
		
											 header('location: doctor-dashboard.php');
										
										 }
										?>		