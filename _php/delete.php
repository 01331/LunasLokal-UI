<?php
	$id=$_GET['id'];
	include('config.php');
	mysqli_query($link,"delete from `url` where urlID='$id'");
	header('location:../security/security.php');
?>