<?php
	/**
	 * 
	 */
	class Users
	{
		
		function __construct()
		{
			
		}
		public function getUsers(){
			require_once "application/libs/connection.php";
			$sql = "Select nome,cognome,email,id from utente";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}		
			return $arr;
		}
		public function filtra($filterName,$filterSurname,$arrUsers){
			$newArrayUsers = [];
			if($filterName == "" && $filterSurname == ""){
				return $arrUsers;
			}else{
				for ($i=0; $i < count($arrUsers); $i++) {
					if($filterSurname == ""){
						echo "<script>console.log(".substr($arrUsers[$i]["nome"], 0, strlen($filterName)).")</script>";
						if(substr($arrUsers[$i]["nome"], 0, strlen($filterName)) == $filterName){
							$newArrayUsers[] =  $arrUsers[$i];
						}
					}elseif ($filterName == "") {
						if(substr($arrUsers[$i]["cognome"], 0, strlen($filterSurname)) == $filterSurname){
							$newArrayUsers[] =  $arrUsers[$i];
						}
					}else{
						if(substr($arrUsers[$i]["nome"], 0, strlen($filterName)) == $filterName && substr($arrUsers[$i]["cognome"], 0, strlen($filterSurname)) == $filterSurname){
							$newArrayUsers[] =  $arrUsers[$i];
						}
					}
					
				}
			}
			return $newArrayUsers;
			
		}
	}
?>