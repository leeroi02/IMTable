<?php 
	$connection = new mysqli('localhost', 'root','','dbOratef3');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>