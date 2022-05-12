<?php 
	/**
	 * 
	 */
	class RicercaViaggi
	{
		private $partenza;
		private $arrivo;
		/*private $data;
		private $orario;*/
		private $data_orario;

		function __construct($partenza, $arrivo, $data, $orario)
		{
			$this->partenza = $partenza;
			$this->arrivo = $arrivo;
			/*$this->data = $data;
			$this->orario = $orario;*/
			$this->data_orario = $data . " " . $orario;
		}

		public function ricerca(){
			require_once "application/libs/connection.php";
			//order orario
			//$sql = "Select * from tappa where localita_arrivo = '$this->arrivo' OR localita_partenza = '$this->partenza' ORDER BY orario_arrivo ;";
			$sql = "Select 
				    t4.*, bus.numero_bus
				FROM
				    (SELECT 
				        t2.localita_partenza,
						t2.id AS id_partenza,
						t3.localita_arrivo,
						t3.id AS id_arrivo,
						t2.id_viaggio,
						t2.orario_partenza,
						t3.orario_arrivo
				    FROM
				        tappa t2, tappa t3, (
							SELECT 
							MIN(t1.id) AS id_partenza,
				            MAX(t1.id) AS id_arrivo,
				            t1.id_viaggio
							FROM
								tappa t1
							WHERE
								t1.id_viaggio IN (
									SELECT DISTINCT t0.id_viaggio
									FROM tappa t0
									WHERE t0.localita_arrivo = '$this->arrivo' OR t0.localita_partenza = '$this->partenza'
									ORDER BY t0.orario_arrivo
				                    )
								AND t1.localita_arrivo = '$this->arrivo'
								OR t1.localita_partenza = '$this->partenza'
							GROUP BY t1.id_viaggio) t11
						WHERE t2.id = t11.id_partenza AND t3.id = t11.id_arrivo) t4
					left OUTER join viaggio on viaggio.id = t4.id_viaggio
				    LEFT OUTER JOIN bus ON bus.id = viaggio.id_bus
				WHERE
				    t4.localita_arrivo = '$this->arrivo' AND t4.localita_partenza = '$this->partenza' AND t4.orario_partenza >= '$this->data_orario'
				;";

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

	function sortFunction($a, $b){
		return strtotime($a["orario_arrivo"]) - strtotime($b["orario_arrivo"]);
	}



?>
