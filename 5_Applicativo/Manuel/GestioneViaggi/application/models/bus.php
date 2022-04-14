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

		public function insertBus() {
        	require "application/libs/connection.php";
			$sql = "INSERT INTO bus (posti_totali, numero_bus) VALUES ($this->numeroPosti, $this->linea)";
			$con->query($sql);
		}
	}

?>