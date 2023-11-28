<?php
	include('config.php');
 
	$urlName=$_POST['urlName'];
	$url=$_POST['url'];
 
	mysqli_query($link,"insert into `url` (urlName,url) values ('$urlName','$url')");
	header('location:../security/security.php');
 
?>