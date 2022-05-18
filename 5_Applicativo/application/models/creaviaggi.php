<?php 
		/**
		 * 	
		 */
		class CreaViaggi
		{
			
			function __construct()
			{

			}

			public function getBuses(){
				require "application/libs/connection.php";
				$sql = "Select * from bus";
				$bus =  $con->query($sql);
				$arr = array();
				if($bus->num_rows > 0){
					while($row = $bus->fetch_assoc()){
						$arr[] = $row;
					}
				}		
				return $arr;
			}

			public function checkName($nomePartenzaTratta, $nomeArrivoTratta)
			{
				if($nomePartenzaTratta != $nomeArrivoTratta){
					return true;
				}
				return false;
			}

			public function checkOrari($orarioPartenzaTratta, $orarioArrivoTratta){
				if ($orarioArrivoTratta > $orarioPartenzaTratta) {
					return true;
				}
				return false;
			}

			public function checkPrezzo($prezzo)
			{
				if(is_numeric($prezzo) && $prezzo > 0){
					return true;
				}
				return false;
			}

			public function checkPartenzaSameArrivo($nomePartenzaTratta){
				if(isset($_SESSION['tratte'])){
					if ($nomePartenzaTratta == $_SESSION['tratte'][count($_SESSION['tratte'])-1][1]) {
						return true;
					}else{
						return false;
					}
				}
				return true;

			}

			public function checkOrarioPartenzaMaggioreArrivo($orarioPartenzaTratta){
				if(isset($_SESSION['tratte'])){
					if ($orarioPartenzaTratta > $_SESSION['tratte'][count($_SESSION['tratte'])-1][3]) {
						return true;
					}else{
						return false;
					}
				}
				return true;

			}

			public function noEmptyValue($nomePartenzaTratta, $nomeArrivoTratta, $orarioPartenzaTratta,$orarioArrivoTratta, $prezzo){
				if(!empty($nomePartenzaTratta) && !empty($nomeArrivoTratta) && !empty($orarioPartenzaTratta) && !empty($orarioArrivoTratta) && !empty($prezzo)){
					return true;
				}
				return false;
			}


			public function addViaggi($idBus){
				require_once "application/libs/connection.php";
				$sql = "insert into viaggio(id_bus)VALUES('$idBus')";
				$last_id;
				if ($con->query($sql) === TRUE) {
					$last_id = $con->insert_id;
				}
				return $last_id;
			}

			public function addTappe($tappe, $idViaggio){
				require "application/libs/connection.php";

				for ($i=0; $i < count($tappe); $i++) {
					$localita_partenza = $tappe[$i][0];
					$localita_arrivo = $tappe[$i][1];
					$orario_partenza = $tappe[$i][2];
					$orario_arrivo = $tappe[$i][3];
					$prezzo = $tappe[$i][4];

					$sql = "insert into tappa(id_viaggio, localita_partenza, localita_arrivo, orario_partenza, orario_arrivo, costo)VALUES('$idViaggio', '$localita_partenza', '$localita_arrivo', '$orario_partenza', '$orario_arrivo', '$prezzo')";
					$result = $con->query($sql);

				}
				return $result;
			}
		}

?>