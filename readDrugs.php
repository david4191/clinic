<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM patient WHERE fname like '" . $_POST["keyword"] . "%' ";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["fname"]; ?>');"><?php echo $country["fname"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>