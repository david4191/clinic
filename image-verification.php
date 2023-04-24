<?php

include('header.php');
include('medic-pat-nav.php');
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

<style>
#my_camera{
 width: 320px;
 height: 240px;
 border: 1px solid black;
}
</style>

<div class="container">

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Capture Image
							
							</h3>
						
							<!---- DIV THAT DISPLAYS IMAGE -->	
			<br><center><div id="camera" style="height:auto;width:auto; text-align:left;"></div><br>
    <input  class="btn btn-sm btn-primary" type="button" value="Take a Snap" id="btPic" 
		   onclick="captureimage()" /> </center> <div id="results"> </div>
			
			&nbsp;	<center><a  href="new-patient.php" class="btn btn-md btn-success">Back to New Patient registration</a></center>	
							
						<br>	
							
							
							<!-- Webcam.min.js -->
<script type="text/javascript" src="js/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script>
    // CAMERA SETTINGS.
    Webcam.set({
        width: 390,
        height: 290,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    Webcam.attach('#camera');

  /**  // TAKE A SNAPSHOT.
    takeSnapShot = function () {
        Webcam.snap(function (data_uri) {
           downloadImage('image', data_uri);
        });
    }

    
	*/
	// Webcam.attach( '#webcam' );
       function captureimage() {
           // take snapshot and get image data
           Webcam.snap( function(data_uri) {
               // display results in page
                
                    
               Webcam.upload( data_uri, 'saveimage.php', function(code, text) {
                   document.getElementById('results').innerHTML = 
                   '<h2 style="text-align:center;font-size:13px; color:green;">Preview Image:</h2>' + 
                   '<center><img src="'+text+'" width="200px" height="150px"/></center>';
               } );    
           } );
       }

</script>
	
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
			</div>
	


		

<?php
include('footer.php');
?>