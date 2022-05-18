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
		public function changeUserInfo($nome,$cognome,$newEmail,$email){
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
			require "application/libs/connection.php";
			$sql = "UPDATE utente SET email = '$newEmail' where id = (select id from utente where email = '$email')";
			$con->query($sql);
		}
		public function getFactures($email){
			require "application/libs/connection.php";
			$sql = "Select id from utente where email = '$email'";
			$id = $con->query($sql);
			$id = $id->fetch_assoc();
			$id = $id['id'];
			$sql2 = "Select id,data FROM biglietto where id_utente = '$id'";
			$numFatture = $con->query($sql2);
			$arr = array();
			if($numFatture->num_rows > 0){
				while($row = $numFatture->fetch_assoc()){
					$arr[] = $row;
				}
			}
			return $arr;
		}
	}
?>