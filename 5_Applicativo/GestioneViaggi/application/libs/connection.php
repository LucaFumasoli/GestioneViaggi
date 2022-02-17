<?php 
	$serverName = "localhost";
	$username = "root";
	$password = "";
	$dbName = "GestioneViaggi";
	$con = new mysqli($serverName, $username, $password, $dbName);
	if($con->connect_error){
		die("Connection failed " . $con->connect_error);
	}
?>