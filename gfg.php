<?php
  
// Get the user id 
$user_id = $_REQUEST['drug'];
  
// Database connection
$con = mysqli_connect("localhost", "root", "", "clinic");
  
if ($user_id !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($con, "SELECT unitcost FROM drugstore WHERE drug='$user_id'");
  
    $row = mysqli_fetch_array($query);
  
    // Get the first name
    $first_name = $row["unitcost"];
  
   
}
  
// Store it in a array
$result = array("$first_name");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>