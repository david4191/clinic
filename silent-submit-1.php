

<?php
include('dbcon.php');
?>


<?php

if(isset($_POST['submitnow'])){
			
		$pat_idd = $_POST['pat_id'];
												$hosno1 = $_POST['hosno'];
												$doc_idd = $_POST['doc_id'];
												$comps = $_POST['gest'];
												$date = $_POST['date'];
												
											//send to base
												
$sendToDataBa = mysqli_query($conn,"insert into gestro (pat_id,hosno,doc_id,date,gest) values ('$pat_idd','$hosno1','$doc_idd','$date','$comps')");
					echo "
					
				
				<script>	window.location.href='doctor-dashboard.php';
				
				</script>
					
					
					";						
						
	
	
	
	
	
}
?>

