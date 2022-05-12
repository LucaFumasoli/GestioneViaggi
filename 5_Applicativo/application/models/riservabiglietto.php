<?php
	/**
	 * 
	 */
	class Riserva
	{
		
		function __construct()
		{
			
		}

		function getID($email){
			require "application/libs/connection.php";
			$sql = "Select id from utente where email = '$email'";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}
			return $arr;
		}

		function getPrice($id){
			require "application/libs/connection.php";
			$sql = "Select costo from tappa where id = '$id'";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}
			return $arr[0]['costo'];
		}

		function acquisto($idUtente, $costo, $numeroPosto){
			require "application/libs/connection.php";
			$sql = "INSERT INTO biglietto(id_utente, costo_totale, data, numero_posto) VALUES('$idUtente', '$costo', now(), '$numeroPosto')";
			if ($con->query($sql) === TRUE) {
				$last_id = $con->insert_id;
			}
			return $last_id;
		}
		function getIdBiglietto($posto){
			require "application/libs/connection.php";
			$sql = "Select id from biglietto where  = '$id'";
			$result = $con->query($sql);
			$arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
			}
			return $arr[0]['costo'];
		}
		function bigliettoTratta($idTratta, $idBiglietto){
			require "application/libs/connection.php";
			$sql = "INSERT INTO biglietto_tappa(id_biglietto, id_tappa) VALUES('$idBiglietto', '$idTratta')";
			$result = $con->query($sql);
			return $result;
		}
	}
?>