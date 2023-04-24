<?php

if(!isset($_SESSION)){
	session_start();
}
include('dbcon.php');
?>

<?php
 
//set random name for the image, used time() for uniqueness


$filename =  time() . '.jpg';
$filepath = 'images/';

if(!is_dir($filepath))
	mkdir($filepath);
if(isset($_FILES['webcam'])){	
	
	  // Upload file
     move_uploaded_file($_FILES['webcam']['tmp_name'],$filepath.$filename);
	$newfilepath=$filepath.$filename;
	
	
	 // Insert record
     $query = "insert into pics(image) values('".$newfilepath."')";
     mysqli_query($conn,$query);
  
   $_SESSION['picture'] = $filepath.$filename;
	
	echo $filepath.$filename;

}


?>
