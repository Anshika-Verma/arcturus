<?php
	$host = 'localhost';
	$user = 'u748365388_new_project';
	$password = 'Project@2023';
	$db_name = 'u748365388_new_project';

	$conn = mysqli_connect($host, $user, $password, $db_name);

	if(!$conn){
		echo "Connection to database failed!";
	}

?>