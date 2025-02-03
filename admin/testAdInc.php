<?php
include 'connection.php';
if(isset($_GET['deleteid']))
{
	$id=$_GET['deleteid'];
	
	$sql="delete from `traineritest` where id=$id";
	$result=mysqli_query($con,$sql);
	if($result)
	{
		header('location:altTest.php');
		
	}else{
		die(mysqli_error($con));
	}
}
?>