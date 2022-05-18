<?php 
	$serverName = "efof.myd.infomaniak.com";
	$username = "efof_i19fumluc";
	$password = "Shinra_tensei26";
	$dbName = "efof_i19fumluc";
	$con = new mysqli($serverName, $username, $password, $dbName);

	if($con->connect_error){
		die("Connection failed " . $con->connect_error);
	}
?>