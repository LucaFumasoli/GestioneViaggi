<?php
	/**
	 * 
	 */
	class UserInfo
	{
		
		function __construct()
		{
			
		}
		public function checkEmail($email){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				require "application/libs/connection.php";
				$sql = "Select email from utente";
				$result = $con->query($sql);
				$arr = array();
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$arr[] = $row;
					}
				}
				//var_dump($arr);

				for ($i=0; $i < count($arr); $i++) { 
					if($arr[$i]["email"]== $email){
						return false;
					}
				}
				return true;
			}
			return false;
		}
		public function changeUserInfo($nome,$cognome,$email){
			if(!empty($nome)){
				require "application/libs/connection.php";
				$sql = "UPDATE utente SET nome = '$nome' where id = (select id from utente where email = '$email')";
				$con->query($sql);
			}
			if(!empty($cognome)){
				require "application/libs/connection.php";
				$sql = "UPDATE utente SET cognome = '$cognome' where id = (select id from utente where email = '$email')";
				$con->query($sql);
			}
			if(!empty($email)){
				if($this->checkEmail($email)){
					require "application/libs/connection.php";
					$sql = "UPDATE utente SET email = '$email' where id = (select id from utente where email = '$email')";
					$con->query($sql);
				}
			}
		}
	}
?>