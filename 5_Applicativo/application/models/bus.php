<?php 
	/**
	 * 
	 */
	class Bus
	{
		private $linea;
		private $numeroPosti;

		function __construct($linea, $numeroPosti)
		{
			$this->linea = $linea;
			$this->numeroPosti = $numeroPosti * 20 + 20;
		}
		
	    public function checkEmptyField() {
	        return ($this->linea != null); 
	    }
		
	    public function getName() {
	        return $this->linea; 
	    }
		
	    public function getPlaces() {
	        return $this->numeroPosti; 
	    }

		public function getBusses(){
			require_once "application/libs/connection.php";
			$sql = "Select id,posti_totali,numero_bus from bus";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}		
			return $arr;
		}

		public function insertBus() {
        	require "application/libs/connection.php";
			$sql = "INSERT INTO bus (posti_totali, numero_bus) VALUES ($this->numeroPosti, $this->linea)";
			$result = $con->query($sql);
			return $result;
		}
	}

?>