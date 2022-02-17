<?php 
	/**
	 * 
	 */
	class RicercaViaggi
	{
		private $partenza;
		private $arrivo;
		private $data;
		private $orario;

		function __construct($partenza, $arrivo, $data, $orario)
		{
			$this->partenza = $partenza;
			$this->arrivo = $arrivo;
			$this->data = $data;
			$this->orario = $orario;
		}

		public function ricerca(){
			require_once "application/libs/connection.php";
			$sql = "Select * from viaggio";
			$result = $con->query($sql);
			/*if($result){
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					echo $row["localita_partenza"];
				}	
			}*/

			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
				var_dump($arr);
			}	

		
			

		}
	}

?>
