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
	public function checkEmptyName(){
		if (!empty($this->nome)) {
			return true;
		}
		return false;
	}
	public function checkEmptySurname(){
		if (!empty($this->cognome)) {
			return true;
		}
		return false;
	}
	public function checkPassword(){
		$up = 0;
		$low = 0;
		$num = 0;
		if (strlen($this->password) >= 8) {
			if ($this->password === $this->repeatedPassword) {
				for ($i=0; $i < strlen($this->password); $i++) { 
					if(ctype_upper($this->password[$i])){
						$up++;
					}elseif(ctype_digit($this->password[$i])){
						$num++;
					}elseif(ctype_lower($this->password[$i])){
						$low++;
					}
				}
				if($low > 0 && $up > 0 && $num > 0){
					return true;
				}
			}
		}
		return false;
	}
	public function insertUser(){
		require "application/libs/connection.php";
		if($_SESSION['createAdmin']){
			$sql = "INSERT INTO utente (nome, cognome, password,email,admin) VALUES ('$this->nome', '$this->cognome', '$this->password', '$this->email',1)";
			$result = $con->query($sql);
			return $result;
		}else{
			$sql = "INSERT INTO utente (nome, cognome, password,email,admin) VALUES ('$this->nome', '$this->cognome', '$this->password', '$this->email',0)";
			$con->query($sql);
		}
		
	}

}
	
?>