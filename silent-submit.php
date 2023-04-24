

<?php
include('dbcon.php');
?>


<?php

if(isset($_POST['submitnow1'])){
			
		$pat_idd = $_POST['pat_id'];
												$hosno1 = $_POST['hosno'];
												$doc_idd = $_POST['doc_id'];
												$comps = $_POST['test'];
												$date = $_POST['date'];
												
											//send to base
												
$sendToDataBa = mysqli_query($conn,"insert into testro (pat_id,hosno,doc_id,date,test) values ('$pat_idd','$hosno1','$doc_idd','$date','$comps')");
					echo "
					
				
				<script>	window.location.href='doctor-dashboard.php';
				
				</script>
					
					
					";						
						
	
	
	
	
	
}
?>

