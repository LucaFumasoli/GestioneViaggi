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
			require "application/libs/connection.php";
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

		public function getNumBus(){
			require "application/libs/connection.php";
			$sql = "select numero_bus from bus where id = (select id_bus from viaggio where id = '$this->idViaggio');";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}	
			return $arr;
		}

		public function postiTotali(){
			require "application/libs/connection.php";
			$sql = "select posti_totali from bus where id = (select id_bus from viaggio where id = '$this->idViaggio');";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}	
			return $arr;

		}

		public function postiOccupati(){
			require "application/libs/connection.php";
			$sql = "select count(b.numero_posto) as posti_occupati, t.id as id_tappa
				from tappa t
				left outer join biglietto_tappa bt on bt.id_tappa = t.id
				left outer join biglietto b on b.id = bt.id_biglietto
				where t.id_viaggio = '$this->idViaggio'
				group by t.id
				;
				";
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