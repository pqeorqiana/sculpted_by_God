<?php
$con = new mysqli('localhost', 'root', '', 'sport_database');
if (!$con) {
	die(mysqli_error($con));
}
?>