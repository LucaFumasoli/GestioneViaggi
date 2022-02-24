<?php 
/**
 * 
 */
class CheckRegisterParameter
{
	private $email;
	private $password;
	private $nome;
	private $cognome;
	private $repeatedPassword;

	function __construct($email, $password, $nome, $cognome, $repeatedPassword)
	{
		$this->password = $password;
		$this->email = $email;
		$this->nome = $nome;
		$this->cognome = $cognome;
		$this->repeatedPassword =  $repeatedPassword;
	}
	public function checkEmail(){

		if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
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
				if($arr[$i]["email"]== $this->email){
					return false;
				}
			}
			return true;
		}
		return false;
	}
	public function checkEmptyField(){
		if (isset($this->$nome) && isset($this->cognome)) {
			return true;
		}
		return false;
	}
	public function checkPassword(){
		if (strlen($this->password) >= 8) {
			if ($this->password === $this->repeatedPassword) {
				return true;
			}
		}
		return false;
	}
	public function insertUser(){
		require "application/libs/connection.php";
		$sql = "INSERT INTO utente (nome, cognome, password,email) VALUES ('$this->nome', '$this->cognome', '$this->password', '$this->email')";
	}

}
	
?>