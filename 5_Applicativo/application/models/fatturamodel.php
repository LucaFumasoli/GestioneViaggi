<?php 
	/**
	 * 
	 */
	class Fattura
	{
		
		function __construct()
		{
			
		}
		public function ticketInfo($id){
			require "application/libs/connection.php";
			$sql = "Select id_utente, costo_totale, data, numero_posto FROM biglietto where id = '$id'";
			$fatt = $con->query($sql);
			$arrInfoBiglietto = array();
			if($fatt->num_rows > 0){
				while($row = $fatt->fetch_assoc()){
					$arrInfoBiglietto[] = $row;
				}
			}
			return $arrInfoBiglietto;
		}
		public function userInfo($idUser){
			require "application/libs/connection.php";		
			$sql = "Select nome,cognome,email from utente where id = '$idUser'";
			$utente = $con->query($sql);
			$arrInfoUtente = array();
			if($utente->num_rows > 0){
				while($row = $utente->fetch_assoc()){
					$arrInfoUtente[] = $row;
				}
			}
			return $arrInfoUtente;
		}
		public function stopInfo($id){	
			require "application/libs/connection.php";		
			$sql = "Select id_tappa from biglietto_tappa where id_biglietto = '$id'";
			$tappa = $con->query($sql);
			$arrInfoTappa = array();
			if($tappa->num_rows > 0){
				while($row = $tappa->fetch_assoc()){
					$arrInfoTappa[] = $row;
				}
			}
			$endVal = $arrInfoTappa[count($arrInfoTappa)-1]['id_tappa'];
			$startVal = $arrInfoTappa[0]['id_tappa'];
			$sql2 = "Select id_viaggio,localita_partenza,orario_partenza from tappa where id >= '$startVal' AND id <= '$endVal' AND orario_partenza = (select MIN(orario_partenza) from tappa where id >= '$startVal' AND id <= '$endVal' )";
			$partenza = $con->query($sql2);
			$p = array();
			if($partenza->num_rows > 0){
				while($row = $partenza->fetch_assoc()){
					$p[] = $row;
				}
			}
			$sql3 = "Select localita_arrivo,orario_arrivo from tappa where id >= '$startVal' AND id <= '$endVal'  AND orario_arrivo = (select MAX(orario_arrivo) from tappa where id >= '$startVal' AND id <= '$endVal' )";
			$arrivo = $con->query($sql3);
			$a = array();
			if($arrivo->num_rows > 0){
				while($row = $arrivo->fetch_assoc()){
					$a[] = $row;
				}
			}
			return array_merge($p,$a);
		}
		public function bus($idViaggio){
			require "application/libs/connection.php";		
			$sql = "select numero_bus from bus where id = (Select id from viaggio where id_bus = '$idViaggio')";
			$nBus = $con->query($sql);
			$arrBus = array();
			if($nBus->num_rows > 0){
				while($row = $nBus->fetch_assoc()){
					$arrBus[] = $row;
				}
			}
			return $arrBus;
		}
	}
?>
