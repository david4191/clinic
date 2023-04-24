<?php
include('dbcon.php');

$searchTerm = $_GET['term'];

$select =mysql_query($conn,"SELECT * FROM drugstore WHERE drug LIKE '%".$searchTerm."%'");
while ($row= mysql_fetch_array($select)) 
{
 $data[] = $row['drug'];
}
//return json data
echo json_encode($data);

?>