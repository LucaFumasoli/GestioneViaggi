<?php 
/**
 * 
 */
class CheckUser
{
	private $email;
	private $password;
	function __construct($email, $password)
	{
		$this->password = $password;
		$this->email = $email;
	}
	public function checkIfIsRegistered(){
		require "application/libs/connection.php";
		$sql = "Select nome,cognome,admin from utente where password = '$this->password' AND email = '$this->email'";
		$result = $con->query($sql);
		print_r($result);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			echo $row["nome"];
			echo $row["cognome"];
			if($row["admin"] == 1){
				$_SESSION['isAdmin'] = true;
			}
			return $row;
		}else{
			return "false";
			$_SESSION['isAdmin'] = false;
		}
	}
}
	
?>