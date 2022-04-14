<?php 
	/**
	 * 
	 */
	class RicercaViaggi
	{
		private $linea;
		private $numeroPosti;

		function __construct($linea, $numeroPosti)
		{
			if (is_null($linea)) {

			}
			$this->linea = $linea;
			$this->numeroPosti = $numeroPosti;
		}
		
	    public function checkEmptyField() {
	        return isset($this->$linea);
	    }

		public function insertBus() {
        	require "application/libs/connection.php";
			$sql = "INSERT INTO bus (posti_totali, numero_bus) VALUES ($this->numeroPosti, $this->linea)";
		}
	}

?>