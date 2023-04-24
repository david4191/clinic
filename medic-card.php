<?php

include('header.php');
include('medic-patcard-nav.php');
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

<div class="container home">
			
	
	<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Card</h3>							
							<div class="table-responsive mb-3">
							<div class="proclinic-widget">
								
									<?php
									$name1 = $_GET['id'];
									$getPateintDatas = mysqli_query($conn,"SELECT image,number,fname,address,id,presno,hosno,acct_stat,day(patient.datecreated) as day, month(patient.datecreated) as month, year(patient.datecreated) as year from patient
WHERE
createdby ='".$_SESSION['username']."' and id='$name1'");
								
	
									
									?>
									
									<?php
		if(mysqli_num_rows($getPateintDatas) >0)
											{
												
	while($data = mysqli_fetch_assoc($getPateintDatas)){
		
	
		
		?> 
							
								<div id="printableTable">
											
											<div style="position: relative; left: 200px ;border: solid; padding: 12px; margin: 0; border-radius: 8px; width: 629px; height: 230px;">
									<p style="font-weight: bold; padding: 0;margin: 0; text-align: center"><img style="" src="images/DSS-Logo.png"  width="30px" height="25px">
										 DSS MEDICAL CENTER, ABUJA.</p><br>
												
											
								
								
								
								
								
								<div class="row">
										<div class="col-sm-6">
													<br>
													
											
											<?php echo '<img src="'.$data['image'].'" class="img-circle" width="90px" height="85px" alt="image" style="position: relative;left: 138px; bottom: 16px; padding: 4px;border:thin" >'; ?>
											
											
											<br><p style="font-size: 12px; position: relative; left:124px; top:-17px">Pres No.:
												<?php echo $data['presno']; ?></p>
													</div>
										<div class="col-sm-6" style="border:thin; border-radius: 4px; font-size: 14px;position: relative;top: 10px">
												<p style="padding: 0; margin: 0;"><b>Name: </b> <?php echo $data['fname']; ?></p>
												<p style="padding: 0; margin: 0;"><b>Address: </b><?php echo $data['address']; ?></p>
												<p style="padding: 0; margin: 0;"><b>Hospital No.: </b><?php echo $data['hosno']; ?></p>
												<p style="padding: 0; margin: 0;"><b>Mobile No.: </b><?php echo $data['number']; ?></p>
												
												</div>
								</div>
									<br><br>
									
								</div>	
								 <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
								
								
<script type="text/javascript">
  function printDiv() {
         window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
         window.frames["print_frame"].window.focus();
         window.frames["print_frame"].window.print();
       }
</script>

								</div>
								
									<?php }} ?>
								
								
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