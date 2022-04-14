<?php 
	/**
	 * 
	 */
	class VisualizzaTratta{
		
		public $idViaggio;

		function __construct($id_viaggio)
		{
			$this->idViaggio = $id_viaggio;
		}

		public function visualizzaDettgliTratta(){
			require_once "application/libs/connection.php";
			$sql = "select * from tappa where id_viaggio = '$this->idViaggio';";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}	

			return $arr;
		}
	}
?>